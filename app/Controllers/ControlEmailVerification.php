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

        // Save email and generated password to database
        $model->update($student['StudentID'], [
            'StudentEmail'         => $email,
            'StudentEmailPassword' => $emailPassword
        ]);

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
        } else {
            $googleResult = [
                'success' => true,
                'google_created' => true,
                'already_exists' => true,
                'message' => 'มีบัญชีผู้ใช้นี้ใน Google Workspace แล้ว'
            ];
        }

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

        $email = $student['StudentEmail'] ?? null;
        if (empty($email)) {
            $email = 'skj' . $studentCode . '@skj.ac.th';
        }

        // Generate brand new strong random password (satisfies Google policy)
        $newPassword = 'Skj@' . substr(str_shuffle('23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ'), 0, 6);

        // Increment reset counter
        $currentResetCount = (int)($student['StudentEmailResetCount'] ?? 0);
        $newResetCount = $currentResetCount + 1;

        // Update in database
        $model->update($student['StudentID'], [
            'StudentEmail'         => $email,
            'StudentEmailPassword' => $newPassword,
            'StudentEmailResetCount' => $newResetCount,
            'StudentEmailResetAt'    => date('Y-m-d H:i:s')
        ]);

        $firstName = $student['StudentFirstName'] ?? 'Student';
        $lastName = $student['StudentLastName'] ?? $studentCode;
        $fullName = trim(($student['StudentPrefix'] ?? '') . $firstName . ' ' . $lastName);

        // Call Google Workspace API to patch/update the user's password live
        $googleService = new GoogleWorkspaceService();
        $googleResult = $googleService->updateUserPassword($email, $newPassword);

        // If user didn't exist in Google yet, try creating it
        if (!$googleResult['success'] && (strpos($googleResult['message'], '404') !== false || strpos($googleResult['message'], 'Resource Not Found') !== false)) {
            $googleResult = $googleService->createUser($email, $firstName, $lastName, $newPassword);
        }

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
