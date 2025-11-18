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

        // Check if the user is logged in
        if (!$this->session->get('UserId')) {
            // Redirect to the login page if not logged in
            header("Location: " . base_url('/login'));
            exit();
        }
    }

    public function index()
    {
        // Calculate current academic year (Buddhist Era)
        $current_calendar_year = (int)date('Y');
        $current_month = (int)date('m');
        $current_be_year = $current_calendar_year + 543;

        if ($current_month >= 1 && $current_month <= 4) { // Jan - Apr
            $current_academic_year = $current_be_year - 1;
        } else { // May - Dec
            $current_academic_year = $current_be_year;
        }

        $registration_period = $this->ModelClub->getActiveRegistrationPeriod($current_academic_year, 'student');
        
        $current_year = $registration_period['c_onoff_year'] ?? null;
        $current_term = $registration_period['c_onoff_term'] ?? null;

        $student_club = null;
        $clubs = [];

        if ($current_year && $current_term) {
            $student_club = $this->ModelClub->getStudentClub($this->session->get('UserId'), $current_year, $current_term);

            if (
                !empty($registration_period) &&
                time() >= strtotime($registration_period['c_onoff_regisstart']) &&
                time() <= strtotime($registration_period['c_onoff_regisend']) &&
                empty($student_club)
            ) {
                $student_class = $this->session->get('UserClass'); // e.g., 'ม.4/1'
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

        $data = [
            'title' => 'เลือกชุมนุม',
            'registration_period' => $registration_period,
            'student_club' => $student_club,
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

        // Calculate current academic year (Buddhist Era)
        $current_calendar_year = (int)date('Y');
        $current_month = (int)date('m');
        $current_be_year = $current_calendar_year + 543;

        if ($current_month >= 1 && $current_month <= 4) { // Jan - Apr
            $current_academic_year = $current_be_year - 1;
        } else { // May - Dec
            $current_academic_year = $current_be_year;
        }

        $active_reg_period = $this->ModelClub->getActiveRegistrationPeriod($current_academic_year, 'student');
        $current_year = $active_reg_period['c_onoff_year'] ?? null;
        $current_term = $active_reg_period['c_onoff_term'] ?? null;
        $student_id = $this->session->get('UserId');

        // 1. Check registration period
        if (empty($active_reg_period) || !$current_year || !$current_term) {
            return $this->response->setJSON(['success' => false, 'message' => 'ไม่อยู่ในช่วงเวลาการลงทะเบียน']);
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

        // Calculate current academic year (Buddhist Era)
        $current_calendar_year = (int)date('Y');
        $current_month = (int)date('m');
        $current_be_year = $current_calendar_year + 543;

        if ($current_month >= 1 && $current_month <= 4) { // Jan - Apr
            $current_academic_year = $current_be_year - 1;
        } else { // May - Dec
            $current_academic_year = $current_be_year;
        }

        $active_reg_period = $this->ModelClub->getActiveRegistrationPeriod($current_academic_year, 'student');
        $student_id = $this->session->get('UserId');

        // Check registration period
        if (empty($active_reg_period)) {
            return $this->response->setJSON(['success' => false, 'message' => 'ไม่อยู่ในช่วงเวลาที่สามารถยกเลิกชุมนุมได้']);
        }

        $current_year = $active_reg_period['c_onoff_year'];
        $current_term = $active_reg_period['c_onoff_term'];

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
        
        // Calculate current academic year (Buddhist Era)
        $current_calendar_year = (int)date('Y');
        $current_month = (int)date('m');
        $current_be_year = $current_calendar_year + 543;

        if ($current_month >= 1 && $current_month <= 4) { // Jan - Apr
            $current_academic_year = $current_be_year - 1;
        } else { // May - Dec
            $current_academic_year = $current_be_year;
        }

        $active_reg_period = $this->ModelClub->getActiveRegistrationPeriod($current_academic_year, 'student');

        if (empty($active_reg_period)) {
            return $this->response->setJSON(['success' => false, 'message' => 'ไม่อยู่ในช่วงเวลาการลงทะเบียน', 'remaining_changes' => 0]);
        }

        $current_year = $active_reg_period['c_onoff_year'];
        $current_term = $active_reg_period['c_onoff_term'];

        $change_count = $this->ModelClub->getChangeCount($student_id, $current_year, $current_term);
        $remaining_changes = 2 - $change_count;

        return $this->response->setJSON(['success' => true, 'remaining_changes' => $remaining_changes]);
    }
}
