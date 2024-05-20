<?php

namespace App\Controllers;
use App\Models\User_model;
use App\Models\Agent_model;
use App\Models\Machine_model;
use App\Models\Headset_model;
use App\Models\Mouse_model;
use App\Models\Keyboard_model;
use App\Models\Monitor_model;
use App\Models\Phone_model;
use App\Models\Agent_monitor;
use App\Models\Laptop_model;
use App\Models\Webcam_model;
use App\Models\Locker_model;
use App\Models\Account_model;
use App\Models\FiveGsimcard_model;

class Viewers extends BaseController
{
    protected $db;
    public function __construct() {
        helper(['url', 'form','session']);
        $this->db = \Config\Database::connect();
    }

    public function views_dashboard()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Agent_model = new Agent_model();
        $Account_model = new Account_model();
        $Agent_model = new Agent_model();
        $Headset_model = new Headset_model();
        $Keyboard_model = new Keyboard_model();
        $Laptop_model = new Laptop_model();
        $Locker_model = new Locker_model();
        $Machine_model = new Machine_model();
        $Monitor_model = new Monitor_model();
        $Mouse_model = new Mouse_model();
        $Phone_model = new Phone_model();
        $Webcam_model = new Webcam_model();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';  
          
        $userData = $Account_model->find($userId);

        $data = [
            'count_agents' => $Agent_model->countAllResults(),
            'count_headset' => $Headset_model->countAllResults(),
            'count_keyboard' => $Keyboard_model->countAllResults(),
            'count_laptop' => $Laptop_model->countAllResults(),
            'count_locker' => $Locker_model->countAllResults(),
            'count_cpu' => $Machine_model->countAllResults(),
            'count_monitor' => $Monitor_model->countAllResults(),
            'count_mouse' => $Mouse_model->countAllResults(),
            'count_phone' => $Phone_model->countAllResults(),
            'count_webcam' => $Webcam_model->countAllResults(),
            'userData' => $userData,
        ];
        return view('viewers/views_dashboard',$data);
    }

    public function agent_list_viewers()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Agent_model();


        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
         $userData = $Account_model->find($userId);

        $data=[
            'agent_list' => $model->findAll(),
            'userData' => $userData,
        ];

        return view('viewers/agent_list_viewers',$data);
    }

    public function cpu_list_viewers()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Machine_model();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
        $userData = $Account_model->find($userId);

        $data = [
            'cpu_list' => $model->findAll(),
            'machines' => $model->findAll(),
            'count_unassigned' => $model->where('status', 'Unassigned')->countAllResults(),
            'count_assigned' => $model->where('status', 'Assigned')->countAllResults(),
            'count_unserviceable' => $model->where('status', 'Unserviceable')->countAllResults(),
            'count_newModel' => $model->where('conditions', 'New Model')->countAllResults(),
            'count_oldModel' => $model->where('conditions', 'Old Model')->countAllResults(),
            'count_AsignedNewModel' => $model->where('conditions', 'New Model')->where('status', 'Assigned')->countAllResults(),
            'count_AsignedOldModel' => $model->where('conditions', 'Old Model')->where('status', 'Assigned')->countAllResults(),
            'userData' => $userData,
         ];
        
 

        return view('viewers/views_cpu',$data);
    }

    public function headset_list_viewers()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Headset_model();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
        $userData = $Account_model->find($userId);

        $data = [
            'headset_list' => $model->findAll(),
            'userData' => $userData,
         ];
        return view('viewers/views_headset',$data);
    }

    public function mouse_list_viewers()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Mouse_model();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
        $userData = $Account_model->find($userId);

        $data = [
            'mouse_list' => $model->findAll(),
            'userData' => $userData,
         ];

        return view('viewers/views_mouse',$data);
    }

    public function keyboard_list_viewers()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Keyboard_model();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
        $userData = $Account_model->find($userId);


        $data = [
            'keyboard_list' => $model->findAll(),
            'userData' => $userData,
         ];

        return view('viewers/views_keyboard',$data);
    }

    public function monitor_list_viewers()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
        $userData = $Account_model->find($userId);

        $model = new Monitor_model();
        $data = [
            'monitor_list' => $model->findAll(),
            'userData' => $userData,
         ];

        return view('viewers/views_monitor',$data);
    }

    public function agentmonitor_list_viewers()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Agent_monitor();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
        $userData = $Account_model->find($userId);

        $data = [
            'agentmonitor_list' => $model->findAll(),
            'userData' => $userData,
         ];

        return view('viewers/views_agentmonitor',$data);
    }

    public function phone_list_viewers()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Phone_model();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
        $userData = $Account_model->find($userId);

        $data = [
            'phone_list' => $model->findAll(),
            'userData' => $userData,
         ];

        return view('viewers/views_phone',$data);
    }

    public function sgsimcard_list_viewers()
    {
        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new FiveGsimcard_model();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
        $userData = $Account_model->find($userId);

        $data = [
            'sgsimcard_list' => $model->findAll(),
            'userData' => $userData,
         ];

        return view('viewers/views_sgsimcard',$data);
    }
    public function laptop_list_viewers()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Laptop_model();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
        $userData = $Account_model->find($userId);

        $data = [
            'laptop_list' => $model->findAll(),
            'userData' => $userData,
         ];

        return view('viewers/views_laptop',$data);
    }

    public function webcam_list_viewers()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Webcam_model();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
        $userData = $Account_model->find($userId);

        $data = [
            'webcam_list' => $model->findAll(),
            'userData' => $userData,
         ];

        return view('viewers/views_webcam',$data);
    }

    public function locker_list_viewers()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isViewers'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Locker_model();

        $userId = session()->get('isViewers')? $useSessionData['viewers_id']: '';        
        $userData = $Account_model->find($userId);

        $data = [
            'locker_list' => $model->findAll(),
            'userData' => $userData,
         ];

        return view('viewers/views_locker',$data);
    }
    
}
