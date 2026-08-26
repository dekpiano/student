<?php

namespace App\Controllers;

use App\Models\ModelsLogin;
use App\Libraries\GoogleWorkspaceService;

class ControlEmailVerification extends BaseController
{
    public function index()
    {
        $data['title'] = "ยืนยันตัวตนรับอีเมลโรงเรียน";
        $googleService = new GoogleWorkspaceService();
        $data['googleApiConfigured'] = $googleService->isConfigured();
        return view('EmailVerification/email_verify_index', $data);
    }

    public function guide()
    {
        return view('guide_index');
    }

    public function verifyAndGetEmail()
    {
        $studentCode = trim($this->request->getPost('student_code') ?? '');
        $idCard = trim($this->request->getPost('id_card') ?? '');

        if (empty($studentCode) || empty($idCard)) {
            return $this->response->setJSON([
                'status'  => 0,
                'message' => 'กรุณากรอกเลขประจำตัวนักเรียนและเลขประจำตัวประชาชนให้ครบถ้วน'
            ]);
        }

        $model = new ModelsLogin();
        $student = $model->where('StudentCode', $studentCode)
                         ->where('StudentIDNumber', $idCard)
                         ->first();

        if (!$student) {
            return $this->response->setJSON([
                'status'  => 0,
                'message' => 'ไม่พบข้อมูลนักเรียน หรือ เลขประจำตัวประชาชนไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง'
            ]);
        }

        // Check student status: only active students ("1/ปกติ" or status containing "ปกติ") can verify email
        $userStatus = (string)($student['StudentStatus'] ?? '');
        if (trim($userStatus) !== '1/ปกติ' && strpos($userStatus, 'ปกติ') === false) {
            $statusDesc = !empty($userStatus) ? $userStatus : 'ไม่มีสถานะกำลังศึกษาอยู่';
            return $this->response->setJSON([
                'status'  => 0,
                'message' => 'ไม่สามารถดำเนินการได้ เนื่องจากบัญชีของคุณมีสถานะ "' . $statusDesc . '" (อนุญาตเฉพาะนักเรียนที่มีสถานะกำลังศึกษาอยู่เท่านั้น)'
            ]);
        }

        $isNew = false;
        $email = $student['StudentEmail'] ?? null;
        $emailPassword = $student['StudentEmailPassword'] ?? null;

        // Auto pattern generation if email is not yet set
        if (empty($email)) {
            $email = 'skj' . $studentCode . '@skj.ac.th';
            $isNew = true;
        }

        // Generate strong random password: Skj@ + 6 random alphanumeric characters
        if (empty($emailPassword)) {
            $emailPassword = 'Skj@' . substr(str_shuffle('23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ'), 0, 6);
        }

        $firstName = $student['StudentFirstName'] ?? 'Student';
        $lastName = $student['StudentLastName'] ?? $studentCode;
        $fullName = trim(($student['StudentPrefix'] ?? '') . $firstName . ' ' . $lastName);

        // Call Google Workspace API to provision the user account if new
        $googleService = new GoogleWorkspaceService();
        $googleResult = null;
        
        if ($isNew) {
            $dbAca = \Config\Database::connect('default');
            $schYearRow = $dbAca->table('tb_schoolyear')->orderBy('schyear_year', 'DESC')->get()->getRow();
            $dbYear = $schYearRow ? (int)$schYearRow->schyear_year : 0;
            $schYear = max($dbYear, (int)date('Y') + 543);

            $googleResult = $googleService->createUser(
                $email,
                $firstName,
                $lastName,
                $emailPassword,
                $schYear,
                $student['StudentClass'] ?? '',
                $student['StudentNumber'] ?? 0
            );

            if (!$googleResult['success'] && empty($googleResult['already_exists'])) {
                return $this->response->setJSON([
                    'status'  => 0,
                    'message' => 'ไม่สามารถสร้างบัญชีใน Google Workspace ได้: ' . ($googleResult['message'] ?? 'เกิดข้อผิดพลาดในการเชื่อมต่อ Google API'),
                    'data'    => [
                        'google_status' => $googleResult
                    ]
                ]);
            }

            // ถ้าบัญชีนี้มีอยู่ใน Google Workspace อยู่แล้ว
            // ไม่ควรนำรหัสผ่านที่เพิ่งสุ่มมาแสดงให้ผู้ใช้เห็น เพราะ Google ไม่ได้ถูกอัปเดตรหัสผ่านนี้
            if (!empty($googleResult['already_exists'])) {
                $isNew = false;
                $emailPassword = null;
            }
        } else {
            $googleResult = [
                'success' => true,
                'google_created' => true,
                'already_exists' => true,
                'message' => 'มีบัญชีผู้ใช้นี้ใน Google Workspace แล้ว'
            ];
        }

        // Save email and generated password to database after API validation
        $model->update($student['StudentID'], [
            'StudentEmail'         => $email,
            'StudentEmailPassword' => $emailPassword
        ]);

        return $this->response->setJSON([
            'status'  => 1,
            'message' => $isNew ? 'ออกอีเมลโรงเรียนเรียบร้อย!' : 'พบบัญชีอีเมลในระบบเรียบร้อยแล้ว',
            'data'    => [
                'student_name'   => $fullName ?: 'นักเรียน',
                'student_code'   => $studentCode,
                'student_class'  => $student['StudentClass'] ?? '-',
                'email'          => $email,
                'email_password' => $isNew ? $emailPassword : null, // Mask password if already exists
                'reset_count'    => (int)($student['StudentEmailResetCount'] ?? 0),
                'is_new'         => $isNew,
                'google_status'  => $googleResult
            ]
        ]);
    }

    /**
     * Reset Google Workspace email password for student
     */
    public function resetPassword()
    {
        $studentCode = trim($this->request->getPost('student_code') ?? '');
        $idCard = trim($this->request->getPost('id_card') ?? '');

        if (empty($studentCode) || empty($idCard)) {
            return $this->response->setJSON([
                'status'  => 0,
                'message' => 'กรุณากรอกเลขประจำตัวนักเรียนและเลขประจำตัวประชาชนให้ครบถ้วน'
            ]);
        }

        $model = new ModelsLogin();
        $student = $model->where('StudentCode', $studentCode)
                         ->where('StudentIDNumber', $idCard)
                         ->first();

        if (!$student) {
            return $this->response->setJSON([
                'status'  => 0,
                'message' => 'ไม่พบข้อมูลนักเรียน หรือ เลขประจำตัวประชาชนไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง'
            ]);
        }

        // Check student status: only active students ("1/ปกติ" or status containing "ปกติ") can reset password
        $userStatus = (string)($student['StudentStatus'] ?? '');
        if (trim($userStatus) !== '1/ปกติ' && strpos($userStatus, 'ปกติ') === false) {
            $statusDesc = !empty($userStatus) ? $userStatus : 'ไม่มีสถานะกำลังศึกษาอยู่';
            return $this->response->setJSON([
                'status'  => 0,
                'message' => 'ไม่สามารถดำเนินการได้ เนื่องจากบัญชีของคุณมีสถานะ "' . $statusDesc . '" (อนุญาตเฉพาะนักเรียนที่มีสถานะกำลังศึกษาอยู่เท่านั้น)'
            ]);
        }

        $email = $student['StudentEmail'] ?? null;
        if (empty($email)) {
            $email = 'skj' . $studentCode . '@skj.ac.th';
        }

        // Generate brand new strong random password (satisfies Google policy)
        $newPassword = 'Skj@' . substr(str_shuffle('23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ'), 0, 6);

        // Increment reset counter
        $currentResetCount = (int)($student['StudentEmailResetCount'] ?? 0);
        $newResetCount = $currentResetCount + 1;

        $firstName = $student['StudentFirstName'] ?? 'Student';
        $lastName = $student['StudentLastName'] ?? $studentCode;
        $fullName = trim(($student['StudentPrefix'] ?? '') . $firstName . ' ' . $lastName);

        // Call Google Workspace API to patch/update the user's password live
        $googleService = new GoogleWorkspaceService();
        $googleResult = $googleService->updateUserPassword($email, $newPassword);

        // If user didn't exist in Google yet, try creating it
        if (!$googleResult['success'] && (strpos($googleResult['message'], '404') !== false || strpos($googleResult['message'], 'Resource Not Found') !== false)) {
            $dbAca = \Config\Database::connect('default');
            $schYearRow = $dbAca->table('tb_schoolyear')->orderBy('schyear_year', 'DESC')->get()->getRow();
            $dbYear = $schYearRow ? (int)$schYearRow->schyear_year : 0;
            $schYear = max($dbYear, (int)date('Y') + 543);

            $googleResult = $googleService->createUser(
                $email,
                $firstName,
                $lastName,
                $newPassword,
                $schYear,
                $student['StudentClass'] ?? '',
                $student['StudentNumber'] ?? 0
            );
        }

        // Check if Google Workspace operation actually succeeded
        if (!$googleResult['success']) {
            return $this->response->setJSON([
                'status'  => 0,
                'message' => 'ไม่สามารถเปลี่ยนรหัสผ่านใน Google Workspace ได้: ' . ($googleResult['message'] ?? 'เกิดข้อผิดพลาดในการเชื่อมต่อ Google API กรุณาติดต่อผู้ดูแลระบบ'),
                'data'    => [
                    'google_status' => $googleResult
                ]
            ]);
        }

        // Only update in database when Google Workspace API succeeded
        $model->update($student['StudentID'], [
            'StudentEmail'           => $email,
            'StudentEmailPassword'   => $newPassword,
            'StudentEmailResetCount' => $newResetCount,
            'StudentEmailResetAt'    => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'status'  => 1,
            'message' => 'รีเซ็ตรหัสผ่านอีเมลโรงเรียนสำเร็จ!',
            'data'    => [
                'student_name'   => $fullName ?: 'นักเรียน',
                'student_code'   => $studentCode,
                'student_class'  => $student['StudentClass'] ?? '-',
                'email'          => $email,
                'new_password'   => $newPassword,
                'reset_count'    => $newResetCount,
                'google_status'  => $googleResult
            ]
        ]);
    }
}
