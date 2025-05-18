<?php

namespace App\Controllers;
use App\Models\ModelsLogin;
use CodeIgniter\Controller;

class ControlLogin extends BaseController
{
    public  function index()
    {
        return view('Dashboards/index');
    }

    public function loginProcess()
    {
        $session = session();
        $model = new ModelsLogin();
        $data['dbAca'] = \Config\Database::connect('default');
        $TbYearNow = $data['dbAca']->table('tb_schoolyear');
        $data['CheckYearNow'] = $TbYearNow->where('schyear_id',1)->get()->getRow();
       
        $username = $this->request->getVar('Username');
        $password = $this->request->getVar('Password');
        $user = $model->getUser($username,$password);

        if ($user) {
            $data = array('UserId'=>$user['StudentID'],
            'UserCode' => $user['StudentCode'],
            'UserClass' => $user['StudentClass'],
            'Fullname' => $user['StudentPrefix'].$user['StudentFirstName'].' '.$user['StudentLastName'],
            'CheckYearNow'=>$data['CheckYearNow']->schyear_year);
            $session->set($data);
           //return redirect()->to('Dashboard');
           echo 1;
        } else {
            $session->setFlashdata('error', 'Username or Password is incorrect');
            echo 0;
            //return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}

