<?php

namespace App\Controllers;
use App\Models\Account_model;

class Payroll_account extends BaseController
{
    protected $db;
    public function __construct() {
        helper(['url', 'form','session']);
        $this->db = \Config\Database::connect();
    }

    public function payroll_signin()
    {
        helper(['form']);
        $data = [];
        
        $session = session();
        
        if ($session->get('isLoggedIn')) {
            $isPayrollSuperAdmin = $session->get('isPayrollSuperAdmin');
            $isPayrollAdmin = $session->get('isPayrollAdmin');
            
            if ($isPayrollSuperAdmin) {
                return redirect()->to('payroll/agents');
            } elseif ($isPayrollAdmin) {
                return redirect()->to('payroll/agents');
            } else {
                return redirect()->to('/');
            }
        }
    
        if ($this->request->getMethod() == 'post') {
            $validation = [
                'username' => 'required',
                'password' => 'required',
            ];
            $errors = [
                'username' => [
                    'required' => 'The username or email is required.',
                ],
                'password' => [
                    'required' => 'The password is required',
                ]
            ];
    
            if (!$this->validate($validation, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new Account_model();
                $usernameOrEmail = $this->request->getVar('username');
                $password = $this->request->getVar('password');
    
                $user = $model->where('username', $usernameOrEmail)
                            ->orWhere('email', $usernameOrEmail)
                            ->first();
    
                if ($user && password_verify($password, $user['password'])) {
                    if ($user['role'] == 'Viewers' || $user['role'] == 'IT') {
                        return redirect()->to('payroll/login')
                        ->with('status_icon', 'error')
                        ->with('status', 'You dont have permission to access!');
                    } elseif ($user['role'] == 'Admin') {
                        $this->payroll_setAdminSession($user); 
                        return redirect()->to('payroll/agents');
                    } elseif ($user['role'] == 'Superadmin') {
                        $this->payrollSetSuperAdminSession($user); 
                        return redirect()->to('payroll/agents');
                    }
                } else {
                    $email = $this->request->getPost('username');
                    $session->set('email', $email);
                    $session->setFlashdata('msg', 'Wrong password');
                }
            }
        }
        return view('payroll/login', $data);
    }
    

    public function emailOrUsernameCheck()
    {
        $model = new Account_model();
        $emailOrUsername = $this->request->getPost('username');

        if (empty($emailOrUsername)) {
            $response['exists'] = false; 
        } else {
            $existingRecord = $model
                ->where('email', $emailOrUsername)
                ->orWhere('username', $emailOrUsername)
                ->first();

            $response = [];

            if ($existingRecord) {
                $response['exists'] = false;
            } else {
                $response['exists'] = true;
            }
        }

        return $this->response->setJSON($response);
    }

    private function payroll_setAdminSession($admin)
    {
        $data = [
            'payroll_admin_id' => $admin['id'],
            'username' => $admin['username'],
            'email' => $admin['email'],
            'isLoggedIn' => true,
            'isPayrollAdmin' => true,
        ];
        session()->set($data);
    }

    private function payrollSetSuperAdminSession($superadmin)
    {
        $data = [
            'payroll_superadmin_id' => $superadmin['id'],
            'username' => $superadmin['username'],
            'email' => $superadmin['email'],
            'isLoggedIn' => true,
            'isPayrollSuperAdmin' => true,
        ];
        session()->set($data);
    }

}
