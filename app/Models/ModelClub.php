<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelClub extends Model
{
    protected $table            = 'tb_clubs';
    protected $primaryKey       = 'club_id';
    protected $allowedFields    = [
        'club_name',
        'club_description',
        'club_faculty_advisor',
        'club_established_date',
        'club_year',
        'club_trem',
        'club_max_participants',
        'club_status',
        'club_level'
    ];

    // Get the registration period
    public function getActiveRegistrationPeriod()
    {
        $current_time = date('Y-m-d H:i:s');
        return $this->db->table('tb_club_onoff')
            ->where('c_onoff_regisstart <=', $current_time)
            ->where('c_onoff_regisend >=', $current_time)
            ->get()->getRowArray();
    }

    // Get all available clubs for a given year and term
    public function getAvailableClubs($year, $term)
    {
        $clubs = $this->where('club_year', $year)
                      ->where('club_trem', $term)
                      ->where('club_status', 'open')
                      ->findAll();

        if (empty($clubs)) {
            return [];
        }

        // Get all personnel data once to reduce DB queries
        $personnel_db = \Config\Database::connect('personnel');
        $all_personnel = $personnel_db->table('tb_personnel')->get()->getResultArray();
        $personnel_map = array_column($all_personnel, 'pers_firstname', 'pers_id');


        foreach ($clubs as &$club) {
            // Get member count
            $club['member_count'] = $this->getMemberCount($club['club_id']);

            // Get advisor names
            $advisor_ids = explode('|', $club['club_faculty_advisor']);
            $advisor_names = [];
            foreach ($advisor_ids as $id) {
                if (isset($personnel_map[$id])) {
                    $advisor_names[] = $personnel_map[$id];
                }
            }
            $club['advisor_names'] = implode(', ', $advisor_names);
        }

        return $clubs;
    }

    // Get details for a single club
    public function getClubDetails($club_id)
    {
        $club = $this->find($club_id);
        if ($club) {
            $club['member_count'] = $this->getMemberCount($club_id);

            // Get advisor names
            $personnel_db = \Config\Database::connect('personnel');
            $all_personnel = $personnel_db->table('tb_personnel')->get()->getResultArray();
            $personnel_map = array_column($all_personnel, 'pers_firstname', 'pers_id');
            $advisor_ids = explode('|', $club['club_faculty_advisor']);
            $advisor_names = [];
            foreach ($advisor_ids as $id) {
                if (isset($personnel_map[$id])) {
                    $advisor_names[] = $personnel_map[$id];
                }
            }
            $club['advisor_names'] = implode(', ', $advisor_names);
        }
        return $club;
    }

    // Check if a student has already joined a club for the year/term
    public function getStudentClub($student_id, $year, $term)
    {
        return $this->db->table('tb_club_members cm')
            ->join('tb_clubs c', 'c.club_id = cm.member_club_id')
            ->where('cm.member_student_id', $student_id)
            ->where('c.club_year', $year)
            ->where('c.club_trem', $term)
            ->where('cm.member_status', 'active')
            ->get()->getRowArray();
    }

    // Add a student to a club
    public function joinClub($student_id, $club_id)
    {
        $data = [
            'member_student_id' => $student_id,
            'member_club_id'    => $club_id,
            'member_join_date'  => date('Y-m-d'),
            'member_role'       => 'Member'
        ];
        return $this->db->table('tb_club_members')->insert($data);
    }

    // Get current member count for a club
    public function getMemberCount($club_id)
    {
        return $this->db->table('tb_club_members')
            ->where('member_club_id', $club_id)
            ->where('member_status', 'active')
            ->countAllResults();
    }

    public function getClubMembers($club_id)
    {
        return $this->db->table('tb_club_members cm')
            ->join('tb_students s', 's.StudentID = cm.member_student_id')
            ->where('cm.member_club_id', $club_id)
            ->orderBy('cm.member_role', 'DESC') // Leader first
            ->orderBy('s.StudentNumber', 'ASC')
            ->get()->getResultArray();
    }

    public function getClubObjectives($club_id)
    {
        return $this->db->table('tb_club_objectives')
            ->where('club_id', $club_id)
            ->orderBy('objective_order', 'ASC')
            ->get()->getResultArray();
    }

    public function getClubActivities($club_id)
    {
        return $this->db->table('tb_club_activities')
            ->where('act_club_id', $club_id)
            ->orderBy('act_date', 'ASC')
            ->get()->getResultArray();
    }

    public function leaveClub($student_id, $club_id)
    {
        return $this->db->table('tb_club_members')
            ->where('member_student_id', $student_id)
            ->where('member_club_id', $club_id)
            ->where('member_status', 'active')
            ->update(['member_status' => 'cancelled']);
    }

    public function getClubSummary($filters = [])
    {
        $builder = $this->db->table('tb_club_student_summary css');
        $builder->join('tb_students s', 's.StudentID = css.student_id');
        $builder->join('tb_clubs c', 'c.club_id = css.club_id');

        if (!empty($filters['academic_year'])) {
            $builder->where('css.academic_year', $filters['academic_year']);
        }
        if (!empty($filters['term'])) {
            $builder->where('css.academic_term', $filters['term']);
        }
        if (!empty($filters['class'])) {
            $builder->where('s.StudentClass', $filters['class']);
        }
        if (!empty($filters['club_id'])) {
            $builder->where('css.club_id', $filters['club_id']);
        }
        if (!empty($filters['student_id'])) {
            $builder->where('css.student_id', $filters['student_id']);
        }

        $builder->select('css.student_id, css.club_id, css.academic_year, css.academic_term, s.StudentPrefix, s.StudentFirstName, s.StudentLastName, s.StudentClass, c.club_name, css.objective_result, css.result_level');
        $builder->orderBy('s.StudentClass', 'ASC')->orderBy('s.StudentNumber', 'ASC');

        return $builder->get()->getResultArray();
    }

    public function getDistinctClubYears()
    {
        return $this->db->table('tb_club_student_summary')
            ->select('academic_year')
            ->distinct()
            ->orderBy('academic_year', 'DESC')
            ->get()->getResultArray();
    }

    public function getDistinctStudentClasses()
    {
        return $this->db->table('tb_students')
            ->select('StudentClass')
            ->distinct()
            ->orderBy('StudentClass', 'ASC')
            ->get()->getResultArray();
    }

    public function getAllClubs()
    {
        return $this->db->table('tb_clubs')
            ->select('club_id, club_name')
            ->orderBy('club_name', 'ASC')
            ->get()->getResultArray();
    }

    public function getChangeCount($student_id, $year, $term)
    {
        return $this->db->table('tb_club_members cm')
            ->join('tb_clubs c', 'c.club_id = cm.member_club_id')
            ->where('cm.member_student_id', $student_id)
            ->where('c.club_year', $year)
            ->where('c.club_trem', $term)
            ->where('cm.member_status', 'cancelled')
            ->countAllResults();
    }

    public function getStudentAttendanceDetails($student_id, $club_id)
    {
        $records = $this->db->table('tb_club_record_activity tcra')
            ->join('tb_club_activities tca', 'tcra.trca_schedule_id = tca.act_id')
            ->where('tcra.tcra_club_id', $club_id)
            ->get()->getResultArray();

        $summary = [
            'present' => 0,
            'absent' => 0,
            'sick_leave' => 0,
            'personal_leave' => 0,
            'activity_leave' => 0,
            'total_hours' => 0,
        ];
        $details = [];

        foreach ($records as $record) {
            $hours = $record['act_number_of_periods'] ?? 1;
            $status = 'ไม่พบข้อมูล';
            $status_class = 'text-muted';

            if (in_array($student_id, explode(',', $record['tcra_ma']))) {
                $summary['present'] += $hours;
                $status = 'มา';
                $status_class = 'text-success';
            } elseif (in_array($student_id, explode(',', $record['tcra_khad']))) {
                $summary['absent'] += $hours;
                $status = 'ขาด';
                $status_class = 'text-danger';
            } elseif (in_array($student_id, explode(',', $record['tcra_rapwy']))) {
                $summary['sick_leave'] += $hours;
                $status = 'ลาป่วย';
                $status_class = 'text-warning';
            } elseif (in_array($student_id, explode(',', $record['tcra_rakic']))) {
                $summary['personal_leave'] += $hours;
                $status = 'ลากิจ';
                $status_class = 'text-info';
            } elseif (in_array($student_id, explode(',', $record['tcra_kickrrm']))) {
                $summary['activity_leave'] += $hours;
                $status = 'กิจกรรม';
                $status_class = 'text-primary';
            }

            if ($status !== 'ไม่พบข้อมูล') {
                $details[] = [
                    'date' => $record['act_date'],
                    'activity_name' => $record['act_name'],
                    'status' => $status,
                    'status_class' => $status_class,
                    'hours' => $hours,
                ];
            }
             $summary['total_hours'] += $hours;
        }

        $total_attended = $summary['present'] + $summary['sick_leave'] + $summary['personal_leave'] + $summary['activity_leave'];
        $percentage = ($summary['total_hours'] > 0) ? ($total_attended / $summary['total_hours']) * 100 : 0;
        
        // The user wants to count "leave" as present for percentage calculation.
        $total_for_percentage = $summary['present'] + $summary['sick_leave'] + $summary['personal_leave'] + $summary['activity_leave'];
        $total_possible_for_percentage = $summary['present'] + $summary['sick_leave'] + $summary['personal_leave'] + $summary['activity_leave'] + $summary['absent'];
        $percentage = ($total_possible_for_percentage > 0) ? ($total_for_percentage / $total_possible_for_percentage) * 100 : 0;


        return [
            'summary' => $summary,
            'details' => $details,
            'percentage' => $percentage,
        ];
    }
}
