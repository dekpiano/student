<?php

namespace App\Controllers;

class ControlDoGrade extends BaseController
{
    public function __construct(){
        $session = session();
     
        if(!$session->get('UserId')){
            $session->set('redirect_url', current_url());
            header("Location:".base_url()); exit();
        } 
       
    }

    public function DataMain(){
        $session = session();
        $data['uri'] = $this->request->uri;
        $data['dbAca'] = \Config\Database::connect('default');
        $data['dbPres'] = \Config\Database::connect('personnel'); 
        return $data; 
    }

    public  function index($Term = null, $Year = null)
    {
        $data = $this->DataMain();
        $data['title'] = "ดูผลการเรียน";
        $data['Description'] = "ผลการเรียน";

        $TbRegis = $data['dbAca']->table('tb_register');   
        $TbPers = $data['dbPres']->table('tb_personnel');
        $TbYearNow = $data['dbAca']->table('tb_schoolyear');

        $data['CheckYearNow'] = $TbYearNow->where('schyear_id',1)->get()->getRow();

        $TbOnoff = $data['dbAca']->table('tb_register_onoff');
        $data['CheckOnoffDoGrade'] = $TbOnoff->where('onoff_id',1)->get()->getRow();
        
        $data['CheckYearGradeUser'] = $TbRegis->select('RegisterYear')
        ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
        ->where('tb_students.StudentID',session()->get('UserId'))
        ->groupBy('RegisterYear')
        ->orderBy("SUBSTRING_INDEX(RegisterYear, '/', -1) DESC", '', false)
        ->orderBy("SUBSTRING_INDEX(RegisterYear, '/', 1) DESC", '', false)
        ->get()->getResult();

        // Default to latest year if not specified
        if ($Term === null || $Year === null) {
            if (!empty($data['CheckYearGradeUser'])) {
                list($Term, $Year) = explode('/', $data['CheckYearGradeUser'][0]->RegisterYear);
            } else {
                // Fallback to settings if no grades yet
                $Term = $data['CheckOnoffDoGrade']->onoff_term ?? '1';
                $Year = $data['CheckOnoffDoGrade']->onoff_year ?? date('Y') + 543;
            }
        }

        $data['SelectedYear'] = $Term . '/' . $Year;

        $data['Geade'] = $TbRegis->select(
            'tb_register.StudentID,
            tb_register.SubjectID,
            tb_register.RegisterYear,
            tb_register.RegisterClass,
            tb_register.TeacherID,
            tb_subjects.SubjectName,
             tb_subjects.SubjectCode,
            tb_subjects.SubjectType,
            tb_subjects.SubjectUnit,
            tb_register.Grade'
        )
        ->join('tb_subjects','tb_subjects.SubjectID = tb_register.SubjectID')
        ->where('tb_register.StudentID',session()->get('UserId'))
        ->where('tb_register.RegisterYear', $data['SelectedYear'])
        ->orderBy('tb_subjects.SubjectType','ASC')
        ->orderBy('tb_subjects.FirstGroup','ASC')  
        ->orderBy('tb_subjects.SubjectCode','ASC')
        ->get()->getResult();

        // Calculate GPAX for Stage 1 and Stage 2
        $allGrades = $TbRegis->select('tb_register.Grade, tb_subjects.SubjectUnit, tb_register.RegisterClass, tb_register.RegisterYear')
            ->join('tb_subjects', 'tb_subjects.SubjectID = tb_register.SubjectID')
            ->where('tb_register.StudentID', session()->get('UserId'))
            ->get()->getResult();

        $gpax = [
            'stage1' => ['weighted_sum' => 0, 'unit_sum' => 0, 'gpax' => '0.00', 'terms' => []],
            'stage2' => ['weighted_sum' => 0, 'unit_sum' => 0, 'gpax' => '0.00', 'terms' => []]
        ];

        foreach ($allGrades as $gradeRow) {
            $grade = $gradeRow->Grade;
            $unit = (float)$gradeRow->SubjectUnit;
            $class = $gradeRow->RegisterClass;
            $year = $gradeRow->RegisterYear;

            if (is_numeric($grade)) {
                $gradeVal = (float)$grade;
                
                // Determine stage by RegisterClass (e.g., "ม.1/1", "ม.4/5")
                if (preg_match('/ม\.[1-3]/', $class)) {
                    $gpax['stage1']['weighted_sum'] += ($gradeVal * $unit);
                    $gpax['stage1']['unit_sum'] += $unit;
                    $gpax['stage1']['terms'][$year] = true;
                } elseif (preg_match('/ม\.[4-6]/', $class)) {
                    $gpax['stage2']['weighted_sum'] += ($gradeVal * $unit);
                    $gpax['stage2']['unit_sum'] += $unit;
                    $gpax['stage2']['terms'][$year] = true;
                }
            }
        }

        if ($gpax['stage1']['unit_sum'] > 0) {
            $gpax['stage1']['gpax'] = number_format($gpax['stage1']['weighted_sum'] / $gpax['stage1']['unit_sum'], 2);
        }
        if ($gpax['stage2']['unit_sum'] > 0) {
            $gpax['stage2']['gpax'] = number_format($gpax['stage2']['weighted_sum'] / $gpax['stage2']['unit_sum'], 2);
        }

        $gpax['stage1']['term_count'] = count($gpax['stage1']['terms']);
        $gpax['stage2']['term_count'] = count($gpax['stage2']['terms']);

        $data['GPAX'] = $gpax;

        //echo '<pre>';print_r($data['CheckYearGradeUser']); exit();

        return view('Layout/Header',$data)
                .view('Layout/NavbarLeft')
                .view('Layout/NavbarTop')
                .view('DoGrade/index')
                .view('Layout/Footer');
    }

    
}