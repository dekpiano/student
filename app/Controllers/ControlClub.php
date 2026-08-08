<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelClub;

class ControlClub extends BaseController
{
    protected $db;
    protected $ModelClub;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->ModelClub = new ModelClub();
        $this->db = \Config\Database::connect();

        $request = service('request');

        // Check if the user is logged in
        if (!$this->session->get('UserId')) {
            // Redirect to the login page if not logged in
            $this->session->set('redirect_url', current_url());
            header("Location: " . base_url('/login'));
            exit();
        }

        // Restrict club access to normal students only
        $userStatus = (string)$this->session->get('UserStatus');
        if (trim($userStatus) !== '1/ปกติ' && strpos($userStatus, 'ปกติ') === false) {
            if ($request->isAJAX()) {
                // If AJAX, return error JSON
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'เฉพาะนักเรียนสถานะปกติเท่านั้นที่สามารถเข้าถึงส่วนนี้ได้']);
                exit();
            } else {
                // Set flashdata alert for Dashboard
                $this->session->setFlashdata('club_error', 'เฉพาะนักเรียนที่มีสถานะ "ปกติ" เท่านั้นที่สามารถเข้าใช้งานระบบกิจกรรมชุมนุมได้ (สถานะปัจจุบันของคุณ: ' . ($userStatus ?: 'ไม่ระบุ') . ')');
                header("Location: " . base_url('Dashboard'));
                exit();
            }
        }
    }

    public function index()
    {
        // 1. Get the system active configuration settings
        $active_config = $this->ModelClub->getLatestRegistrationSettings('active_config');
        $current_year = $active_config['c_onoff_year'] ?? null;
        $current_term = $active_config['c_onoff_term'] ?? null;

        // 2. Fetch the student registration settings for the active year and term
        $registration_period = $this->ModelClub->db->table('tb_club_onoff')
            ->where('c_onoff_year', $current_year)
            ->where('c_onoff_term', $current_term)
            ->where('c_onoff_for', 'student')
            ->get()->getRowArray();

        // Fetch the student's overall latest active club registration (for history/previous year info)
        $latest_student_club = $this->ModelClub->getLatestStudentClub($this->session->get('UserId'));

        $student_club = null;
        $clubs = [];

        if ($current_year && $current_term) {
            // 2. Check if the student has already joined a club in this current term/year
            $student_club = $this->ModelClub->getStudentClub($this->session->get('UserId'), $current_year, $current_term);

            if ($student_club) {
                // Fetch advisor names for the enrolled club
                $club_details = $this->ModelClub->getClubDetails($student_club['club_id']);
                $student_club['advisor_names'] = $club_details['advisor_names'] ?? '-';
            } else {
                // 3. If they haven't joined, fetch available clubs for preview and selection
                $student_class = $this->session->get('UserClass');
                $level_group = null;
                if ($student_class) {
                    $grade_parts = explode('/', $student_class);
                    $numeric_grade_string = str_replace('ม.', '', $grade_parts[0]);
                    $grade_level = (int)$numeric_grade_string;

                    if ($grade_level >= 1 && $grade_level <= 3) {
                        $level_group = 'junior';
                    } elseif ($grade_level >= 4 && $grade_level <= 6) {
                        $level_group = 'senior';
                    }
                }
                $clubs = $this->ModelClub->getAvailableClubs($current_year, $current_term, $level_group);
            }
        }

        $student_club_history = $this->ModelClub->getStudentClubHistory($this->session->get('UserId'));

        $data = [
            'title' => 'เลือกชุมนุม',
            'registration_period' => $registration_period,
            'current_year' => $current_year,
            'current_term' => $current_term,
            'student_club' => $student_club,
            'latest_student_club' => $latest_student_club,
            'student_club_history' => $student_club_history,
            'clubs' => $clubs,
            'uri' => service('uri'),
        ];

        echo view('Layout/Header', $data);
        echo view('Layout/NavbarTop', $data);
        echo view('Layout/NavbarLeft', $data);
        echo view('Club/ClubIndex', $data);
        echo view('Layout/Footer', $data);
    }

    public function view($club_id)
    {
        $club = $this->ModelClub->getClubDetails($club_id);

        $data = [
            'title' => 'รายละเอียดชุมนุม',
            'club' => $club,
            'objectives' => $club ? $this->ModelClub->getClubObjectives($club_id) : [],
            'activities' => $club ? $this->ModelClub->getClubActivities($club_id) : [],
            'members' => $club ? $this->ModelClub->getClubMembers($club_id) : [],
            'uri' => service('uri'),
        ];

        echo view('Layout/Header', $data);
        echo view('Layout/NavbarTop', $data);
        echo view('Layout/NavbarLeft', $data);
        echo view('Club/ClubView', $data);
        echo view('Layout/Footer', $data);
    }

    public function join()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        $json = $this->request->getJSON();
        $club_id = $json->club_id ?? null;

        if (!$club_id) {
            return $this->response->setJSON(['success' => false, 'message' => 'ไม่พบรหัสชุมนุม']);
        }

        $active_config = $this->ModelClub->getLatestRegistrationSettings('active_config');
        $current_year = $active_config['c_onoff_year'] ?? null;
        $current_term = $active_config['c_onoff_term'] ?? null;

        $active_reg_period = $this->ModelClub->db->table('tb_club_onoff')
            ->where('c_onoff_year', $current_year)
            ->where('c_onoff_term', $current_term)
            ->where('c_onoff_for', 'student')
            ->get()->getRowArray();
        $student_id = $this->session->get('UserId');

        // 1. Check registration period
        if (empty($active_reg_period) || !$current_year || !$current_term) {
            return $this->response->setJSON(['success' => false, 'message' => 'ไม่อยู่ในช่วงเวลาการลงทะเบียน']);
        }

        $now = time();
        $start_time = strtotime($active_reg_period['c_onoff_regisstart']);
        $end_time = strtotime($active_reg_period['c_onoff_regisend']);
        if ($now < $start_time || $now > $end_time) {
            return $this->response->setJSON(['success' => false, 'message' => 'ไม่อยู่ในช่วงเวลาการลงทะเบียน หรือหมดเวลาการลงทะเบียนแล้ว']);
        }

        // 2. Check if student already in a club
        $student_club = $this->ModelClub->getStudentClub($student_id, $current_year, $current_term);
        if (!empty($student_club)) {
            return $this->response->setJSON(['success' => false, 'message' => 'คุณได้เข้าร่วมชุมนุมอื่นแล้ว']);
        }

        // 3. Check if club is full
        $club_details = $this->ModelClub->find($club_id);
        $member_count = $this->ModelClub->getMemberCount($club_id);
        if (!$club_details || $member_count >= $club_details['club_max_participants']) {
            return $this->response->setJSON(['success' => false, 'message' => 'ชุมนุมนี้เต็มแล้ว']);
        }

        // 4. Join the club
        $result = $this->ModelClub->joinClub($student_id, $club_id);

        if ($result) {
            return $this->response->setJSON(['success' => true, 'message' => 'เข้าร่วมชุมนุมสำเร็จ!']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
        }
    }

    public function cancelClub()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        $json = $this->request->getJSON();
        $club_id = $json->club_id ?? null;

        if (!$club_id) {
            return $this->response->setJSON(['success' => false, 'message' => 'ไม่พบรหัสชุมนุม']);
        }

        $active_config = $this->ModelClub->getLatestRegistrationSettings('active_config');
        $current_year = $active_config['c_onoff_year'] ?? null;
        $current_term = $active_config['c_onoff_term'] ?? null;

        $active_reg_period = $this->ModelClub->db->table('tb_club_onoff')
            ->where('c_onoff_year', $current_year)
            ->where('c_onoff_term', $current_term)
            ->where('c_onoff_for', 'student')
            ->get()->getRowArray();

        $student_id = $this->session->get('UserId');

        // Check registration period dates for cancellation/change
        if (empty($active_reg_period)) {
            return $this->response->setJSON(['success' => false, 'message' => 'ไม่อยู่ในช่วงเวลาการลงทะเบียน']);
        }
        $now = time();
        $start_time = strtotime($active_reg_period['c_onoff_regisstart']);
        $end_time = strtotime($active_reg_period['c_onoff_regisend']);
        if ($now < $start_time || $now > $end_time) {
            return $this->response->setJSON(['success' => false, 'message' => 'หมดเขตระยะเวลาการขอเปลี่ยนย้ายชุมนุมแล้ว']);
        }

        // Check change count limit
        $change_count = $this->ModelClub->getChangeCount($student_id, $current_year, $current_term);
        if ($change_count >= 2) {
            return $this->response->setJSON(['success' => false, 'message' => 'ไม่สามารถเปลี่ยนชุมนุมได้ เนื่องจากคุณเปลี่ยนชุมนุมครบ 2 ครั้งแล้วในภาคเรียนนี้']);
        }

        // Check if student is actually in this club
        $student_current_club = $this->ModelClub->getStudentClub($student_id, $current_year, $current_term);
        if (empty($student_current_club) || $student_current_club['club_id'] != $club_id) {
            return $this->response->setJSON(['success' => false, 'message' => 'คุณไม่ได้อยู่ในชุมนุมนี้']);
        }

        $result = $this->ModelClub->leaveClub($student_id, $club_id);

        if ($result) {
            $remaining_changes = 2 - ($change_count + 1); // +1 because this cancellation just happened
            return $this->response->setJSON(['success' => true, 'message' => 'ยกเลิกชุมนุมสำเร็จ!', 'remaining_changes' => $remaining_changes]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการยกเลิกชุมนุม']);
        }
    }

    public function getResultsSummary()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        $filters = [
            'student_id' => $this->session->get('UserId')
        ];

        $results = $this->ModelClub->getClubSummary($filters);

        return $this->response->setJSON($results);
    }

    public function getAttendanceSummary($student_id, $club_id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        // A security check could be added here to ensure the logged-in user is allowed to see this data
        
        $data = $this->ModelClub->getStudentAttendanceDetails($student_id, $club_id);

        return $this->response->setJSON($data);
    }

    public function getRemainingChanges()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        $student_id = $this->session->get('UserId');
        
        $active_config = $this->ModelClub->getLatestRegistrationSettings('active_config');
        $current_year = $active_config['c_onoff_year'] ?? null;
        $current_term = $active_config['c_onoff_term'] ?? null;

        $active_reg_period = $active_config;

        $change_count = $this->ModelClub->getChangeCount($student_id, $current_year, $current_term);
        $remaining_changes = 2 - $change_count;

        return $this->response->setJSON(['success' => true, 'remaining_changes' => $remaining_changes]);
    }
}
