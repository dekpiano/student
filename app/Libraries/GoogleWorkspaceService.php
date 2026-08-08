<?php

namespace App\Libraries;

use Google_Client;
use Google_Auth_AssertionCredentials;
use Google_Service_Directory;
use Google_Service_Directory_User;
use Google_Service_Directory_UserName;

class GoogleWorkspaceService
{
    protected $client = null;
    protected $service = null;
    protected $isConfigured = false;
    protected $adminEmail = 'dekpiano@skj.ac.th';
    protected $keyFilePath = null;
    protected $lastError = null;

    public function __construct()
    {
        $envAdminEmail = getenv('GOOGLE_ADMIN_EMAIL') ?: 'dekpiano@skj.ac.th';
        $this->adminEmail = $envAdminEmail;

        // Check multiple possible key file locations
        $possiblePaths = [
            WRITEPATH . 'keys/google_service_account.json',
            WRITEPATH . 'google_service_account.json',
            ROOTPATH . 'google_service_account.json',
        ];

        // Also check for any quickstart-*.json in root or writable/keys
        $globQuickstart = array_merge(
            glob(ROOTPATH . 'quickstart-*.json') ?: [],
            glob(WRITEPATH . 'keys/quickstart-*.json') ?: []
        );
        foreach ($globQuickstart as $qp) {
            $possiblePaths[] = $qp;
        }

        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                $this->keyFilePath = $path;
                break;
            }
        }

        if ($this->keyFilePath && class_exists('Google_Client')) {
            try {
                $jsonContent = json_decode(file_get_contents($this->keyFilePath), true);
                if (!$jsonContent || !isset($jsonContent['client_email']) || !isset($jsonContent['private_key'])) {
                    throw new \Exception("ไฟล์ JSON Key ไม่ถูกต้องหรือขาดข้อมูล client_email / private_key");
                }

                $this->client = new Google_Client();
                // Disable file cache to avoid container permission issues
                if (class_exists('Google_Cache_Null')) {
                    $this->client->setCache(new \Google_Cache_Null($this->client));
                }
                
                // Compatibility for Google API Client v1.x
                if (class_exists('Google_Auth_AssertionCredentials')) {
                    $credentials = new Google_Auth_AssertionCredentials(
                        $jsonContent['client_email'],
                        [Google_Service_Directory::ADMIN_DIRECTORY_USER],
                        $jsonContent['private_key'],
                        'notasecret',
                        'http://oauth.net/grant_type/jwt/1.0/bearer',
                        $this->adminEmail
                    );
                    $this->client->setAssertionCredentials($credentials);
                } else {
                    // Compatibility for Google API Client v2.x
                    $this->client->setAuthConfig($this->keyFilePath);
                    $this->client->setScopes([Google_Service_Directory::ADMIN_DIRECTORY_USER]);
                    $this->client->setSubject($this->adminEmail);
                }

                $this->service = new Google_Service_Directory($this->client);
                $this->isConfigured = true;
            } catch (\Exception $e) {
                if (function_exists('log_message')) {
                    log_message('error', 'Google API Config Error: ' . $e->getMessage());
                }
                $this->lastError = $e->getMessage();
                $this->isConfigured = false;
            }
        }
    }

    public function isConfigured(): bool
    {
        return $this->isConfigured;
    }

    public function getKeyFilePath(): ?string
    {
        return $this->keyFilePath;
    }

    public function getLastError(): ?string
    {
        return $this->lastError;
    }

    /**
     * Helper to format Google Workspace user name to student pattern:
     * Example: Year 2569, Class 1/5, Seat 02, Name กฤษฎา คำมี
     * GivenName:  "6915_02_กฤษฎา"
     * FamilyName: "คำมี"
     * Result in Google: "6915_02_กฤษฎา คำมี"
     */
    public function formatStudentNameParts($year, $studentClass, $studentNumber, string $firstName, string $lastName): array
    {
        $yearStr = trim((string)($year ?: (date('Y') + 543)));
        $year2Digits = strlen($yearStr) >= 2 ? substr($yearStr, -2) : sprintf('%02d', (int)$yearStr);

        $cleanClass = preg_replace('/[^\d\/]/u', '', (string)$studentClass);
        if (strpos($cleanClass, '/') !== false) {
            list($level, $room) = explode('/', $cleanClass, 2);
            $classCode = trim($level) . trim($room);
        } else {
            $classCode = preg_replace('/\D/', '', (string)$studentClass);
        }
        if (empty($classCode)) {
            $classCode = '00';
        }

        $num2Digits = sprintf('%02d', (int)$studentNumber);

        $givenName = "{$year2Digits}{$classCode}_{$num2Digits}_{$firstName}";
        $familyName = $lastName ?: '-';

        return [
            'givenName'  => $givenName,
            'familyName' => $familyName,
            'fullName'   => "{$givenName} {$familyName}"
        ];
    }

    /**
     * Create user in Google Workspace Directory API
     */
    public function createUser(string $email, string $firstName, string $lastName, string $password, $year = null, $studentClass = null, $studentNumber = null): array
    {
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'google_created' => false,
                'message' => 'ระบบออกอีเมลในฐานข้อมูลแล้ว (หมายเหตุ: ' . ($this->lastError ?: 'ยังไม่พบคีย์ google_service_account.json') . ')'
            ];
        }

        try {
            $user = new Google_Service_Directory_User();
            
            $name = new Google_Service_Directory_UserName();
            if ($year && $studentClass) {
                $nameParts = $this->formatStudentNameParts($year, $studentClass, $studentNumber, $firstName, $lastName);
                $name->setGivenName($nameParts['givenName']);
                $name->setFamilyName($nameParts['familyName']);
            } else {
                $name->setGivenName($firstName);
                $name->setFamilyName($lastName);
            }
            
            $user->setName($name);
            $user->setPrimaryEmail($email);
            $user->setPassword($password);
            $user->setChangePasswordAtNextLogin(true);

            $result = $this->service->users->insert($user);

            return [
                'success' => true,
                'google_created' => true,
                'message' => 'สร้างบัญชีในระบบ Google Workspace (@skj.ac.th) สำเร็จเรียบร้อย!',
                'user_id' => $result->getId()
            ];
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();

            // Check if user already exists in Google Workspace
            if (strpos($errorMessage, 'Entity already exists') !== false || strpos($errorMessage, 'EntityAlreadyExists') !== false || strpos($errorMessage, '409') !== false || strpos($errorMessage, 'duplicate') !== false) {
                return [
                    'success' => true,
                    'google_created' => true,
                    'already_exists' => true,
                    'message' => 'มีบัญชีผู้ใช้นี้ใน Google Workspace แล้ว'
                ];
            }

            if (function_exists('log_message')) {
                log_message('error', 'Google Workspace User Creation Error: ' . $errorMessage);
            }

            return [
                'success' => false,
                'google_created' => false,
                'message' => 'เกิดข้อผิดพลาดในการสร้างบัญชีผ่าน Google API: ' . $errorMessage
            ];
        }
    }

    /**
     * Update user profile name in Google Workspace Directory API
     */
    public function updateUserProfileName(string $email, $year, $studentClass, $studentNumber, string $firstName, string $lastName): array
    {
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'ยังไม่ได้เชื่อมต่อ Google Service Account Key'
            ];
        }

        try {
            $nameParts = $this->formatStudentNameParts($year, $studentClass, $studentNumber, $firstName, $lastName);

            $user = new Google_Service_Directory_User();
            $name = new Google_Service_Directory_UserName();
            $name->setGivenName($nameParts['givenName']);
            $name->setFamilyName($nameParts['familyName']);
            $user->setName($name);

            // Patch user profile in Google Workspace
            $result = $this->service->users->patch($email, $user);

            return [
                'success'        => true,
                'message'        => 'อัปเดตชื่อใน Google Workspace สำเร็จ!',
                'formatted_name' => $nameParts['fullName'],
                'user_id'        => $result->getId()
            ];
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            if (function_exists('log_message')) {
                log_message('error', 'Google Workspace Update Profile Name Error: ' . $errorMessage);
            }

            return [
                'success' => false,
                'message' => 'เกิดข้อผิดพลาดในการอัปเดตชื่อผ่าน Google API: ' . $errorMessage
            ];
        }
    }

    /**
     * Reset/Update password for user in Google Workspace Directory API
     */
    public function updateUserPassword(string $email, string $newPassword): array
    {
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'ยังไม่ได้เชื่อมต่อ Google Service Account Key'
            ];
        }

        try {
            $user = new Google_Service_Directory_User();
            $user->setPassword($newPassword);
            $user->setChangePasswordAtNextLogin(true);

            // Update user password in Google Workspace via patch/update
            $result = $this->service->users->patch($email, $user);

            return [
                'success' => true,
                'message' => 'รีเซ็ตรหัสผ่านใน Google Workspace สำเร็จเรียบร้อย!',
                'user_id' => $result->getId()
            ];
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            if (function_exists('log_message')) {
                log_message('error', 'Google Workspace Password Reset Error: ' . $errorMessage);
            }

            return [
                'success' => false,
                'message' => 'เกิดข้อผิดพลาดในการรีเซ็ตรหัสผ่าน Google API: ' . $errorMessage
            ];
        }
    }
}
