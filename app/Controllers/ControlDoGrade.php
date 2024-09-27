<?php

namespace App\Controllers;

class ControlDoGrade extends BaseController
{
    public function __construct(){
        $session = session();
     
        if(!$session->get('UserId')){
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

    public  function index($Term,$Year)
    {
        $data = $this->DataMain();
        $data['Title'] = "ดูผลการเรียน";
        $data['Description'] = "ผลการเรียน";

        $TbRegis = $data['dbAca']->table('tb_register');   
        $TbPers = $data['dbPres']->table('tb_personnel');
        $TbYearNow = $data['dbAca']->table('tb_schoolyear');

        $data['CheckYearNow'] = $TbYearNow->where('schyear_id',1)->get()->getRow();

        $TbOnoff = $data['dbAca']->table('tb_register_onoff');
        $data['CheckOnoffDoGrade'] = $TbOnoff->where('onoff_id',1)->get()->getRow();
        

        $data['Geade'] = $TbRegis->select(
            'tb_register.StudentID,
            tb_register.SubjectCode,
            tb_register.RegisterYear,
            tb_register.RegisterClass,
            tb_register.TeacherID,
            tb_subjects.SubjectName,
            tb_subjects.SubjectType,
            tb_subjects.SubjectUnit,
            tb_register.Grade'
        )
        ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
        ->where('tb_register.RegisterYear',$Term.'/'.$Year)
        ->where('tb_register.StudentID',session()->get('UserId'))
        ->where('tb_subjects.SubjectYear',$Term.'/'.$Year)
        ->orderBy('tb_register.SubjectCode','ASC')
        ->get()->getResult();

        //echo '<pre>';print_r($data['CheckYearNow']); exit();

        return view('Layout/Header',$data)
                .view('Layout/NavbarLeft')
                .view('Layout/NavbarTop')
                .view('DoGrade/index')
                .view('Layout/Footer');
    }

    
}