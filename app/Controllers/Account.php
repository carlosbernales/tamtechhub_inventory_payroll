<?php

namespace App\Controllers;
use App\Models\Account_model;

class Account extends BaseController
{
    protected $db;
    public function __construct() {
        helper(['url', 'form','session']);
        $this->db = \Config\Database::connect();
    }

    public function register()
    {
        $data = [];
        helper(['form']);
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

        if ($this->request->getmethod() == 'post') {
            $validation = [
                'username' => [
                    'rules' => 'required|is_unique[account.username]',
                    'errors' => [
                        'required' => 'The username is required',
                        'is_unique' => 'Username is already taken',
                    ],
                ],
                'email' => [
                    'rules' => 'required|min_length[4]|max_length[50]|valid_email|is_unique[account.email]',
                    'errors' => [
                        'required' => 'The email address is required',
                        'valid_email' => 'Please check the Email field. It does not appear to be valid',
                        'is_unique' => 'Email is already taken',
                    ],
                ],
                'password' => [
                    'rules' => 'required|min_length[8]|max_length[100]',
                    'errors' => [
                        'required' => 'Password is required.',
                        'min_length' => 'Password must have at least 8 characters in length.',
                        'max_length' => 'Password must not have characters more than 100 characters in length.',
                    ],
                ],
                'confirm_password' => [
                    'rules' => 'matches[password]',
                    'errors' => [
                        'required' => 'Confirm password is required.',
                        'matches' => 'Password do not match',
                    ],
                ],
            ];
            if (!$this->validate($validation)) {
                $username = $this->request->getPost('username');
                $email = $this->request->getPost('email');
                $firstname = $this->request->getPost('firstname');
                $lastname = $this->request->getPost('lastname');

                $session->set('username', $username); 
                $session->set('email', $email); 
                $session->set('firstname', $firstname); 
                $session->set('lastname', $lastname); 

                $data['validation'] = $this->validator;
            } else {
                $model = new Account_model();
                $approve_token = $this->approve_token(100);
                $data = array(
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'approve_token' => $approve_token,
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'status' => 'not_verified',
                    'role' => 'Viewers',
                );
                if ($model->save($data)) {
                    $email = \Config\Services::email();
                    $email->setTo('tamtech101@gmail.com');
                    $email->setFrom('tamtech101@gmail.com');
                    $email->setSubject('Account Approval');

                    $email->setMailType('html');

                    $message = view('admin/emails/account_approval', [
                        'email' => $this->request->getVar('email'),
                        'approve_token' => $approve_token
                    ]);
                    $email->setMessage($message);
                    if ($email->send()) {
                        return redirect()->to('/');
                    }
                }
            }
        }
        return view('register', $data);
    }


    public function approve_token($length)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result),0, $length);
    }
    public function verify_admin($approve_token = null)
    {
        $accountModel = new Account_model();
        $account = $accountModel->where('approve_token', $approve_token)->first();
        
        if ($account) {
            $data = [
                'approve_token' => 'expired',
                'role' => 'Admin'
            ];
            $accountModel->set($data)->where('approve_token', $approve_token)->update();
            
            return redirect()->to('/')
                ->with('status_icon', 'success')
                ->with('status', 'Account has been verified as Admin');
        } else {
            return redirect()->to('/')
                ->with('status_icon', 'error')
                ->with('status', 'Expired Link');
        }
    }

    public function verify_it_officer($approve_token = null)
    {
        $accountModel = new Account_model();
        $account = $accountModel->where('approve_token', $approve_token)->first();
        
        if ($account) {
            $data = [
                'approve_token' => 'expired',
                'role' => 'IT'
            ];
            $accountModel->set($data)->where('approve_token', $approve_token)->update();
            
            return redirect()->to('/')
                ->with('status_icon', 'success')
                ->with('status', 'Account has been verified as IT Officer');
        } else {
            return redirect()->to('/')
                ->with('status_icon', 'error')
                ->with('status', 'Expired Link');
        }
    }

    public function signin()
    {
        helper(['form']);
        $data = [];
        
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

        if ($this->request->getMethod() == 'post') {
            $validation = [
                'username' => 'required',
                'password' => 'required',
            ];
            $errors = [
                'username' => [
                    'required' => 'The username or email is required.',
                    'errors' => [
                        'required' => 'The email address is required',
                    ],
                ],
                'password' => [
                    'required' => 'The password is required',
                    'errors' => [
                        'required' => 'The email address is required',
                    ],
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
                    if ($user['role'] == 'Admin') {
                        $this->setAdminSession($user); 
                        return redirect()->to('dashboard');
                    } elseif ($user['role'] == 'Superadmin') {
                        $this->setSuperAdminSession($user); 
                        return redirect()->to('dashboard');
                    } elseif ($user['role'] == 'IT') {
                        $this->setITsession($user); 
                        return redirect()->to('dashboard');
                    } elseif ($user['role'] == 'Viewers') {
                        $this->setViewersSession($user); 
                        return redirect()->to('dashboard/viewers');
                    }
                } else {
                    $email = $this->request->getPost('username');
                    $session->set('email', $email);
                    $session->setFlashdata('msg', 'Wrong password');
                    $data['Flash_message'] = true;
                    
                }
            }
        }
        return view('login', $data);
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

    public function register_UsernameCheck()
    {
        $model = new Account_model();
        $emailOrUsername = $this->request->getPost('username');

        if (empty($emailOrUsername)) {
            $response['exists'] = false; 
        } else {
            $existingRecord = $model
                ->where('username', $emailOrUsername)
                ->first();

            $response = [];

            if ($existingRecord) {
                $response['exists'] = true;
            } else {
                $response['exists'] = false;
            }
        }

        return $this->response->setJSON($response);
    }

    public function register_emailCheck()
    {
        $model = new Account_model();
        $emailOrUsername = $this->request->getPost('email');

        if (empty($emailOrUsername)) {
            $response['exists'] = false; 
        } else {
            $existingRecord = $model
                ->where('email', $emailOrUsername)
                ->first();

            $response = [];

            if ($existingRecord) {
                $response['exists'] = true;
            } else {
                $response['exists'] = false;
            }
        }

        return $this->response->setJSON($response);
    }

    private function setAdminSession($admin)
    {
        $data = [
            'admin_id' => $admin['id'],
            'username' => $admin['username'],
            'email' => $admin['email'],
            'isLoggedIn' => true,
            'isAdmin' => true,
        ];
        session()->set($data);
    }

    private function setITsession($IT)
    {
        $data = [
            'IT_id' => $IT['id'],
            'username' => $IT['username'],
            'email' => $IT['email'],
            'isLoggedIn' => true,
            'isIT' => true,
        ];
        session()->set($data);
    }

    private function setSuperAdminSession($superadmin)
    {
        $data = [
            'superadmin_id' => $superadmin['id'],
            'username' => $superadmin['username'],
            'email' => $superadmin['email'],
            'isLoggedIn' => true,
            'isSuperAdmin' => true,
        ];
        session()->set($data);
    }

    private function setViewersSession($viewers)
    {
        $data = [
            'viewers_id' => $viewers['id'],
            'username' => $viewers['username'],
            'email' => $viewers['email'],
            'isLoggedIn' => true,
            'isViewers' => true,
        ];
        session()->set($data);
    }

    private function verifyMyPassword($enterpassword, $databasePassword)
    {   
        return password_verify($enterpassword, $databasePassword);
    }

    public function resetpassword()
    {
        return view('resetpassword');
    }
    
    public function sendResetLink()
    {
        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_not_unique[account.email]',
                    'errors' => [
                        'required' => 'The email field is required.',
                        'valid_email' => 'Please enter a valid email address.',
                        'is_not_unique' => 'Email does not exist.',
                    ],
                ],
            ];

            $validation = \Config\Services::validation();
            $validation->setRules($validationRules);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('validation', $validation);
            }

            $email = $this->request->getVar('email');

            $accountModel = new Account_model();
            $user = $accountModel->where('email', $email)->first();

            if (!$user) {
                return redirect()->back()->withInput()->with('error', 'Email not found in our database.');
            }

            $token = bin2hex(random_bytes(32));

            $user['token'] = $token;
            $accountModel->save($user);

            $resetLink = site_url('verify/otptoken/' . $token);
            $emailSubject = 'Reset Password';

            $email = \Config\Services::email();
            $email->setTo($user['email']);
            $email->setFrom('tamtech101@gmail.com');
            $email->setSubject($emailSubject);
            $email->setMailType('html');

            
            $message = view('admin/emails/otp_email', [
                'resetLink' => $resetLink,
            ]);

            $email->setMessage($message);  

            if ($email->send()) {
                return redirect()->to('/')->with('status_icon', 'success')->with('status', 'Reset link sent to your email');
            } else {
                $error = $email->printDebugger(['headers']);
                return redirect()->back()->with('error', 'Failed to send reset link: ' . $error);
            }
        }
        return redirect()->to('/');
    }

    public function token($token)
    {
        $accountModel = new Account_model();
        $user = $accountModel->where('token', $token)->first();

        if (!$user) {
            return redirect()->back() 
            ->with('status_icon', 'warning')
            ->with('status', 'Expired Link');
        }

        return view('newpassword', ['token' => $token]);
    }

    public function updatePassword()
    {
        $tokens = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $validation = \Config\Services::validation();

        if ($this->request->getMethod() == 'post') {
            $validationRules = [
                'password' => [
                    'rules'  => 'required|min_length[8]|max_length[100]',
                    'errors' => [
                        'required' => 'Password is required.',
                        'min_length' => 'Password must have atleast 8 characters in length.',
                        'max_length' => 'Password must not have characters more than 100 characters in length.',
                    ],
                ],
                'confirm_password' => [
                    'rules'  => 'matches[password]',
                    'errors' => [
                        'required' => 'Confirm password is required.',
                        'matches' => 'Password do not match',
                    ],
                ],
            ];

            $validation->setRules($validationRules);

            if ($validation->withRequest($this->request)->run()) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $accountModel = new Account_model();
                $user = $accountModel->where('token', $tokens)->first();

                if (!$user) {
                    return redirect()->back()
                        ->with('status_icon', 'warning')
                        ->with('status', 'Expired Link');
                }

                $user['password'] = $hashedPassword;
                $user['token'] = null;

                $accountModel->save($user);

                return redirect()->to('/')
                    ->with('status_icon', 'success')
                    ->with('status', 'Password Changed');
            }
        }

        return view('newpassword', [
            'validation' => $validation,
            'token' => $tokens,
        ]);
    }

    public function user_update($id)
    {
        $Account_model = new Account_model();

        $id = $this->request->getPost('id');
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role')
        ];

        $Account_model->update($id, $data);

        return redirect()->to('users/list')->with('success', 'Product updated successfully!');
    }
    public function user_Data()
    {
        $AccountModel = new Account_model();
        $session = session(); 
        
        if (!$session->get('isLoggedIn') || 
            (!$session->get('isAdmin') && 
             !$session->get('isSuperAdmin') && 
             !$session->get('isViewers') && 
             !$session->get('isIT'))) {
            return redirect()->to('/');
        }
        $userId = $session->get('isSuperAdmin') ? $session->get('superadmin_id') : 
                  ($session->get('isAdmin') ? $session->get('admin_id') : 
                  ($session->get('isIT') ? $session->get('IT_id') : 
                  $session->get('viewers_id')));
        
        $userData = $AccountModel->find($userId);
    
        $data = [
            'userData' => $userData,
        ];
        return view('admin/user_data', $data); 
    }
    
    public function email_profile_check()
    {
        $model = new Account_model();
        $email = $this->request->getPost('email_profile');
        $existingRecord = $model->where('email', $email)->first();
        if ($existingRecord) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
        return $this->response->setJSON($response);
    }
    public function username_profile_check()
    {
        $model = new Account_model();
        $username = $this->request->getPost('username_profile');
        $existingRecord = $model->where('username', $username)->first();
        if ($existingRecord) {
            $response['exists'] = true;
        } else {
            $response['exists'] = false;
        }
        return $this->response->setJSON($response);
    }

    public function profilUsername_update()
    {
        $Account_model = new Account_model();

        $id = $this->request->getPost('id');
        $data = [
            'username' => $this->request->getPost('username'),
        ];

        $Account_model->update($id, $data);

        return redirect()->to('users/data')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
    }

    public function profilfullname_update()
    {
        $Account_model = new Account_model();

        $id = $this->request->getPost('id');
        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
        ];

        $Account_model->update($id, $data);

        return redirect()->to('users/data')
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
    }

    public function profilEmail_update()
    {
        $Account_model = new Account_model();
        
        $id = $this->request->getPost('id');
        $emails = $this->request->getPost('email');
        $old_email = $this->request->getPost('old_email');
        $otp = mt_rand(100000, 999999); 
        
        $Account_model->update($id, ['verify_otp' => $otp]);
        
        session()->set('email', $emails);
        session()->set('old_email', $old_email);

        $email = \Config\Services::email();
        $email->setTo($emails);
        $email->setFrom('tamtech101@gmail.com');
        $email->setSubject('Change Email OTP');

        $email->setMailType('html');

        $message = view('admin/emails/verify_otpEmail', [
            'verify_myotp' => $otp
        ]);
        $email->setMessage($message);
        if ($email->send()) {
            return redirect()->to(site_url('verify-otp'))
            ->with('status_icon', 'success')    
            ->with('status', 'Success');
        }else{
            return redirect()->to(site_url('users/data'))
            ->with('status_icon', 'success')    
            ->with('status', 'Failed');
        }
    }
   
    public function verifyOtp_page()
    {
        $data = [
            'email' => session()->get('email'),
            'old_email' => session()->get('old_email'),
        ];

        return view('admin/verify_otp', $data);
    }

    public function verify()
    {
        $Account_model = new Account_model();
    
        $email = $this->request->getPost('email');
        $old_email = $this->request->getPost('old_email');
        $otp = $this->request->getPost('otp');
    
        $user = $Account_model->where('email', $old_email)->first();
    
        if (!$user) {
            return redirect()->to(site_url('verify-otp'))->with('error', 'User not found.');
        }
    
        if ($user['verify_otp'] == $otp) {
            $Account_model->update($user['id'], ['email' => $email, 'verify_otp' => null]);
    
            session()->remove('email');
            session()->remove('old_email');
    
            return redirect()->to('users/data')->with('status_icon', 'success')->with('status', 'Email updated successfully.');
        } else {
            return redirect()->to(site_url('verify-otp'))->with('error', 'Invalid OTP. Please try again.');
        }
    }

    public function profilePassword_update()
    {
        $password = $this->request->getPost('password');
        $id = $this->request->getPost('id');

        // Load necessary helpers and libraries
        helper(['form']);
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() == 'post') {
            $validationRules = [
                'password' => 'required|min_length[8]|max_length[100]',
                'confirm_password' => 'matches[password]',
            ];

            $validationMessages = [
                'password' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 8 characters long.',
                    'max_length' => 'Password must not exceed 100 characters.',
                ],
                'confirm_password' => [
                    'matches' => 'Passwords do not match.',
                ],
            ];

            $validation->setRules($validationRules, $validationMessages);

            if ($validation->withRequest($this->request)->run()) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $accountModel = new Account_model();

                $user = $accountModel->find($id);
                if (!$user) {
                    return redirect()->to('users/data')->with('error', 'User not found.');
                }

                $user['password'] = $hashedPassword;

                $accountModel->update($id, $user);

                return redirect()->to('users/data')->with('status', 'Password Changed');
            } else {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }
    }
    public function profileImage_update()
    {

        $Account_model = new Account_model();

        $id = $this->request->getPost('id');

        $profile_image = $Account_model->find($id);
        $old_img_name = $profile_image['profile_image'];
        $file = $this->request->getFile('profile_image');
        if($file->isValid() && !$file->hasMoved())
        {
            if(file_exists("image/profile_imageUpload/". $old_img_name)){
                unlink("image/profile_imageUpload/". $old_img_name);
            }
            $imageName = $file->getRandomName();
            $file->move('image/profile_imageUpload/', $imageName);
        }
        else{
            $imageName = $old_img_name;
        }
        $data = [
            'profile_image' => $imageName,
        ];

        $Account_model->update($id, $data);
        return redirect()->to('users/data')
                            ->with('status_icon', 'success')
                            ->with('status', 'Success');
        
    }
    // public function header_Data()
    // {
    //     $Account_model = new Account_model();
    //     $useSessionData = session()->get();
        
    //     if (empty($useSessionData['id'])) {
    //         return redirect()->to('/'); // Redirect to the landing page
    //     }

    //     $userData = $Account_model->find($useSessionData['id']);

    //     $data = [
    //         'userData' => $userData,
    //     ];
    
    //     return view('footer_headers/table_header', $data);
    // }
}
