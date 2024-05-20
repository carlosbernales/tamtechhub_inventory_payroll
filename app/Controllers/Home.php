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
use CodeIgniter\API\ResponseTrait;
use App\Models\Agent_files;
use App\Models\Agent_leave;
use App\Models\Attendance_model;
use CodeIgniter\Files\File;


class Home extends BaseController
{
    use ResponseTrait;
    protected $db;
    public function __construct() {
        helper(['url', 'form','session']);
        $this->db = \Config\Database::connect();
    }
     
    public function index()
    {
        $session = session();
        
        if ($session->get('isLoggedIn')) {
            $isAdmin = $session->get('isAdmin');
            $isSuperAdmin = $session->get('isSuperAdmin');
            $isViewers = $session->get('isViewers');
            $isIT = $session->get('isIT');
            $isPayrollAdmin = $session->get('isPayrollAdmin');
            $isPayrollSuperAdmin = $session->get('isPayrollSuperAdmin');

    
            if ($isAdmin) {
                return redirect()->to('dashboard');
            } elseif ($isSuperAdmin) {
                return redirect()->to('dashboard');
            } elseif ($isIT) {
                return redirect()->to('dashboard');
            } elseif ($isViewers) {
                return redirect()->to('dashboard/viewers');
            } elseif ($isPayrollAdmin) {
                return redirect()->to('payroll/agents');
            } elseif ($isPayrollSuperAdmin) {
                return redirect()->to('payroll/agents');
            } else {
                return redirect()->to('/');
            }
        }
        return view('login');
    }

    //users
    public function users()
    {
        $useSessionData = session()->get();

        $model = new Account_model();
        
        if (!session()->get('isLoggedIn') || !session()->get('isSuperAdmin')) {
            return redirect()->to('/');
        }
        $userId = session()->get('isSuperAdmin')
        ? $useSessionData['superadmin_id']
        : $useSessionData['admin_id'];

        $userData = $model->find($userId);
        $data = [
            'userData' => $userData,
            'users' => $model->findAll(),
        ];

        return view('admin/users', $data);
    }

    //dashboard

    public function dashboard()
    {
        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
       
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
        $Account_model = new Account_model();

        $userId = session()->get('isSuperAdmin')
        ? $useSessionData['superadmin_id']
        : (session()->get('isIT')
            ? $useSessionData['IT_id']
            : $useSessionData['admin_id']);
    
    $userData = $Account_model->find($userId);
    
        $data = [
            'count_agents' => $Agent_model->where('status', 'Active')->countAllResults(),
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
        return view('admin/dashboard',$data);
    }

    //Agenttt




    public function agent_list()
    {
        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Agent_model();
        
        $userId = session()->get('isSuperAdmin')
        ? $useSessionData['superadmin_id']
        : $useSessionData['admin_id'];
        $userData = $Account_model->find($userId);

        $start_date = $model->select("DATE_FORMAT(start_date, '%M %e, %Y') AS start_date_formatted, agent_list.*")->where('status', 'Active')->findAll();

        $data = [
            'userData' => $userData,
            'agent_list' => $start_date,
        ];

        return view('admin/agent_list',$data);
    }




    public function add_agent()
    {
        $model = new Agent_model();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin'))) {
            return redirect()->to('/');
        }        
        
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = [
                'agent_name' => $this->request->getVar('agent_name'),
                'agent_id' => $this->request->getVar('agent_id'),
                'campaign' => $this->request->getVar('campaign'),
                'start_date' => $this->request->getVar('start_date'),
            ];
            if ($model->save($data)) {
                return redirect()->to('agents')
                    ->with('status_icon', 'success')
                    ->with('status', 'Success');
            }
        }

        return view('admin/agent_list', $data);
    }

    public function check_agent_id()
    {
        $model = new Agent_model();
        $agent_id = $this->request->getPost('agent_id');
        
        if ($agent_id !== 'None' || $agent_id !== '') {
            $existingRecord = $model->where('agent_id', $agent_id)->first();
            if ($existingRecord) {
                $response['exists'] = true;
            } else {
                $response['exists'] = false;
            }
        } else {
            $response['exists'] = false; 
        }
        return $this->response->setJSON($response);
    }
    
    

    public function agents_update($id)
    {
        $agentModel = new Agent_model(); 
        $Agent_leave = new Agent_leave();
        $Attendance_model = new Attendance_model();

       if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin'))) {
            return redirect()->to('/');
        }

        $id = $this->request->getPost('id');

        $data = [
            'agent_name' => $this->request->getPost('agent_name'), 
            'campaign' => $this->request->getPost('campaign'),
            'start_date' => $this->request->getPost('start_date'),
            'agent_id' => $this->request->getPost('agent_id'),
        ];

        $agentModel->update($id, $data);
        
        $Attendance_model->where('agent_id', $this->request->getPost('agent_old'))
                     ->set('agent_name', $this->request->getPost('agent_name'))
                     ->set('agent_id', $this->request->getPost('agent_id'))
                     ->update();
    
        $Agent_leave->where('agent_fk_id', $id)
                    ->set('agent_id', $this->request->getPost('agent_id'))
                    ->update();

        return redirect()->back()
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }
    
    public function delete_agents($id)
    {
        $agentModel = new Agent_model();
        $agentFilesModel = new Agent_files(); 
    
        if (!session()->isLoggedIn || (!session()->isAdmin && !session()->isSuperAdmin && !session()->isIT)) {
            return redirect()->to('/');
        }
        $folderPath = FCPATH  . 'userFiles/' . $id;
    
        if (is_dir($folderPath)) {
            $this->deleteDirectory($folderPath);
        }
        $agentFilesModel->where('agent_fk_id', $id)->delete();
    
        $agentModel->delete($id);
    
        return redirect()->back()
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }
    
    
    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }
    
        if (!is_dir($dir)) {
            return unlink($dir);
        }
    
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
    
        return rmdir($dir);
    }

    //Agenttt

    //IT agent list
    public function IT_agent_list()
    {
        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isIT'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Agent_model();
        
        $userId = session()->get('isIT')
        ? $useSessionData['IT_id']
        : $useSessionData['superadmin_id'];
        
        $userData = $Account_model->find($userId);

        $start_date = $model->select("DATE_FORMAT(start_date, '%M %e, %Y') AS start_date_formatted, agent_list.*")->where('status','Active')->findAll();

        $data = [
            'userData' => $userData,
            'agent_list' => $start_date,
        ];

        return view('IT/agent_list_it',$data);
    }

    public function IT_add_agent()
    {
        $model = new Agent_model();

        if (!session()->get('isLoggedIn') || (!session()->get('isIT'))) {
            return redirect()->to('/');
        }        
        
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = [
                'agent_name' => $this->request->getVar('agent_name'),
                'agent_id' => $this->request->getVar('agent_id'),
                'campaign' => $this->request->getVar('campaign'),
            ];
            if ($model->save($data)) {
                return redirect()->to('IT_agent/list')
                    ->with('status_icon', 'success')
                    ->with('status', 'Success');
            }
        }

        return view('IT/agent_list_it', $data);
    }

    public function IT_agents_update($id)
    {
        $agentModel = new Agent_model(); 
        $Agent_leave = new Agent_leave();
        $Attendance_model = new Attendance_model();

        if (!session()->get('isLoggedIn') || (!session()->get('isIT'))) {
            return redirect()->to('/');
        }

        $id = $this->request->getPost('id');

        $data = [
            'agent_name' => $this->request->getPost('agent_name'), 
            'campaign' => $this->request->getPost('campaign'),
            'agent_id' => $this->request->getPost('agent_id'),
        ];

        $agentModel->update($id, $data);
        
        $Attendance_model->where('agent_id', $this->request->getPost('agent_old'))
                     ->set('agent_name', $this->request->getPost('agent_name'))
                     ->set('agent_id', $this->request->getPost('agent_id'))
                     ->update();
    
        $Agent_leave->where('agent_fk_id', $id)
                    ->set('agent_id', $this->request->getPost('agent_id'))
                    ->update();

        return redirect()->to('IT_agent/list')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }

    //IT agent list

    

    
    //machine

    public function machine_list()
     {

        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }

        $model = new Machine_model();
        $Agent_model = new Agent_model();
        $Account_model = new Account_model();
     
         $agents = $Agent_model->where('status','Active')->orderBy('agent_name', 'asc')->findAll();
         $valid_agents = [];
     
         foreach ($agents as $agent) {
             $agent_id = $agent['id'];
             $agent_exists = $model->where('agent_fk_id', $agent_id)->first();
     
             if (!$agent_exists) {
                 $valid_agents[] = $agent;
             }
         }

         $userId = session()->get('isSuperAdmin')
         ? $useSessionData['superadmin_id']
         : (session()->get('isIT')
             ? $useSessionData['IT_id']
             : $useSessionData['admin_id']);

        $userData = $Account_model->find($userId);
         $data = [
            'machine' => $model->findAll(),
            'agent' => $valid_agents,
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
     
         return view('admin/desktop', $data);
     }

    public function add_cpu()
    {
        $model = new Machine_model();
        $data = [];

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }

        if ($this->request->getMethod() == 'post') {
            $data = [
                'station_no' => $this->request->getVar('station_no'),
                'static_ip' => $this->request->getVar('static_ip'),
                'equip_id' => $this->request->getVar('equip_id'),
                'processor' => $this->request->getVar('processor'),
                'ram_size' => $this->request->getVar('ram_size'),
                'storage_type' => $this->request->getVar('storage_type'),
                'brand' => $this->request->getVar('brand'),
                'model' => $this->request->getVar('model'),
                'conditions' => $this->request->getVar('conditions'),
            ];
            if ($model->save($data)) {
                return redirect()->to('machine')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
            }
        }
        return view('admin/desktop', $data);
    }

    public function cpu_check_equip_id()
    {
        $model = new Machine_model();
        $equip_id = $this->request->getPost('cpu_equip_id');
        $existingRecord = $model->where('equip_id', $equip_id)->first();
        if ($existingRecord) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
        return $this->response->setJSON($response);
    }

    public function update_machine($id)
    {
        $Machine_model = new Machine_model(); 

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }

        $agent_fk_id = $this->request->getPost('agent_fk_id');
        $status = $this->request->getPost('status');
        
        $id = $this->request->getPost('id');

        $data = [];

        if ($this->request->getPost('station_no') !== '') {
            $data['station_no'] = $this->request->getPost('station_no');
        }
        if ($this->request->getPost('static_ip') !== '') {
            $data['static_ip'] = $this->request->getPost('static_ip');
        }

        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        }

        if ($this->request->getPost('status') !== '') {
            $data['status'] = $this->request->getPost('status');
        }
        if ($this->request->getPost('agent') !== '') {
            $data['agent'] = $this->request->getPost('agent');
        }
        
        if ($this->request->getPost('brand') !== '') {
            $data['brand'] = $this->request->getPost('brand');
        }
        if ($this->request->getPost('model') !== '') {
            $data['model'] = $this->request->getPost('model');
        }

        if ($this->request->getPost('ram_size') !== '') {
            $data['ram_size'] = $this->request->getPost('ram_size');
        }
        if ($this->request->getPost('processor') !== '') {
            $data['processor'] = $this->request->getPost('processor');
        }
        if ($this->request->getPost('storage_type') !== '') {
            $data['storage_type'] = $this->request->getPost('storage_type');
        }
        if ($this->request->getPost('conditions') !== '') {
            $data['conditions'] = $this->request->getPost('conditions');
        }
        if ($this->request->getPost('comment') !== '') {
            $data['comment'] = $this->request->getPost('comment');
        }

        if ($agent_fk_id == 0 ) {
            $data['status'] = 'Unassigned';
        } else if($agent_fk_id == '') {
            $data['status'] = $this->request->getPost('status');
            $data['agent_fk_id'] = 'NULL';
            $data['agent'] = 'NULL';
        } else {
            $data['status'] = 'Assigned';
        }
        

        if (!empty($data)) {
            $Machine_model->update($id, $data);
        }
        
        return redirect()->to('machine')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }


    public function cpu_check_agentID()
    {
        $model = new Machine_model();
        $agent_id = $this->request->getPost('agent_id');
        $response = ['exists' => false]; 

        if ($agent_id !== 'None' && $agent_id != 0 && $agent_id !== ''){
            $existingRecord = $model->where('agent_fk_id', $agent_id)->first();
            if ($existingRecord) {
                $response['exists'] = true;
            }
        }

        return $this->response->setJSON($response);
    }

    public function delete_machine($id)
    {
        $Machine_model = new Machine_model();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }

        $Machine_model->delete($id);

        return redirect()->to('machine')
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }

     //machine

     //headset
     public function headset_list()
     {
        $useSessionData = session()->get();

        $Account_model = new Account_model();
        $model = new Headset_model();
        $Agent_model = new Agent_model();


        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
     
        $agents = $Agent_model->where('status','Active')->orderBy('agent_name', 'asc')->findAll();
         $valid_agents = [];
     
         foreach ($agents as $agent) {
             $agent_id = $agent['id'];
             $agent_exists = $model->where('agent_fk_id', $agent_id)->first();
     
             if (!$agent_exists) {
                 $valid_agents[] = $agent;
             }
         }
         $userId = session()->get('isSuperAdmin')
         ? $useSessionData['superadmin_id']
         : (session()->get('isIT')
             ? $useSessionData['IT_id']
             : $useSessionData['admin_id']);

         $userData = $Account_model->find($userId);
         $data = [
             'headset' => $model->findAll(),
             'agent' => $valid_agents,
             'userData' => $userData,

         ];
     
         return view('admin/headset', $data);
     }
     
    public function add_headset()
    {
        $model = new Headset_model();
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = [
                'equip_id' => $this->request->getVar('equip_id'),
                'brand' => $this->request->getVar('brand'),
                'model' => $this->request->getVar('model'),
                'condition' => $this->request->getVar('condition'),
                'comment' => $this->request->getVar('comment'),
            ];
            if ($model->save($data)) {
                return redirect()->to('headset')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
            }
        }
        return view('admin/headset', $data);
    }

    public function headset_check_equip_id()
    {
        $model = new Headset_model();
        $equip_id = $this->request->getPost('headset_equip_id');
        $existingRecord = $model->where('equip_id', $equip_id)->first();
        if ($existingRecord) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
        return $this->response->setJSON($response);
    }

    public function update_headset($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Headset_model = new Headset_model(); 


        $agent_fk_id = $this->request->getPost('agent_fk_id');
        
        $id = $this->request->getPost('id');

        $data = [];


        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        }
        if ($this->request->getPost('agent') !== '') {
            $data['agent'] = $this->request->getPost('agent');
        }
        if ($this->request->getPost('status') !== '') {
            $data['status'] = $this->request->getPost('status');
        }
        if ($this->request->getPost('brand') !== '') {
            $data['brand'] = $this->request->getPost('brand');
        }
        if ($this->request->getPost('model') !== '') {
            $data['model'] = $this->request->getPost('model');
        }
        
        if ($this->request->getPost('condition') !== '') {
            $data['condition'] = $this->request->getPost('condition');
        }
        if ($this->request->getPost('comment') !== '') {
            $data['comment'] = $this->request->getPost('comment');
        }

        if ($agent_fk_id == 0 ) {
            $data['status'] = 'Unassigned';
        } else if($agent_fk_id == '') {
            $data['status'] = $this->request->getPost('status');
            $data['agent_fk_id'] = 'NULL';
            $data['agent'] = 'NULL';
        } else {
            $data['status'] = 'Assigned';
        }

        if (!empty($data)) {
            $Headset_model->update($id, $data);
        }
        
        return redirect()->to('headset')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }
    

    public function headset_check_agentID()
    {
        $model = new Headset_model();
        $agent_id = $this->request->getPost('agent_id');
        $response = ['exists' => false]; 

        if ($agent_id !== 'None' && $agent_id != 0 && $agent_id !== ''){
            $existingRecord = $model->where('agent_fk_id', $agent_id)->first();
            if ($existingRecord) {
                $response['exists'] = true;
            }
        }

        return $this->response->setJSON($response);
    }


    public function delete_headset($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Headset_model = new Headset_model();

        $Headset_model->delete($id);

        return redirect()->to('headset')
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }
    //headset

    //mouse

    public function mouse_list()
     {
        $useSessionData = session()->get();

        $Account_model = new Account_model();
        $model = new Mouse_model();
        $Agent_model = new Agent_model();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }

     
        $agents = $Agent_model->where('status','Active')->orderBy('agent_name', 'asc')->findAll();
         $valid_agents = [];
     
         foreach ($agents as $agent) {
             $agent_id = $agent['id'];
             $agent_exists = $model->where('agent_fk_id', $agent_id)->first();
     
             if (!$agent_exists) {
                 $valid_agents[] = $agent;
             }
         }
         $userId = session()->get('isSuperAdmin')
         ? $useSessionData['superadmin_id']
         : (session()->get('isIT')
             ? $useSessionData['IT_id']
             : $useSessionData['admin_id']);
     
         $userData = $Account_model->find($userId);
         $data = [
            'mouse' => $model->findAll(),
            'agent' => $valid_agents,
            'userData' => $userData,
         ];
     
         return view('admin/mouse', $data);
     }

    public function add_mouse()
    {
        $model = new Mouse_model();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = [
                'comment' => $this->request->getVar('comment'),
                'equip_id' => $this->request->getVar('equip_id'),
                'brand' => $this->request->getVar('brand'),
                'model' => $this->request->getVar('model'),
                'mouse_condition' => $this->request->getVar('mouse_condition'),
            ];
            if ($model->save($data)) {
                return redirect()->to('mouse')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
            }
        }
        return view('admin/mouse', $data);
    }

    public function mouse_check_equip_id()
    {
        $model = new Mouse_model();
        $equip_id = $this->request->getPost('mouse_equip_id');
        $existingRecord = $model->where('equip_id', $equip_id)->first();
        if ($existingRecord) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
        return $this->response->setJSON($response);
    }
    

    public function update_mouse($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Mouse_model = new Mouse_model(); 


        $agent_fk_id = $this->request->getPost('agent_fk_id');
        
        $id = $this->request->getPost('id');

        $data = [];


        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        }
        if ($this->request->getPost('agent') !== '') {
            $data['agent'] = $this->request->getPost('agent');
        }
        if ($this->request->getPost('status') !== '') {
            $data['status'] = $this->request->getPost('status');
        }
        if ($this->request->getPost('brand') !== '') {
            $data['brand'] = $this->request->getPost('brand');
        }
        if ($this->request->getPost('model') !== '') {
            $data['model'] = $this->request->getPost('model');
        }
        
        if ($this->request->getPost('mouse_condition') !== '') {
            $data['mouse_condition'] = $this->request->getPost('mouse_condition');
        }
        if ($this->request->getPost('comment') !== '') {
            $data['comment'] = $this->request->getPost('comment');
        }

 
        if ($agent_fk_id == 0 ) {
            $data['status'] = 'Unassigned';
        } else if($agent_fk_id == '') {
            $data['status'] = $this->request->getPost('status');
            $data['agent_fk_id'] = 'NULL';
            $data['agent'] = 'NULL';
        } else {
            $data['status'] = 'Assigned';
        }

        if (!empty($data)) {
            $Mouse_model->update($id, $data);
        }
        
        return redirect()->to('mouse')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }
    

    public function mouse_check_agentID()
    {
        $model = new Mouse_model();
        $agent_id = $this->request->getPost('agent_id');
        $response = ['exists' => false]; 

        if ($agent_id !== 'None' && $agent_id != 0 && $agent_id !== ''){
            $existingRecord = $model->where('agent_fk_id', $agent_id)->first();
            if ($existingRecord) {
                $response['exists'] = true;
            }
        }

        return $this->response->setJSON($response);
    }

    public function delete_mouse($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Mouse_model = new Mouse_model();

        $Mouse_model->delete($id);

        return redirect()->to('mouse')
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }
    //mouse

    //keyboard

    public function keyboard_list()
     {
        $useSessionData = session()->get();

        $Account_model = new Account_model();
        $model = new Keyboard_model();
        $Agent_model = new Agent_model();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
    
        $agents = $Agent_model->where('status','Active')->orderBy('agent_name', 'asc')->findAll();
         $valid_agents = [];
     
         foreach ($agents as $agent) {
             $agent_id = $agent['id'];
             $agent_exists = $model->where('agent_fk_id', $agent_id)->first();
     
             if (!$agent_exists) {
                 $valid_agents[] = $agent;
             }
         }
         $userId = session()->get('isSuperAdmin')
         ? $useSessionData['superadmin_id']
         : (session()->get('isIT')
             ? $useSessionData['IT_id']
             : $useSessionData['admin_id']); 

        $userData = $Account_model->find($userId);

         $data = [
            'keyboard' => $model->findAll(),
            'agent' => $valid_agents,
            'userData' => $userData,
         ];
     
         return view('admin/keyboard', $data);
     }
    
    public function add_keyboard()
    {
        $model = new Keyboard_model();
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = [
                'keyboard_equip_id' => $this->request->getVar('keyboard_equip_id'),
                'keyboard_brand' => $this->request->getVar('keyboard_brand'),
                'keyboard_model' => $this->request->getVar('keyboard_model'),
                'keyboard_condition' => $this->request->getVar('keyboard_condition'),
                'keyboard_comment' => $this->request->getVar('keyboard_comment'),
            ];
            if ($model->save($data)) {
                return redirect()->to('keyboard')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
            }
        }
        return view('admin/keyboard', $data);
    }

    public function keyboard_check_equip_id()
    {
        $model = new Keyboard_model();
        $keyboard_equip_id = $this->request->getPost('keyboard_equip_id');
        $existingRecord = $model->where('keyboard_equip_id', $keyboard_equip_id)->first();
        if ($existingRecord) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
        return $this->response->setJSON($response);
    }

    public function update_keyboard($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Keyboard_model = new Keyboard_model(); 


        $agent_fk_id = $this->request->getPost('agent_fk_id');
        
        $id = $this->request->getPost('id');

        $data = [];


        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        }
        if ($this->request->getPost('agent') !== '') {
            $data['agent'] = $this->request->getPost('agent');
        }
        if ($this->request->getPost('keyboard_status') !== '') {
            $data['keyboard_status'] = $this->request->getPost('keyboard_status');
        }
        if ($this->request->getPost('keyboard_brand') !== '') {
            $data['keyboard_brand'] = $this->request->getPost('keyboard_brand');
        }
        if ($this->request->getPost('keyboard_model') !== '') {
            $data['keyboard_model'] = $this->request->getPost('keyboard_model');
        }
        
        if ($this->request->getPost('keyboard_condition') !== '') {
            $data['keyboard_condition'] = $this->request->getPost('keyboard_condition');
        }
        if ($this->request->getPost('keyboard_comment') !== '') {
            $data['keyboard_comment'] = $this->request->getPost('keyboard_comment');
        }

        if ($agent_fk_id == 0 ) {
            $data['keyboard_status'] = 'Unassigned';
        } else if($agent_fk_id == '') {
            $data['keyboard_status'] = $this->request->getPost('keyboard_status');
            $data['agent_fk_id'] = 'NULL';
            $data['agent'] = 'NULL';
        } else {
            $data['keyboard_status'] = 'Assigned';
        }

        if (!empty($data)) {
            $Keyboard_model->update($id, $data);
        }
        
        return redirect()->to('keyboard')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }
    

    public function keyboard_check_agentID()
    {
        $model = new Keyboard_model();
        $agent_id = $this->request->getPost('agent_id');
        $response = ['exists' => false]; 

        if ($agent_id !== 'None' && $agent_id != 0 && $agent_id !== ''){
            $existingRecord = $model->where('agent_fk_id', $agent_id)->first();
            if ($existingRecord) {
                $response['exists'] = true;
            }
        }

        return $this->response->setJSON($response);
    }

    
    

    public function delete_keyboard($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Keyboard_model = new Keyboard_model();

        $Keyboard_model->delete($id);

        return redirect()->to('keyboard')
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }
    //keyboard

    //monitor
    public function monitor_list()
    {
        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }


        $Account_model = new Account_model();
        $model = new Monitor_model();
        $Agent_model = new Agent_model();

        $userId = session()->get('isSuperAdmin')
        ? $useSessionData['superadmin_id']
        : (session()->get('isIT')
            ? $useSessionData['IT_id']
            : $useSessionData['admin_id']); 
        
        $userData = $Account_model->find($userId);

        $data=[
            'monitor' => $model->findAll(),
            'agent' => $Agent_model->findAll(),
            'userData' => $userData,

        ];

        return view('admin/monitor',$data);
    }
    public function add_monitor()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $model = new Monitor_model();
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = [
                'monitor_equip_id' => $this->request->getVar('monitor_equip_id'),
                'monitor_brand' => $this->request->getVar('monitor_brand'),
                'monitor_model' => $this->request->getVar('monitor_model'),
                'monitor_condition' => $this->request->getVar('monitor_condition'),
                'monitor_comment' => $this->request->getVar('monitor_comment'),
            ];
            if ($model->save($data)) {
                return redirect()->to('monitor')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
            }
        }
        return view('admin/monitor', $data);
    }

    public function monitor_check_equip_id()
    {
        $model = new Monitor_model();
        $monitor_equip_id = $this->request->getPost('monitor_equip_id');
        $existingRecord = $model->where('monitor_equip_id', $monitor_equip_id)->first();
        if ($existingRecord) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
        return $this->response->setJSON($response);
    }

    public function updateThemonitors($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Monitor_model = new Monitor_model(); 
        $Agent_monitor = new Agent_monitor();


        $monitor_status = $this->request->getPost('monitor_status');
        
        $id = $this->request->getPost('id');

        $data = [];

        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        }
        if ($this->request->getPost('monitor_status') !== '') {
            $data['monitor_status'] = $this->request->getPost('monitor_status');
        }
        if ($this->request->getPost('monitor_brand') !== '') {
            $data['monitor_brand'] = $this->request->getPost('monitor_brand');
        }
        if ($this->request->getPost('monitor_model') !== '') {
            $data['monitor_model'] = $this->request->getPost('monitor_model');
        }
        
        if ($this->request->getPost('monitor_condition') !== '') {
            $data['monitor_condition'] = $this->request->getPost('monitor_condition');
        }
        if ($this->request->getPost('monitor_comment') !== '') {
            $data['monitor_comment'] = $this->request->getPost('monitor_comment');
        }

        if (!empty($data)) {
            $Monitor_model->update($id, $data);
        }
        if ($monitor_status !== 'Assigned') {
            $Agent_monitor->where('monitor_one_fk', $id)
                        ->set('monitor_one_fk', 0)
                        ->set('monitor_one', 'None')
                        ->update();
        }

        if ($monitor_status !== 'Assigned') {
            $Agent_monitor->where('monitor_two_fk', $id)
                        ->set('monitor_two_fk', 0)
                        ->set('monitor_two', 'None')
                        ->update();
        }
        
        return redirect()->to('monitor')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }
    
    public function delete_monitor($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Monitor_model = new Monitor_model();

        $Monitor_model->delete($id);

        return redirect()->to('monitor')
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }
    //monitor

    //agentmonitor

    public function agent_monitor()
    {
        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }


        $Account_model = new Account_model();
        $model = new Agent_monitor();
        $Monitor_model = new Monitor_model();
        $Agent_model = new Agent_model();

        $agents = $Agent_model->where('status','Active')->orderBy('agent_name', 'asc')->findAll();
        $valid_agents = [];
    
        foreach ($agents as $agent) {
            $agent_id = $agent['id'];
            $agent_exists = $model->where('agent_fk_id', $agent_id)->first();
    
            if (!$agent_exists) {
                $valid_agents[] = $agent;
            }
        }
    
        $monitors = $Monitor_model->where('monitor_status', 'Unassigned')->orderBy('monitor_equip_id', 'asc')->findAll();
        $valid_monitor = [];
    
        foreach ($monitors as $monitor) {
            $monitor_id = $monitor['id'];
            $monitor_exists = $model->where('monitor_one_fk', $monitor_id)->orWhere('monitor_two_fk', $monitor_id)->first();
    
            if (!$monitor_exists) {
                $valid_monitor[] = $monitor;
            }
        }

        $userId = session()->get('isSuperAdmin')
        ? $useSessionData['superadmin_id']
        : (session()->get('isIT')
            ? $useSessionData['IT_id']
            : $useSessionData['admin_id']); 
        
        $userData = $Account_model->find($userId);
    
        $data = [
            'agent_monitor' => $model->findAll(),
            'monitor' => $valid_monitor,
            'agent' => $valid_agents,
            'userData' => $userData,
        ];
    
        return view('admin/agent_monitor', $data);
    }
    

    public function addagent_monitor()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $model = new Agent_monitor();
        $Monitor_model = new Monitor_model();
        $data = [];

        $agent_fk_id = $this->request->getVar('agent_fk_id');
        $agent = $this->request->getVar('agent');
        $monitor_one = $this->request->getVar('monitor_one');
        $monitor_two = $this->request->getVar('monitor_two');
        $monitor_one_fk = $this->request->getVar('monitor_one_fk');
        $monitor_two_fk = $this->request->getVar('monitor_two_fk');

        $data = [
            'agent_fk_id' => $agent_fk_id,
            'agent' => $agent,
            'monitor_one' => !empty($monitor_one) ? $monitor_one : 'None',
            'monitor_two' => !empty($monitor_two) ? $monitor_two : 'None',
            'monitor_one_fk' => !empty($monitor_one_fk) ? $monitor_one_fk : 0,
            'monitor_two_fk' => !empty($monitor_two_fk) ? $monitor_two_fk : 0,
        ];

        if ($monitor_two_fk !== '') {
            $Monitor_model->where('id', $monitor_two_fk)
                        ->set('monitor_status', 'Assigned')
                        ->set('agent_fk_id', $agent_fk_id)
                        ->update();
        }

        if ($monitor_one_fk !== '' ) {
            $Monitor_model->where('id', $monitor_one_fk)
                        ->set('monitor_status', 'Assigned')
                        ->set('agent_fk_id', $agent_fk_id)
                        ->update();
        }

        if ($model->save($data)) {
            return redirect()->to('agent_monitor')
                ->with('status_icon', 'success')
                ->with('status', 'Success');
        }

        

        return view('admin/agent_monitor', $data);
    }

    public function addagent_monitor_check_agent()
    {
        $model = new Agent_monitor();
        $agent_id = $this->request->getPost('agent_id');
        $response = ['exists' => false]; 

        if ($agent_id !== 'None' && $agent_id != 0 && $agent_id !== ''){
            $existingRecord = $model->where('agent_fk_id', $agent_id)->first();
            if ($existingRecord) {
                $response['exists'] = true;
            }
        }

        return $this->response->setJSON($response);
    }

    // public function addagent_monitor_one_check()
    // {
    //     $model = new Agent_monitor();
    //     $monitor_equip_id = $this->request->getPost('monitor_equip_id');

    //     $response = ['exists' => false]; 

    //     if ($monitor_equip_id !== 'None' && $monitor_equip_id != 0 && $monitor_equip_id !== '') {
    //         $existingRecord = $model->where('monitor_one_fk', $monitor_equip_id)
    //                                 ->orWhere('monitor_two_fk', $monitor_equip_id)
    //                                 ->first();

    //         if ($existingRecord) {
    //             $response['exists'] = true;
    //         }
    //     }

    //     return $this->response->setJSON($response);
    // }


        
    public function updates_monitor_agent($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Agent_monitor = new Agent_monitor(); 
        $Monitor_model = new Monitor_model(); 

        $monitor_one_fk = $this->request->getPost('monitor_one_fk');
        $monitor_two_fk = $this->request->getPost('monitor_two_fk');
        $monitor_two_fk_change = $this->request->getPost('monitor_two_fk_change');
        $monitor_one_fk_change = $this->request->getPost('monitor_one_fk_change');

        $agent_fk_id = $this->request->getPost('agent_fk_id');

        $agent_fk_id_old = $this->request->getPost('agent_fk_id_old');
        
        $id = $this->request->getPost('id');

        $data = [];

        if ($monitor_one_fk != 0 && $monitor_two_fk != 0 && $monitor_one_fk == $monitor_two_fk) {
            return redirect()->to('agent_monitor')
                             ->with('status_icon', 'error')
                             ->with('status', 'Both monitor cannot be the same.');
        }

        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        } else {
            $data['agent_fk_id'] = $agent_fk_id_old;
        }
        if ($this->request->getPost('agent') !== '') {
            $data['agent'] = $this->request->getPost('agent');
        }
        
        if ($this->request->getPost('monitor_one') !== '') {
            $data['monitor_one'] = $this->request->getPost('monitor_one');
        }
        if ($this->request->getPost('monitor_two') !== '') {
            $data['monitor_two'] = $this->request->getPost('monitor_two');
        }
        if ($this->request->getPost('monitor_one_fk') !== '') {
            $data['monitor_one_fk'] = $this->request->getPost('monitor_one_fk');
        }
        if ($this->request->getPost('monitor_two_fk') !== '') {
            $data['monitor_two_fk'] = $this->request->getPost('monitor_two_fk');
        }

        if (!empty($data)) {
            $Agent_monitor->update($id, $data);
        }
        
        if ($monitor_one_fk !== $monitor_one_fk_change && $agent_fk_id === 0 ) {
            $Monitor_model->where('agent_fk_id', $agent_fk_id_old)
                        ->set('monitor_status', 'Unassigned')
                        ->set('agent_fk_id', 0)
                        ->update();
        }

        if ($monitor_two_fk !== $monitor_two_fk_change && $agent_fk_id === 0 ) {
            $Monitor_model->where('agent_fk_id', $agent_fk_id_old)
                        ->set('monitor_status', 'Unassigned')
                        ->set('agent_fk_id', 0)
                        ->update();
        }

        if ($monitor_one_fk !== $monitor_one_fk_change && $agent_fk_id !== 0 ) {
            $Monitor_model->where('agent_fk_id', $agent_fk_id_old)
                        ->set('monitor_status', 'Unassigned')
                        ->set('agent_fk_id', 0)
                        ->update();
        }

        if ($monitor_two_fk !== $monitor_two_fk_change && $agent_fk_id !== 0 ) {
            $Monitor_model->where('agent_fk_id', $agent_fk_id_old)
                        ->set('monitor_status', 'Unassigned')
                        ->set('agent_fk_id', 0)
                        ->update();
        }
        if ($monitor_one_fk !== 0 && $agent_fk_id === 0 ) {
            $Monitor_model->where('id', $monitor_one_fk)
                        ->set('monitor_status', 'Assigned')
                        ->set('agent_fk_id', $agent_fk_id_old)
                        ->update();
        }
        if ($monitor_two_fk !== 0 && $agent_fk_id === 0 ) {
            $Monitor_model->where('id', $monitor_two_fk)
                        ->set('monitor_status', 'Assigned')
                        ->set('agent_fk_id', $agent_fk_id_old)
                        ->update();
        }

        if ($monitor_one_fk !== 0 && $agent_fk_id !== 0 ) {
            $Monitor_model->where('id', $monitor_one_fk)
                        ->set('monitor_status', 'Assigned')
                        ->set('agent_fk_id', $agent_fk_id)
                        ->update();
        }
        if ($monitor_two_fk !== 0 && $agent_fk_id !== 0 ) {
            $Monitor_model->where('id', $monitor_two_fk)
                        ->set('monitor_status', 'Assigned')
                        ->set('agent_fk_id', $agent_fk_id)
                        ->update();
        }
        
        if (
            $monitor_one_fk == 0 && $monitor_two_fk == 0 || $agent_fk_id == 0 
        ) {
            $Monitor_model->whereIn('id', [$monitor_one_fk,$monitor_two_fk ])
                        ->set('monitor_status', 'Unassigned')
                        ->update();
            $Agent_monitor->delete($id);
    
            return redirect()->to('agent_monitor')
                             ->with('status_icon', 'success')
                             ->with('status', 'Success');
        }
        return redirect()->to('agent_monitor')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }

    //agentmonitor


    //phone

    public function phone_list()
     {
        $useSessionData = session()->get();
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }


         $model = new Phone_model();
         $Agent_model = new Agent_model();
         $Account_model = new Account_model();

        $agents = $Agent_model->where('status','Active')->orderBy('agent_name', 'asc')->findAll();
         $valid_agents = [];
     
         foreach ($agents as $agent) {
             $agent_id = $agent['id'];
             $agent_exists = $model->where('agent_fk_id', $agent_id)->first();
     
             if (!$agent_exists) {
                 $valid_agents[] = $agent;
             }
         }
         $userId = session()->get('isSuperAdmin')
         ? $useSessionData['superadmin_id']
         : (session()->get('isIT')
             ? $useSessionData['IT_id']
             : $useSessionData['admin_id']);
            
        $userData = $Account_model->find($userId);
         $data = [
            'phone' => $model->findAll(),
            'agent' => $agents,
            'userData' => $userData,
         ];
     
         return view('admin/phone', $data);
     }
    

    public function add_phone()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $model = new Phone_model();
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = [
                'phone_equip_id' => $this->request->getVar('phone_equip_id'),
                'phone_brand' => $this->request->getVar('phone_brand'),
                'phone_model' => $this->request->getVar('phone_model'),
                'phone_condition' => $this->request->getVar('phone_condition'),
                'monitor_condition' => $this->request->getVar('monitor_condition'),
                'phone_comment' => $this->request->getVar('phone_comment'),

            ];
            if ($model->save($data)) {
                return redirect()->to('phone/list')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
            }
        }
        return view('admin/phone', $data);
    }

    public function phone_check_equip_id()
    {
        $model = new Phone_model();
        $phone_equip_id	 = $this->request->getPost('phone_equip_id');
        $existingRecord = $model->where('phone_equip_id', $phone_equip_id)->first();
        if ($existingRecord) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
        return $this->response->setJSON($response);
    }

   

    public function phone_check_agentID()
    {
        $model = new Phone_model();
        $agent_id = $this->request->getPost('agent_id');
        $response = ['exists' => false]; 

        if ($agent_id !== 'None' && $agent_id != 0 && $agent_id !== ''){
            $existingRecord = $model->where('agent_fk_id', $agent_id)->first();
            if ($existingRecord) {
                $response['exists'] = true;
            }
        }

        return $this->response->setJSON($response);
    }

    

    public function update_phone($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Phone_model = new Phone_model(); 


        $agent_fk_id = $this->request->getPost('agent_fk_id');
        
        $id = $this->request->getPost('id');

        $data = [];


        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        }
        if ($this->request->getPost('phone_agent_name') !== '') {
            $data['phone_agent_name'] = $this->request->getPost('phone_agent_name');
        }
        if ($this->request->getPost('phone_status') !== '') {
            $data['phone_status'] = $this->request->getPost('phone_status');
        }
        if ($this->request->getPost('phone_brand') !== '') {
            $data['phone_brand'] = $this->request->getPost('phone_brand');
        }
        if ($this->request->getPost('phone_model') !== '') {
            $data['phone_model'] = $this->request->getPost('phone_model');
        }
        
        if ($this->request->getPost('phone_condition') !== '') {
            $data['phone_condition'] = $this->request->getPost('phone_condition');
        }
        if ($this->request->getPost('phone_comment') !== '') {
            $data['phone_comment'] = $this->request->getPost('phone_comment');
        }

        if ($agent_fk_id == 0 ) {
            $data['phone_status'] = 'Unassigned';
        } else if($agent_fk_id == '') {
            $data['phone_status'] = $this->request->getPost('phone_status');
            $data['agent_fk_id'] = 'NULL';
            $data['phone_agent_name'] = 'NULL';
        } else {
            $data['phone_status'] = 'Assigned';
        }

        if (!empty($data)) {
            $Phone_model->update($id, $data);
        }
        
        return redirect()->to('phone/list')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }

    public function update_phone_one($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Phone_model = new Phone_model(); 

        $id = $this->request->getPost('id');

        $data = [
            'phone_number_one' => $this->request->getPost('phone_number_one'),
            'whatsapp_acc_one' => $this->request->getPost('whatsapp_acc_one'),
            'whatsapp_acc_one_cond' => $this->request->getPost('whatsapp_acc_one_cond'),
        ];

        $Phone_model->update($id, $data);

        return redirect()->to('phone/list')
            ->with('status_icon', 'success')
            ->with('status', 'Success');
    }

    public function update_phone_two($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Phone_model = new Phone_model(); 

        $id = $this->request->getPost('id');

        $data = [
            'phone_number_two' => $this->request->getPost('phone_number_two'),
            'whatsapp_acc_two' => $this->request->getPost('whatsapp_acc_two'),
            'whatsapp_acc_two_cond' => $this->request->getPost('whatsapp_acc_two_cond'),
        ];

        $Phone_model->update($id, $data);

        return redirect()->to('phone/list')
            ->with('status_icon', 'success')
            ->with('status', 'Success');
    }

    public function update_phone_three($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Phone_model = new Phone_model(); 

        $id = $this->request->getPost('id');

        $data = [
            'phone_number_three' => $this->request->getPost('phone_number_three'),
            'whatsapp_acc_three' => $this->request->getPost('whatsapp_acc_three'),
            'whatsapp_acc_three_cond' => $this->request->getPost('whatsapp_acc_three_cond'),
        ];

        $Phone_model->update($id, $data);

        return redirect()->to('phone/list')
            ->with('status_icon', 'success')
            ->with('status', 'Success');
    }


    
    public function delete_phone($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Phone_model = new Phone_model();

        $Phone_model->delete($id);

        return redirect()->to('phone/list')
            ->with('status_icon', 'success')
            ->with('status', 'Phone Deleted');
    }

    //phone

    //5gsimcard

    
    
    public function fiveGsimcard_list()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }


        $model = new Phone_model();
        $Agent_model = new Agent_model();
        $FiveGsimcard_model = new FiveGsimcard_model();
        $Account_model = new Account_model();
    
        $agents = $Agent_model->where('status','Active')->findAll();

        $valid_agents = [];
    
        foreach ($agents as $agent) {
            $agent_id = $agent['id'];
            $agent_exists = $FiveGsimcard_model->where('agent_fk_id', $agent_id)->first();
    
            if (!$agent_exists) {
                $valid_agents[] = $agent;
            }
        }

        $simcard = $model->findAll();
        $valid_simcards = [];
    
        foreach ($simcard as $simcard) {
            $simcard_id = $simcard['id'];
            $simcard_exists = $FiveGsimcard_model->where('phone_fk_id', $simcard_id)->first();
    
            if (!$simcard_exists) {
                $valid_simcards[] = $simcard;
            }
        }
        $userId = session()->get('isSuperAdmin')
        ? $useSessionData['superadmin_id']
        : (session()->get('isIT')
            ? $useSessionData['IT_id']
            : $useSessionData['admin_id']);
        
        $userData = $Account_model->find($userId);
        $data = [
           'phone' => $model->findAll(),
           'agent' => $Agent_model->where('status','Active')->findAll(),
           'valid_simcard' => $model->findAll(),
           'simcard' => $FiveGsimcard_model->findAll(),
           'userData' => $userData,
        ];
    
        return view('admin/sg_5gsimcard', $data);
    }
    public function getPhoneDataById()
    {
        $request = $this->request->getJSON();
        $id = $request->id;

        $model = new Phone_model();
        $data = $model->find($id); 

        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['error' => 'Data not found']);
        }
    }

    public function add_SGsimcard()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $model = new FiveGsimcard_model();
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = [
                'number' => $this->request->getVar('number'),
                'serial_no' => $this->request->getVar('serial_no'),
                'agent' => $this->request->getVar('agent'),
                'agent_fk_id' => $this->request->getVar('agent_fk_id'),
                'used_in' => $this->request->getVar('used_in'),
                'remarks' => $this->request->getVar('remarks'),
                'phone_serial_no' => $this->request->getVar('phone_serial_no'),
                'phone_fk_id' => $this->request->getVar('phone_fk_id'),
                'load_expired' => $this->request->getVar('load_expired'),
            ];
            if ($model->save($data)) {
                return redirect()->to('fiveGsimcard/list')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
            }
        }
        return view('admin/fiveGsimcard/list', $data);
    }

    public function update_SGsimcard($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $FiveGsimcard_model = new FiveGsimcard_model(); 

        $agent_fk_id = $this->request->getPost('agent_fk_id');
        
        $id = $this->request->getPost('id');

        $data = [];

        if ($this->request->getPost('phone_serial_no') !== '') {
            $data['phone_serial_no'] = $this->request->getPost('phone_serial_no');
        }
        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        }
        if ($this->request->getPost('serial_no') !== '') {
            $data['serial_no'] = $this->request->getPost('serial_no');
        }
        if ($this->request->getPost('agent') !== '') {
            $data['agent'] = $this->request->getPost('agent');
        }
        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        }
        if ($this->request->getPost('used_in') !== '') {
            $data['used_in'] = $this->request->getPost('used_in');
        }
        
        if ($this->request->getPost('remarks') !== '') {
            $data['remarks'] = $this->request->getPost('remarks');
        }
        
        if ($this->request->getPost('phone_fk_id') !== '') {
            $data['phone_fk_id'] = $this->request->getPost('phone_fk_id');
        }
        if ($this->request->getPost('load_expired') !== '') {
            $data['load_expired'] = $this->request->getPost('load_expired');
        }

        if (!empty($data)) {
            $FiveGsimcard_model->update($id, $data);
        }
        
        return redirect()->to('fiveGsimcard/list')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }

    public function delete_SGsimcard($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $FiveGsimcard_model = new FiveGsimcard_model();

        $FiveGsimcard_model->delete($id);

        return redirect()->to('fiveGsimcard/list')
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }

    public function getPhoneDetails()
    {
        if ($this->request->isAJAX()) {
            $selectedOptionId = $this->request->getPost('id');

            $phoneModel = new Phone_model();

            $phoneDetails = $phoneModel->find($selectedOptionId);

            if ($phoneDetails) {
                $responseData = [
                    'phone_equip_id' => $phoneDetails['phone_equip_id'],
                    'id' => $phoneDetails['id'],
                    'agent_fk_id' => $phoneDetails['agent_fk_id'],
                    'phone_agent_name' => $phoneDetails['phone_agent_name']
                ];

                return $this->respond($responseData);
            } else {
                return $this->failNotFound('Phone details not found.');
            }
        } else {
            return $this->fail('Invalid request.', 400);
        }
    } 

    //5gsimcard

    //laptop

    public function laptop_list()
     {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }


         $model = new Laptop_model();
         $Account_model = new Account_model();
         $Agent_model = new Agent_model();

        $agents = $Agent_model->where('status','Active')->orderBy('agent_name', 'asc')->findAll();
         $valid_agents = [];
     
         foreach ($agents as $agent) {
             $agent_id = $agent['id'];
             $agent_exists = $model->where('agent_fk_id', $agent_id)->first();
     
             if (!$agent_exists) {
                 $valid_agents[] = $agent;
             }
         }

         $userId = session()->get('isSuperAdmin')
        ? $useSessionData['superadmin_id']
        : (session()->get('isIT')
            ? $useSessionData['IT_id']
            : $useSessionData['admin_id']);
        
        $userData = $Account_model->find($userId);
         $data = [
            'laptop' => $model->findAll(),
            'agent' => $agents,
            'userData' => $userData,
         ];
     
         return view('admin/laptop', $data);
     }

    public function add_laptop()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $model = new Laptop_model();
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = [
                'laptop_equip_id' => $this->request->getVar('laptop_equip_id'),
                'laptop_brand' => $this->request->getVar('laptop_brand'),
                'laptop_model' => $this->request->getVar('laptop_model'),
                'laptop_condition' => $this->request->getVar('laptop_condition'),
                'laptop_processor' => $this->request->getVar('laptop_processor'),
                'laptop_ram' => $this->request->getVar('laptop_ram'),
                'laptop_storage' => $this->request->getVar('laptop_storage'),
                'laptop_comment' => $this->request->getVar('laptop_comment'),
            ];
            if ($model->save($data)) {
                return redirect()->to('laptop/list')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
            }
        }
        return view('admin/laptop', $data);
    }

    public function laptop_check_equip_id()
    {
        $model = new Laptop_model();
        $laptop_equip_id	 = $this->request->getPost('laptop_equip_id');
        $existingRecord = $model->where('laptop_equip_id', $laptop_equip_id)->first();
        if ($existingRecord) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
        return $this->response->setJSON($response);
    }

    public function laptop_check_agentID()
    {
        $model = new Laptop_model();
        $agent_id = $this->request->getPost('agent_id');
        
        if ($agent_id !== 'None' && $agent_id != 0 && $agent_id !== ''){
            $existingRecord = $model->where('agent_fk_id', $agent_id)->first();
            if ($existingRecord) {
                $response['exists'] = true;
            } else {
                $response['exists'] = false;
            }
        } else {
            $response['exists'] = false;
        }
        
        return $this->response->setJSON($response);
    }


    public function update_laptop($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Laptop_model = new Laptop_model(); 
        
        $id = $this->request->getPost('id');
        $agent_fk_id = $this->request->getPost('agent_fk_id');

        $data = [];

        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        }
        if ($this->request->getPost('laptop_agent') !== '') {
            $data['laptop_agent'] = $this->request->getPost('laptop_agent');
        }
        
        if ($this->request->getPost('laptop_model') !== '') {
            $data['laptop_model'] = $this->request->getPost('laptop_model');
        }
        if ($this->request->getPost('laptop_brand') !== '') {
            $data['laptop_brand'] = $this->request->getPost('laptop_brand');
        }
        if ($this->request->getPost('laptop_ram') !== '') {
            $data['laptop_ram'] = $this->request->getPost('laptop_ram');
        }
        if ($this->request->getPost('laptop_processor') !== '') {
            $data['laptop_processor'] = $this->request->getPost('laptop_processor');
        }
        if ($this->request->getPost('laptop_storage') !== '') {
            $data['laptop_storage'] = $this->request->getPost('laptop_storage');
        }
        if ($this->request->getPost('laptop_condition') !== '') {
            $data['laptop_condition'] = $this->request->getPost('laptop_condition');
        }
        if ($this->request->getPost('laptop_comment') !== '') {
            $data['laptop_comment'] = $this->request->getPost('laptop_comment');
        }
        if ($this->request->getPost('laptop_status') !== '') {
            $data['laptop_status'] = $this->request->getPost('laptop_status');
        }

        if ($agent_fk_id == 0 ) {
            $data['laptop_status'] = 'Unassigned';
        } else if($agent_fk_id == '') {
            $data['laptop_status'] = $this->request->getPost('laptop_status');
            $data['agent_fk_id'] = 'NULL';
            $data['laptop_agent'] = 'NULL';
        } else {
            $data['laptop_status'] = 'Assigned';
        }
        
        if (!empty($data)) {
            $Laptop_model->update($id, $data);
        }

        return redirect()->to('laptop/list')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }
    public function delete_laptop($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Laptop_model = new Laptop_model();

        $Laptop_model->delete($id);

        return redirect()->to('laptop/list')
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }

    //laptop

    //webcam

    public function webcam_list()
     {
        $useSessionData = session()->get();
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }

        
        $data = [
        ];
         $model = new Webcam_model();
         $Agent_model = new Agent_model();
         $Account_model = new Account_model();

         $agents = $Agent_model->where('status','Active')->orderBy('agent_name', 'asc')->findAll();
         $valid_agents = [];
     
         foreach ($agents as $agent) {
             $agent_id = $agent['id'];
             $agent_exists = $model->where('agent_fk_id', $agent_id)->first();
     
             if (!$agent_exists) {
                 $valid_agents[] = $agent;
             }
         }
         $userId = session()->get('isSuperAdmin')
         ? $useSessionData['superadmin_id']
         : (session()->get('isIT')
             ? $useSessionData['IT_id']
             : $useSessionData['admin_id']);
             
        $userData = $Account_model->find($userId);
         $data = [
            'webcam' => $model->findAll(),
            'agent' => $agents,
            'userData' => $userData,
         ];
         return view('admin/webcam', $data);
     }


    public function add_webcam()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $model = new Webcam_model();
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = [
                'webcam_equip_id' => $this->request->getVar('webcam_equip_id'),
                'webcam_brand' => $this->request->getVar('webcam_brand'),
                'webcam_model' => $this->request->getVar('webcam_model'),
                'webcam_condition' => $this->request->getVar('webcam_condition'),
                'webcam_comment' => $this->request->getVar('webcam_comment'),
            ];
            if ($model->save($data)) {
                return redirect()->to('webcam/list')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
            }
        }
        return view('admin/webcam', $data);
    }

    public function webcam_check_equip_id()
    {
        $model = new Webcam_model();
        $webcam_equip_id	 = $this->request->getPost('webcam_equip_id');
        $existingRecord = $model->where('webcam_equip_id', $webcam_equip_id)->first();
        if ($existingRecord) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
        return $this->response->setJSON($response);
    }

    public function update_webcam($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Webcam_model = new Webcam_model(); 

        
        $id = $this->request->getPost('id');
        $agent_fk_id = $this->request->getPost('agent_fk_id');


        $data = [];

        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        }
        if ($this->request->getPost('webcam_agent') !== '') {
            $data['webcam_agent'] = $this->request->getPost('webcam_agent');
        }
        
        if ($this->request->getPost('webcam_status') !== '') {
            $data['webcam_status'] = $this->request->getPost('webcam_status');
        }
        if ($this->request->getPost('webcam_brand') !== '') {
            $data['webcam_brand'] = $this->request->getPost('webcam_brand');
        }
        if ($this->request->getPost('webcam_model') !== '') {
            $data['webcam_model'] = $this->request->getPost('webcam_model');
        }
        if ($this->request->getPost('webcam_condition') !== '') {
            $data['webcam_condition'] = $this->request->getPost('webcam_condition');
        }
        if ($this->request->getPost('webcam_comment') !== '') {
            $data['webcam_comment'] = $this->request->getPost('webcam_comment');
        }

        if ($agent_fk_id == 0 ) {
            $data['webcam_status'] = 'Unassigned';
        } else if($agent_fk_id == '') {
            $data['webcam_status'] = $this->request->getPost('webcam_status');
            $data['agent_fk_id'] = 'NULL';
            $data['webcam_agent'] = 'NULL';
        } else {
            $data['webcam_status'] = 'Assigned';
        }
        
        if (!empty($data)) {
            $Webcam_model->update($id, $data);
        }

        return redirect()->to('webcam/list')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }

    public function webcam_check_agentID()
    {
        $model = new Webcam_model();
        $agent_id = $this->request->getPost('agent_id');
        
        if ($agent_id !== 'None' && $agent_id != 0 && $agent_id !== ''){
            $existingRecord = $model->where('agent_fk_id', $agent_id)->first();
            if ($existingRecord) {
                $response['exists'] = true;
            } else {
                $response['exists'] = false;
            }
        } else {
            $response['exists'] = false;
        }
        
        return $this->response->setJSON($response);
    }
    public function delete_webcam($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Webcam_model = new Webcam_model();

        $Webcam_model->delete($id);

        return redirect()->to('webcam/list')
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }

    //locker
    public function locker_list()
     {
        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }


         $model = new Locker_model();
         $Agent_model = new Agent_model();
         $Account_model = new Account_model();


        $agents = $Agent_model->where('status','Active')->orderBy('agent_name', 'asc')->findAll();
         $valid_agents = [];
     
         foreach ($agents as $agent) {
             $agent_id = $agent['id'];
             $agent_exists = $model->where('agent_fk_id', $agent_id)->first();
     
             if (!$agent_exists) {
                 $valid_agents[] = $agent;
             }
         }
         $userId = session()->get('isSuperAdmin')
         ? $useSessionData['superadmin_id']
         : (session()->get('isIT')
             ? $useSessionData['IT_id']
             : $useSessionData['admin_id']);
             
        $userData = $Account_model->find($userId);
         $data = [
            'locker' => $model->findAll(),
            'agent' => $agents,
            'userData' => $userData,
         ];
     
         return view('admin/locker', $data);
     }
    

    public function add_locker()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $model = new Locker_model();
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = [
                'locker_tool_id' => $this->request->getVar('locker_tool_id'),
                'locker_condition' => $this->request->getVar('locker_condition'),
                'locker_no' => $this->request->getVar('locker_no'),
                'locker_comment' => $this->request->getVar('locker_comment'),
            ];
            if ($model->save($data)) {
                return redirect()->to('locker/list')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
            }
        }
        return view('admin/locker', $data);
    }

    public function locker_check_equip_id()
    {
        $model = new Locker_model();
        $locker_tool_id	 = $this->request->getPost('locker_tool_id');
        $existingRecord = $model->where('locker_tool_id', $locker_tool_id)->first();
        if ($existingRecord) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
        return $this->response->setJSON($response);
    }

    public function locker_check_agentID()
    {
        $model = new Locker_model();
        $agent_id = $this->request->getPost('agent_id');
        
        if ($agent_id !== 'None' && $agent_id != 0 && $agent_id !== ''){
            $existingRecord = $model->where('agent_fk_id', $agent_id)->first();
            if ($existingRecord) {
                $response['exists'] = true;
            } else {
                $response['exists'] = false;
            }
        } else {
            $response['exists'] = false;
        }
        
        return $this->response->setJSON($response);
    }

    public function update_locker($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Locker_model = new Locker_model(); 

        
        $id = $this->request->getPost('id');
        $agent_fk_id = $this->request->getPost('agent_fk_id');


        $data = [];

        if ($this->request->getPost('agent_fk_id') !== '') {
            $data['agent_fk_id'] = $this->request->getPost('agent_fk_id');
        }
        if ($this->request->getPost('locker_agent') !== '') {
            $data['locker_agent'] = $this->request->getPost('locker_agent');
        }

        if ($this->request->getPost('locker_status') !== '') {
            $data['locker_status'] = $this->request->getPost('locker_status');
        }
        if ($this->request->getPost('locker_condition') !== '') {
            $data['locker_condition'] = $this->request->getPost('locker_condition');
        }
        if ($this->request->getPost('locker_comment') !== '') {
            $data['locker_comment'] = $this->request->getPost('locker_comment');
        }
        if ($this->request->getPost('locker_no') !== '') {
            $data['locker_no'] = $this->request->getPost('locker_no');
        }

        if ($agent_fk_id == 0) {
            $data['locker_status'] = 'Non-Occupied';
        } else {
            $data['locker_status'] = 'Occupied';
        }
        
        if (!empty($data)) {
            $Locker_model->update($id, $data);
        }

        return redirect()->to('locker/list')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }

    public function delete_locker($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }
        $Locker_model = new Locker_model();

        $Locker_model->delete($id);

        return redirect()->to('locker/list')
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }

    //accountabilility_form

    public function accountability_form()
    {
        $useSessionData = session()->get();
        
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin')&& !session()->get('isIT'))) {
            return redirect()->to('/');
        }

        $Agent_model = new Agent_model();
        $Account_model = new Account_model();

        $userId = session()->get('isSuperAdmin')
        ? $useSessionData['superadmin_id']
        : (session()->get('isIT')
            ? $useSessionData['IT_id']
            : $useSessionData['admin_id']);      
        $userData = $Account_model->find($userId);

        $data=[
            'agent' => $Agent_model->where('status','Active')->orderBy('agent_name', 'asc')->findAll(),
            'userData' => $userData,
        ];
        return view('admin/accountability_form',$data);
    }
    public function get_agent_and_mouse_details()
    {
        $request = $this->request->getPost();
        $id = $request['id'];

        $agentModel = new Agent_model();
        $agentDetails = $agentModel->find($id);

        if ($agentDetails) {
            $response['agent_id'] = $agentDetails['agent_id'];
            $response['campaign'] = $agentDetails['campaign'];

            $mouseModel = new Mouse_model();
            $mouseData = $mouseModel->where('agent_fk_id', $id)->first();

            if ($mouseData) {
                $response['mouse_status'] = $mouseData['status'];
                $response['mouse_equip_id'] = $mouseData['equip_id'];
                $response['mouse_brand'] = $mouseData['brand'];
                $response['mouse_model'] = $mouseData['model'];
                $response['mouse_condition'] = $mouseData['mouse_condition'];
                $response['mouse_comment'] = $mouseData['comment'];
            } else {
                $response['mouse_status'] = 'None';
                $response['mouse_equip_id'] = 'None';
                $response['mouse_brand'] = 'None';
                $response['mouse_model'] = 'None';
                $response['mouse_condition'] = 'None';
                $response['mouse_comment'] = 'None';
            }

            $keyboardModel = new Keyboard_model();
            $keyboardData = $keyboardModel->where('agent_fk_id', $id)->first();

            if ($keyboardData) {
                $response['keyboard_status'] = $keyboardData['keyboard_status'];
                $response['keyboard_equip_id'] = $keyboardData['keyboard_equip_id'];
                $response['keyboard_brand'] = $keyboardData['keyboard_brand'];
                $response['keyboard_model'] = $keyboardData['keyboard_model'];
                $response['keyboard_condition'] = $keyboardData['keyboard_condition'];
                $response['keyboard_comment'] = $keyboardData['keyboard_comment'];
            } else {
                $response['keyboard_status'] = 'None';
                $response['keyboard_equip_id'] = 'None';
                $response['keyboard_brand'] = 'None';
                $response['keyboard_model'] = 'None';
                $response['keyboard_condition'] = 'None';
                $response['keyboard_comment'] = 'None';
            }

            $Headset_model = new Headset_model();
            $headsetData = $Headset_model->where('agent_fk_id', $id)->first();

            if ($headsetData) {
                $response['headset_equip_id'] = $headsetData['equip_id'];
                $response['headset_status'] = $headsetData['status'];
                $response['headset_brand'] = $headsetData['brand'];
                $response['headset_model'] = $headsetData['model'];
                $response['headset_condition'] = $headsetData['condition'];
                $response['headset_comment'] = $headsetData['comment'];
            } else {
                $response['headset_equip_id'] = 'None';
                $response['headset_status'] = 'None';
                $response['headset_brand'] = 'None';
                $response['headset_model'] = 'None';
                $response['headset_condition'] = 'None';
                $response['headset_comment'] = 'None';
            }

            $Machine_model = new Machine_model();
            $cpuData = $Machine_model->where('agent_fk_id', $id)->first();

            if ($cpuData) {
                $response['cpu_status'] = $cpuData['status'];
                $response['cpu_equip_id'] = $cpuData['equip_id'];
                $response['cpu_brand'] = $cpuData['brand'];
                $response['cpu_model'] = $cpuData['model'];
                $response['cpu_ram_size'] = $cpuData['ram_size'];
                $response['cpu_processor'] = $cpuData['processor'];
                $response['cpu_storage_type'] = $cpuData['storage_type'];
                $response['cpu_conditions'] = $cpuData['conditions'];
                $response['cpu_comment'] = $cpuData['comment'];
            } else {
                $response['cpu_status'] = 'None';
                $response['cpu_equip_id'] = 'None';
                $response['cpu_brand'] = 'None';
                $response['cpu_model'] = 'None';
                $response['cpu_ram_size'] = 'None';
                $response['cpu_processor'] = 'None';
                $response['cpu_storage_type'] = 'None';
                $response['cpu_conditions'] = 'None';
                $response['cpu_comment'] = 'None';
            }

            $Locker_model = new Locker_model();
            $lockerData = $Locker_model->where('agent_fk_id', $id)->first();

            if ($lockerData) {
                $response['locker_status'] = $lockerData['locker_status'];
                $response['locker_tool_id'] = $lockerData['locker_tool_id'];
                $response['locker_condition'] = $lockerData['locker_condition'];
                $response['locker_comment'] = $lockerData['locker_comment'];
            } else {
                $response['locker_status'] = 'None';
                $response['locker_tool_id'] = 'None';
                $response['locker_condition'] = 'None';
                $response['locker_comment'] = 'None';
            }   

            $Laptop_model = new Laptop_model();
            $laptopData = $Laptop_model->where('agent_fk_id', $id)->first();

            if ($laptopData) {
                $response['laptop_status'] = $laptopData['laptop_status'];
                $response['laptop_equip_id'] = $laptopData['laptop_equip_id'];
                $response['laptop_brand'] = $laptopData['laptop_brand'];
                $response['laptop_model'] = $laptopData['laptop_model'];
                $response['laptop_ram'] = $laptopData['laptop_ram'];
                $response['laptop_processor'] = $laptopData['laptop_processor'];
                $response['laptop_storage'] = $laptopData['laptop_storage'];
                $response['laptop_condition'] = $laptopData['laptop_condition'];
                $response['laptop_comment'] = $laptopData['laptop_comment'];
            } else {
                $response['laptop_status'] = 'None';
                $response['laptop_equip_id'] = 'None';
                $response['laptop_brand'] = 'None';
                $response['laptop_model'] = 'None';
                $response['laptop_ram'] = 'None';
                $response['laptop_processor'] = 'None';
                $response['laptop_storage'] = 'None';
                $response['laptop_condition'] = 'None';
                $response['laptop_comment'] = 'None';
            }   

            $Webcam_model = new Webcam_model();
            $webcamData = $Webcam_model->where('agent_fk_id', $id)->first();

            if ($webcamData) {
                $response['webcam_status'] = $webcamData['webcam_status'];
                $response['webcam_equip_id'] = $webcamData['webcam_equip_id'];
                $response['webcam_brand'] = $webcamData['webcam_brand'];
                $response['webcam_model'] = $webcamData['webcam_model'];
                $response['webcam_condition'] = $webcamData['webcam_condition'];
                $response['webcam_comment'] = $webcamData['webcam_comment'];
            } else {
                $response['webcam_status'] = 'None';
                $response['webcam_equip_id'] = 'None';
                $response['webcam_brand'] = 'None';
                $response['webcam_model'] = 'None';
                $response['webcam_condition'] = 'None';
                $response['webcam_comment'] = 'None';
            } 

            $Monitor_model = new Monitor_model();
            $monitorData = $Monitor_model->where('agent_fk_id', $id)->findAll();

            if (!empty($monitorData)) {
                $response['monitor_one_status'] = $monitorData[0]['monitor_status'];
                $response['monitor_one_equip_id'] = $monitorData[0]['monitor_equip_id'];
                $response['monitor_one_brand'] = $monitorData[0]['monitor_brand'];
                $response['monitor_one_model'] = $monitorData[0]['monitor_model'];
                $response['monitor_one_condition'] = $monitorData[0]['monitor_condition'];
                $response['monitor_one_comment'] = $monitorData[0]['monitor_comment'];
            
                if (isset($monitorData[1])) {
                    $response['monitor_two_status'] = $monitorData[1]['monitor_status'];
                    $response['monitor_two_equip_id'] = $monitorData[1]['monitor_equip_id'];
                    $response['monitor_two_brand'] = $monitorData[1]['monitor_brand'];
                    $response['monitor_two_model'] = $monitorData[1]['monitor_model'];
                    $response['monitor_two_condition'] = $monitorData[1]['monitor_condition'];
                    $response['monitor_two_comment'] = $monitorData[1]['monitor_comment'];
                } else {
                    $response['monitor_two_status'] = 'None';
                    $response['monitor_two_equip_id'] = 'None';
                    $response['monitor_two_brand'] = 'None';
                    $response['monitor_two_model'] = 'None';
                    $response['monitor_two_condition'] = 'None';
                    $response['monitor_two_comment'] = 'None';
                }
            } else {
                $response['monitor_one_status'] = 'None';
                $response['monitor_one_equip_id'] = 'None';
                $response['monitor_one_brand'] = 'None';
                $response['monitor_one_model'] = 'None';
                $response['monitor_one_condition'] = 'None';
                $response['monitor_one_comment'] = 'None';
            
                $response['monitor_two_status'] = 'None';
                $response['monitor_two_equip_id'] = 'None';
                $response['monitor_two_brand'] = 'None';
                $response['monitor_two_model'] = 'None';
                $response['monitor_two_condition'] = 'None';
                $response['monitor_two_comment'] = 'None';
            }

            $Phone_model = new Phone_model();
            $phoneData = $Phone_model->where('agent_fk_id', $id)->first();

            if ($phoneData) {
                $response['phone_status'] = $phoneData['phone_status'];
                $response['phone_equip_id'] = $phoneData['phone_equip_id'];
                $response['phone_brand'] = $phoneData['phone_brand'];
                $response['phone_model'] = $phoneData['phone_model'];
                $response['phone_condition'] = $phoneData['phone_condition'];
                $response['phone_comment'] = $phoneData['phone_comment'];
            } else {
                $response['phone_status'] = 'None';
                $response['phone_equip_id'] = 'None';
                $response['phone_brand'] = 'None';
                $response['phone_model'] = 'None';
                $response['phone_condition'] = 'None';
                $response['phone_comment'] = 'None';
            } 

        } else {
            $response['agent_id'] = 'None';
            $response['campaign'] = 'None';

            $response['mouse_status'] = 'None';
            $response['mouse_equip_id'] = 'None';
            $response['mouse_brand'] = 'None';
            $response['mouse_model'] = 'None';
            $response['mouse_condition'] = 'None';
            $response['mouse_comment'] = 'None';

            $response['keyboard_status'] = 'None';
            $response['keyboard_equip_id'] = 'None';
            $response['keyboard_brand'] = 'None';
            $response['keyboard_model'] = 'None';
            $response['keyboard_condition'] = 'None';
            $response['keyboard_comment'] = 'None';

            $response['headset_equip_id'] = 'None';
            $response['headset_status'] = 'None';
            $response['headset_brand'] = 'None';
            $response['headset_model'] = 'None';
            $response['headset_condition'] = 'None';
            $response['headset_comment'] = 'None';

            $response['cpu_status'] = 'None';
            $response['cpu_equip_id'] = 'None';
            $response['cpu_brand'] = 'None';
            $response['cpu_model'] = 'None';
            $response['cpu_ram_size'] = 'None';
            $response['cpu_processor'] = 'None';
            $response['cpu_storage_type'] = 'None';
            $response['cpu_conditions'] = 'None';
            $response['cpu_comment'] = 'None';

            $response['locker_status'] = 'None';
            $response['locker_tool_id'] = 'None';
            $response['locker_condition'] = 'None';
            $response['locker_comment'] = 'None';

            $response['laptop_status'] = 'None';
            $response['laptop_equip_id'] = 'None';
            $response['laptop_brand'] = 'None';
            $response['laptop_model'] = 'None';
            $response['laptop_ram'] = 'None';
            $response['laptop_processor'] = 'None';
            $response['laptop_storage'] = 'None';
            $response['laptop_condition'] = 'None';
            $response['laptop_comment'] = 'None';

            $response['webcam_status'] = 'None';
            $response['webcam_equip_id'] = 'None';
            $response['webcam_brand'] = 'None';
            $response['webcam_model'] = 'None';
            $response['webcam_condition'] = 'None';
            $response['webcam_comment'] = 'None';

            $response['monitor_one_status'] = 'None';
            $response['monitor_one_equip_id'] = 'None';
            $response['monitor_one_brand'] = 'None';
            $response['monitor_one_model'] = 'None';
            $response['monitor_one_condition'] = 'None';
            $response['monitor_one_comment'] = 'None';

            $response['monitor_two_status'] = 'None';
            $response['monitor_two_equip_id'] = 'None';
            $response['monitor_two_brand'] = 'None';
            $response['monitor_two_model'] = 'None';
            $response['monitor_two_condition'] = 'None';
            $response['monitor_two_comment'] = 'None';

            $response['phone_status'] = 'None';
            $response['phone_equip_id'] = 'None';
            $response['phone_brand'] = 'None';
            $response['phone_model'] = 'None';
            $response['phone_condition'] = 'None';
            $response['phone_comment'] = 'None';
        }

        return $this->response->setJSON($response);
    }

    public function filesVIew($agentId)
    {
        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin'))) {
            return redirect()->to('/');
        }
        
        $Account_model = new Account_model();
        $agentModel = new Agent_model();
        $agentFilesModel = new Agent_files();

        $agent = $agentModel->find($agentId);
        

        $files = $agentFilesModel->where('agent_fk_id', $agentId)->findAll();

        $userId = session()->get('isSuperAdmin') ? $useSessionData['superadmin_id'] : (session()->get('isAdmin') ? $useSessionData['admin_id'] : $useSessionData['viewers_id']);
        $userData = $Account_model->find($userId);

        $data = [
            'agent' => $agent,
            'files' => $files,
            'userData' => $userData,
         ];


        return view('admin/agent_files', $data);
    }


    public function fileUpload()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin'))) {
            return redirect()->to('/');
        }
        $Agent_files = new Agent_files();
        helper(['form']);
    
        $agentId = $this->request->getPost('id');
    
        if ($this->request->getMethod() == 'post') {
            $validation = [
                'upload_files' => [
                    'label' => 'Files',
                    'rules' => 'uploaded[upload_files]|mime_in[upload_files,image/jpg,image/jpeg,image/png,image/gif,image/bmp,image/webp,image/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint]|ext_in[upload_files,png,jpg,jpeg,gif,bmp,webp,pdf,docx,xlsx,ppt,pptx]'
                ]
            ];
    
            if (!$this->validate($validation)) {
                $data['validation'] = $this->validator;
                return redirect()->back()->with('status_icon', 'error')->with('status', 'Invalid file');
            } else {
                $uploadedFiles = $this->request->getFiles('upload_files');
                $uploadSuccess = false;
    
                foreach ($uploadedFiles['upload_files'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $folderPath = FCPATH . 'userFiles/' . $agentId;
                        if (!file_exists($folderPath)) {
                            if (!mkdir($folderPath, 0777, true)) {
                                die('Failed to create folders...');
                            }
                        }
    
                        $imageName = $file->getName();
                        $imageName = $this->generateUniqueFileName($folderPath, $imageName);
    
                        $file->move($folderPath, $imageName);
    
                        $fileData = [
                            'upload_files' => $imageName,
                            'agent_fk_id' => $agentId
                        ];
    
                        $Agent_files->insert($fileData);
                        $uploadSuccess = true; 
                    }
                }
    
                if ($uploadSuccess) {
                    return redirect()->back()->with('status_icon', 'success')->with('status', 'Upload successful');
                } else {
                    return redirect()->back()->with('status_icon', 'error')->with('status', 'Invalid file');
                }
            }
        }
    }
    
    private function generateUniqueFileName($folderPath, $fileName)
    {
        $filePath = $folderPath . '/' . $fileName;
        $counter = 1;
    
        while (file_exists($filePath)) {
            $fileNameParts = pathinfo($fileName);
            $newFileName = $fileNameParts['filename'] . '_' . $counter . '.' . $fileNameParts['extension'];
            $filePath = $folderPath . '/' . $newFileName;
            $counter++;
        }
    
        return $newFileName ?? $fileName;
    }
    

    public function deleteFile($fileId)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin'))) {
            return redirect()->to('/');
        }
        
        $fileModel = new Agent_files();
        $file = $fileModel->find($fileId);
    
        if (!$file) {
            return redirect()->back()->with('error', 'File not found.');
        }
    
        $deleted = $fileModel->deleteFileById($fileId);
    
        if (!$deleted) {
            return redirect()->back()->with('error', 'Failed to delete file from database.');
        }
    
        $folderPath = FCPATH . 'userFiles/' . $file['agent_fk_id'] . '/';
        $filePath = $folderPath . $file['upload_files'];
    
        if (file_exists($filePath)) {
            $fileDeleted = unlink($filePath);
    
            if (!$fileDeleted) {
                error_log('Failed to delete file: ' . $filePath);
            }
        }
    
        return redirect()->back()->with('status_icon', 'success')
        ->with('status', 'Deleted');
    }

    public function deleteMultipleFiles()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin'))) {
            return redirect()->to('/');
        }
        $fileIds = $this->request->getPost('fileIds');

        if (!$fileIds || !is_array($fileIds)) {
            return redirect()->back()->with('error', 'No files selected for deletion.');
        }

        $fileModel = new Agent_files();

        foreach ($fileIds as $fileId) {
            $file = $fileModel->find($fileId);

            if (!$file) {
                continue;
            }

            $deleted = $fileModel->deleteFileById($fileId);

            if (!$deleted) {
                continue;
            }

            $folderPath = FCPATH . 'userFiles/' . $file['agent_fk_id'] . '/';
            $filePath = $folderPath . $file['upload_files'];

            if (file_exists($filePath)) {
                $fileDeleted = unlink($filePath);

                if (!$fileDeleted) {
                    error_log('Failed to delete file: ' . $filePath);
                }
            }
        }

        return redirect()->back()->with('status_icon', 'success')
        ->with('status', 'Deleted');
    }

    public function renameFile($fileId)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isAdmin') && !session()->get('isSuperAdmin'))) {
            return redirect()->to('/');
        }
        $fileModel = new Agent_files();
        $file = $fileModel->find($fileId);

        if (!$file) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $newFileName = $this->request->getPost('upload_files');

        if (empty($newFileName)) {
            return redirect()->back()->with('error', 'New file name is required.');
        }

        $fileExtension = pathinfo($file['upload_files'], PATHINFO_EXTENSION);

        $newFilePath = FCPATH . 'userFiles/' . $file['agent_fk_id'] . '/' . $newFileName . '.' . $fileExtension;

        $folderPath = FCPATH . 'userFiles/' . $file['agent_fk_id'] . '/';
        $oldFilePath = $folderPath . $file['upload_files'];

        if (file_exists($oldFilePath)) {
            rename($oldFilePath, $newFilePath);
        }

        $fileModel->update($fileId, ['upload_files' => $newFileName . '.' . $fileExtension]);

        return redirect()->back()->with('status_icon', 'success')
        ->with('status', 'Success');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

}

