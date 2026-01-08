<?php

namespace App\Controllers;

class ControlDashboard extends BaseController
{
    public function __construct(){
        $session = session();
     
        if(!$session->get('UserId')){
            $session->set('redirect_url', current_url());
            header("Location:".base_url()); exit();
        } 
       
    }

    public  function index()
    {
        $session = session();
        $data['uri'] = $this->request->uri;
        $data['title'] = "Dashboard";
        $data['Description'] = "แผงควบคุม";

        return view('Layout/Header',$data)
                .view('Layout/NavbarLeft')
                .view('Layout/NavbarTop')
                .view('Dashboard/index')
                .view('Layout/Footer');
    }
}