<?php

namespace App\Controllers;

use App\Models\ModelsLogin;
use CodeIgniter\Controller;

class ControlLogin extends BaseController
{
    public function index()
    {
        $data['title'] = "Login";
        return view('Dashboard/index', $data);
    }

    public function loginProcess()
    {
        $session = session();
        $model = new ModelsLogin();
        $dbAca = \Config\Database::connect('default');
        $TbYearNow = $dbAca->table('tb_schoolyear');
        $CheckYearNow = $TbYearNow->orderBy('schyear_year', 'DESC')->get()->getRow();
        $dbYear = $CheckYearNow ? (int)$CheckYearNow->schyear_year : 0;
        $schYear = max($dbYear, (int)date('Y') + 543);
       
        $username = trim($this->request->getVar('Username') ?? '');
        $password = trim($this->request->getVar('Password') ?? '');
        
        $user = $model->where('StudentCode', $username)->first();

        $passwordCorrect = false;
        if ($user) {
            // User exists, check password
            if (!empty($user['StudentPassword'])) {
                if (password_verify($password, $user['StudentPassword'])) {
                    $passwordCorrect = true;
                }
            } else {
                if ($password == $user['StudentIDNumber']) {
                    $passwordCorrect = true;
                    $model->update($user['StudentID'], ['StudentPassword' => password_hash($password, PASSWORD_DEFAULT)]);
                }
            }
        }

        if ($passwordCorrect) {
            $schYear = $CheckYearNow ? $CheckYearNow->schyear_year : date('Y') + 543;

            $sessionData = [
                'UserId'       => $user['StudentID'],
                'UserCode'     => $user['StudentCode'],
                'UserClass'    => $user['StudentClass'],
                'UserStatus'   => $user['StudentStatus'],
                'Fullname'     => $user['StudentPrefix'] . $user['StudentFirstName'] . ' ' . $user['StudentLastName'],
                'CheckYearNow' => $schYear
            ];
            $session->set($sessionData);
           
            // Auto-update student display name in Google Workspace on every login (Format: 6915_02_กฤษฎา คำมี)
            if (!empty($user['StudentEmail'])) {
                try {
                    $googleService = new \App\Libraries\GoogleWorkspaceService();
                    if ($googleService->isConfigured()) {
                        $googleService->updateUserProfileName(
                            $user['StudentEmail'],
                            $schYear,
                            $user['StudentClass'] ?? '',
                            $user['StudentNumber'] ?? 0,
                            $user['StudentFirstName'] ?? '',
                            $user['StudentLastName'] ?? ''
                        );
                    }
                } catch (\Exception $e) {
                    if (function_exists('log_message')) {
                        log_message('error', 'Auto update Google name error: ' . $e->getMessage());
                    }
                }
            }

            $redirect = $session->get('redirect_url') ?: base_url('Dashboard');
            $session->remove('redirect_url');

            return $this->response->setJSON(['status' => 1, 'message' => 'เข้าสู่ระบบสำเร็จ', 'redirect' => $redirect]);
        } else {
            return $this->response->setJSON(['status' => 0, 'message' => 'ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง']);
        }
    }

    /**
     * Process Google Single Sign-On (OAuth2 JWT Credential)
     */
    public function googleLoginProcess()
    {
        $session = session();
        $model = new ModelsLogin();
        
        $credential = $this->request->getPost('credential') ?? $this->request->getVar('credential');
        $email = trim($this->request->getPost('email') ?? $this->request->getVar('email') ?? '');

        // If JWT Credential payload is provided from Google One Tap / Google Button
        if (!empty($credential)) {
            $parts = explode('.', $credential);
            if (count($parts) === 3) {
                $payloadJson = base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[1]));
                $payload = json_decode($payloadJson, true);
                if ($payload && !empty($payload['email'])) {
                    $email = trim($payload['email']);
                }
            }
        }

        if (empty($email)) {
            return $this->response->setJSON([
                'status'  => 0,
                'message' => 'ไม่พบข้อมูลอีเมลจาก Google กรุณาลองใหม่อีกครั้ง'
            ]);
        }

        // Search for student in database by StudentEmail
        $user = $model->where('StudentEmail', $email)->first();

        if (!$user) {
            // Match pattern skj[StudentCode]@skj.ac.th or [StudentCode]@skj.ac.th
            if (preg_match('/^(?:skj)?(\d+)@skj\.ac\.th$/i', $email, $matches)) {
                $studentCode = $matches[1];
                $user = $model->where('StudentCode', $studentCode)->first();
            }

            // If student found by StudentCode, automatically bind and save StudentEmail to database
            if ($user) {
                $model->update($user['StudentID'], ['StudentEmail' => $email]);
            }
        }

        if (!$user) {
            return $this->response->setJSON([
                'status'  => 0,
                'message' => 'ไม่พบข้อมูลนักเรียนสำหรับอีเมล ' . $email . ' ในระบบ (กรุณาใช้อีเมลโรงเรียน @skj.ac.th หรือหากลืมรหัสผ่าน ให้กดปุ่ม "รีเซ็ตรหัสผ่าน")'
            ]);
        }

        $dbAca = \Config\Database::connect('default');
        $TbYearNow = $dbAca->table('tb_schoolyear');
        $CheckYearNow = $TbYearNow->orderBy('schyear_year', 'DESC')->get()->getRow();
        $dbYear = $CheckYearNow ? (int)$CheckYearNow->schyear_year : 0;
        $schYear = max($dbYear, (int)date('Y') + 543);

        $sessionData = [
            'UserId'       => $user['StudentID'],
            'UserCode'     => $user['StudentCode'],
            'UserClass'    => $user['StudentClass'],
            'UserStatus'   => $user['StudentStatus'],
            'Fullname'     => $user['StudentPrefix'] . $user['StudentFirstName'] . ' ' . $user['StudentLastName'],
            'CheckYearNow' => $schYear
        ];
        $session->set($sessionData);

        // Auto-update student display name in Google Workspace on every login (Format: 6915_02_กฤษฎา คำมี)
        if (!empty($user['StudentEmail'])) {
            try {
                $googleService = new \App\Libraries\GoogleWorkspaceService();
                if ($googleService->isConfigured()) {
                    $googleService->updateUserProfileName(
                        $user['StudentEmail'],
                        $schYear,
                        $user['StudentClass'] ?? '',
                        $user['StudentNumber'] ?? 0,
                        $user['StudentFirstName'] ?? '',
                        $user['StudentLastName'] ?? ''
                    );
                }
            } catch (\Exception $e) {
                if (function_exists('log_message')) {
                    log_message('error', 'Auto update Google name error: ' . $e->getMessage());
                }
            }
        }

        $redirect = $session->get('redirect_url') ?: base_url('Dashboard');
        $session->remove('redirect_url');

        return $this->response->setJSON([
            'status'   => 1,
            'message'  => 'เข้าสู่ระบบด้วย Google สำเร็จ!',
            'redirect' => $redirect
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
