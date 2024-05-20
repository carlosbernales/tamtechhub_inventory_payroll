<?php

namespace App\Controllers;
use App\Models\Account_model;
use App\Models\Agent_model;
use App\Models\Attendance_model;
use App\Models\Agent_leave;
use App\Models\Payslip_model;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\Agent_payslips;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Agent_files;
use App\Models\Resigned_details;

class Payroll extends BaseController
{
    use ResponseTrait;
    protected $db;
    public function __construct() {
        helper(['url', 'form','session']);
        $this->db = \Config\Database::connect();
    }
    
    public function payroll_agents()
    {
        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Agent_model();
        $Resigned_details = new Resigned_details();
        
        $agent_list = $model->where('status', 'Active')->findAll();
        
        $userId = session()->get('isPayrollSuperAdmin')
        ? $useSessionData['payroll_superadmin_id']
        : $useSessionData['payroll_admin_id'];
        $userData = $Account_model->find($userId);
        
        $resignedDetails = [];
        foreach ($agent_list as $agent) {
            $resignedDetails[$agent['id']] = $Resigned_details->where('agent_id', $agent['agent_id'])->findAll();
        }

        $data = [
            'userData' => $userData,
            'agent_list' => $model->where('status', 'Active')->findAll(),
            'resignedDetails' => $resignedDetails,
        ];

        return view('payroll/agent_list',$data);
    }

    public function payrollAgents_update($id)
    {
        $agentModel = new Agent_model();
        $Agent_leave = new Agent_leave();
        $Attendance_model = new Attendance_model();
    
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        }
         if ($this->request->getMethod() == 'post') {
        // Handle required_work formatting
        $required_work_input = $this->request->getVar('required_work');
        $required_work_formatted = $this->formatRequiredWork($required_work_input);
    
        $data = [
            'agent_name' => $this->request->getPost('agent_name'),
            'agent_id' => $this->request->getPost('agent_id'),
            'campaign' => $this->request->getPost('campaign'),
            'start_date' => $this->request->getPost('start_date'),
            'SSS' => $this->request->getPost('SSS'),
            'pag_ibig' => $this->request->getPost('pag_ibig'),
            'philhealth' => $this->request->getPost('philhealth'),
            'daily_salary' => $this->request->getPost('daily_salary'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
            'required_work' => $required_work_formatted,
            'user_email' => $this->request->getPost('user_email'),
            'house_rent' => $this->request->getPost('house_rent'),
        ];
    
        $agentModel->update($id, $data); // Update the agent details


        $Attendance_model->where('agent_id', $this->request->getPost('agent_old'))
                     ->set('agent_name', $this->request->getPost('agent_name'))
                     ->set('agent_id', $this->request->getPost('agent_id'))
                     ->update();
    
        $Agent_leave->where('agent_fk_id', $id)
                    ->set('agent_id', $this->request->getPost('agent_id'))
                    ->update();
    
        return redirect()->to('payroll/agents')
                        ->with('status_icon', 'success')
                        ->with('status', 'Success');
         }
    }
    
    public function updatePagIbig()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        } 

        $selectedAgentsJson = $this->request->getPost('selected_agents');
        $selectedAgents = json_decode($selectedAgentsJson, true); // Decode JSON string into array
        $pagIbigValue = $this->request->getPost('pag_ibig_value');

        if (!empty($selectedAgents)) {
            $agentModel = new Agent_model();
            foreach ($selectedAgents as $agentId) {
                $agentModel->update($agentId, ['pag_ibig' => $pagIbigValue]);
            }
        }
        return redirect()->back()
        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }

    public function updateDailySalary()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        } 

        $selectedAgentsJson = $this->request->getPost('selected_agents');
        $selectedAgents = json_decode($selectedAgentsJson, true); // Decode JSON string into array
        $dailySalaryValue = $this->request->getPost('daily_salary_value');

        if (!empty($selectedAgents)) {
            $agentModel = new Agent_model();
            foreach ($selectedAgents as $agentId) {
                $agentModel->update($agentId, ['daily_salary' => $dailySalaryValue]);
            }
        }
        return redirect()->back()
        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }

    public function updateSSS()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        } 

        $selectedAgentsJson = $this->request->getPost('selected_agents');
        $selectedAgents = json_decode($selectedAgentsJson, true); // Decode JSON string into array
        $SSSValue = $this->request->getPost('SSS_value');

        if (!empty($selectedAgents)) {
            $agentModel = new Agent_model();
            foreach ($selectedAgents as $agentId) {
                $agentModel->update($agentId, ['SSS' => $SSSValue]);
            }
        }
        return redirect()->back()
        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }
    
    public function update_requiredWork()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        } 

        $selectedAgentsJson = $this->request->getPost('selected_agents');
        $selectedAgents = json_decode($selectedAgentsJson, true); // Decode JSON string into array
        $RequiredWorkValue = $this->request->getPost('requiredWork_value');

        if (!empty($selectedAgents)) {
            $agentModel = new Agent_model();
            foreach ($selectedAgents as $agentId) {
                $agentModel->update($agentId, ['required_work' => $RequiredWorkValue]);
            }
        }
        return redirect()->back()
        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }

    public function update_philhealth()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        } 

        $selectedAgentsJson = $this->request->getPost('selected_agents');
        $selectedAgents = json_decode($selectedAgentsJson, true); // Decode JSON string into array
        $philhealthValue = $this->request->getPost('philhealth_value');

        if (!empty($selectedAgents)) {
            $agentModel = new Agent_model();
            foreach ($selectedAgents as $agentId) {
                $agentModel->update($agentId, ['philhealth' => $philhealthValue]);
            }
        }
        return redirect()->back()
        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }

    
    public function update_houserent()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        } 

        $selectedAgentsJson = $this->request->getPost('selected_agents');
        $selectedAgents = json_decode($selectedAgentsJson, true); // Decode JSON string into array
        $houseRentValue = $this->request->getPost('houserent_value');

        if (!empty($selectedAgents)) {
            $agentModel = new Agent_model();
            foreach ($selectedAgents as $agentId) {
                $agentModel->update($agentId, ['house_rent' => $houseRentValue]);
            }
        }
        return redirect()->back()
        ->with('status_icon', 'success')
                        ->with('status', 'Success');
    }


    public function attendance_calendar($agent_id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        } 

        $attendanceModel = new Attendance_model();
        $Agent_leave = new Agent_leave();

        $attendanceData = $attendanceModel->where('agent_id', $agent_id)->findAll();

        $paidLeaveData = $Agent_leave->where('agent_id', $agent_id)
            ->where('status', 'Used')
            ->findAll();

        $events = [];
        foreach ($attendanceData as $attendance) {
            $event = [
               'title' => $attendance['status'] === 'Absent' ? 'Absent' : (
                $attendance['status'] === 'OFF' ? 'OFF' : (
                    $attendance['status'] === 'Holiday Leave' ? 'Holiday Leave' : (
                        $attendance['status'] === 'OFF/Holiday' ? 'OFF/Holiday (Paid)' : 'Present'
                    )
                )
            ),

                'start' => $attendance['date'],
                'extendedProps' => [
                    'time_in' => $attendance['time_in'],
                    'time_out' => $attendance['time_out'],
                    'late_count' => $attendance['late_count'],
                    'early_out' => $attendance['early_out'],
                    'night_diff' => $attendance['night_diff'],
                    'overtime' => $attendance['ovetime'],
                    'nd_overtime' => $attendance['nd_overtime'],
                    'actual_work' => $attendance['actual_work']
                ]
            ];
            $events[] = $event;
        }
        foreach ($paidLeaveData as $leave) {
            $paidLeaveEvent = [
                'title' => 'Paid Leave',
                'start' => $leave['date_of_leave'], // Assuming this is the date of the leave
                'className' => 'paid-leave-event' // You can add custom CSS class for styling
            ];
            $events[] = $paidLeaveEvent;
        }

        // Pass the $events array to the view
        return view('payroll/calendar', ['events' => $events]);
    }
    



    public function payrollDelete_agents($id)
    {
        $Agent_model = new Agent_model();
        $agentFilesModel = new Agent_files();

        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        }
        $folderPath = FCPATH  . 'userFiles/' . $id;
    
        if (is_dir($folderPath)) {
            $this->deleteDirectory($folderPath);
        }
        $agentFilesModel->where('agent_fk_id', $id)->delete();

        $Agent_model->delete($id);

        return redirect()->to('payroll/agents')
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

    
    public function attendance_delete($id)
    {
        $Attendance_model = new Attendance_model();

        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        }

        $Attendance_model->delete($id);

        return redirect()->to('attendance/employee')
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }

    
    public function attendance()
    {
        // Ensure that the necessary session data is available
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        }
    
        // Instantiate the Attendance_model
        $model = new Attendance_model();
        
        // Fetch all attendance records
        $attendanceRecords = $model->findAll();
    
        // Convert late_count from minutes to hours and minutes
        // foreach ($attendanceRecords as &$record) {
        //     $lateMinutes = $record['late_count'];
        //     $hours = floor($lateMinutes / 60);
        //     $minutes = $lateMinutes % 60;
        //     $record['late_count'] = $hours . ' hours ' . $minutes . ' minutes';
        // }
    
        // Prepare data to pass to the view
        $data = [
            'attendance' => $attendanceRecords,
        ];
    
        // Load the view and pass data to it
        return view('payroll/attendance', $data);
    }
    

    public function convertToTime($input) {
        // Remove text like 'hrs', 'hours', 'mins', 'minutes'
        $input = preg_replace('/[a-zA-Z]+/', '', $input);

        if (strpos($input, '.') !== false) {
            $parts = explode('.', $input);
            $hours = str_pad($parts[0], 2, '0', STR_PAD_LEFT);
            $minutes = str_pad($parts[1], 2, '0', STR_PAD_LEFT);
            return $hours . ':' . $minutes . ':00';
        } else {
            return str_pad($input, 5, '0', STR_PAD_LEFT) . ':00';
        }
    }
    
   public function convertToTimeFormat($input) {
        $times = explode(',', $input);
        $formattedTimes = [];
    
        foreach ($times as $time) {
            $time = trim($time);
    
            if (preg_match('/^(.*)(am|pm)$/i', $time, $matches)) {
                // If input contains 'am' or 'pm', skip conversion
                $formattedTimes[] = $time;
            } elseif (strpos($time, ' ') !== false) {
                // Split times separated by space
                $splitTimes = explode(' ', $time);
    
                foreach ($splitTimes as $splitTime) {
                    if (preg_match('/^(\d{1,2}):(\d{2})$/', $splitTime, $timeMatches)) {
                        // Convert 24-hour format to 12-hour format
                        $hours = (int)$timeMatches[1];
                        $minutes = str_pad((int)$timeMatches[2], 2, '0', STR_PAD_LEFT);
                        $ampm = ($hours >= 12) ? 'PM' : 'AM';
    
                        $formattedTime = ($hours % 12 === 0 ? 12 : $hours % 12) . ':' . $minutes . ' ' . $ampm;
                        $formattedTimes[] = $formattedTime;
                    }
                }
            } elseif (preg_match('/^(\d{1,2}):(\d{2})$/', $time, $matches)) {
                // Convert 24-hour format to 12-hour format
                $hours = (int)$matches[1];
                $minutes = str_pad((int)$matches[2], 2, '0', STR_PAD_LEFT);
                $ampm = ($hours >= 12) ? 'PM' : 'AM';
    
                $formattedTime = ($hours % 12 === 0 ? 12 : $hours % 12) . ':' . $minutes . ' ' . $ampm;
                $formattedTimes[] = $formattedTime;
            }
        }
    
        return implode(', ', $formattedTimes);
    }

    public function upload_attendance() {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        }

        helper(['form', 'file']);

        $attendanceModel = new Attendance_model();
        $agentModel = new Agent_model();

        if ($this->request->getMethod() === 'post' && $this->validate(['upload_attendance' => 'uploaded[upload_attendance]|max_size[upload_attendance,1024]|ext_in[upload_attendance,xls,xlsx]'])) {
            $file = $this->request->getFile('upload_attendance');

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            $insertedRows = 0;

            foreach ($rows as $index => $row) {
                // Skip header row
                if ($index === 0) continue;

                $agentId = $row[0];
                $excelDate = $row[1];

                // Skip processing if time interval is empty

                if (!empty($excelDate) && strtotime($excelDate) !== false) {
                    $dateTime = \DateTime::createFromFormat('m/d/Y', $excelDate);
                    $formattedDate = $dateTime->format('Y-m-d');

                    $agent = $agentModel->where('agent_id', $agentId)->first();
                    if ($agent) {
                        $existingAttendance = $attendanceModel->where('agent_id', $agentId)
                            ->where('date', $formattedDate)
                            ->first();

                        if (!$existingAttendance) {
                            $time_in = !empty($row[2]) ? $this->convertToTimeFormat($row[2]) : 'None';
                            $time_out = !empty($row[3]) ? $this->convertToTimeFormat($row[3]) : 'None';
                            $actual_work = !empty($row[4]) ? $this->convertToTime($row[4]) : '00:00:00';
                            $night_diff = !empty($row[5]) ? $this->convertToTime($row[5]) : '00:00:00';
                            $overtime = !empty($row[6]) ? $this->convertToTime($row[6]) : '00:00:00';
                            $nd_overtime = !empty($row[7]) ? $this->convertToTime($row[7]) : '00:00:00';
                            $late = !empty($row[8]) ? $this->convertToTime($row[8]) : '00:00:00';
                            $early_out = !empty($row[9]) ? $this->convertToTime($row[9]) : '00:00:00';

                            $status = !empty($row[10]) ? $row[10] : 'Present';
                            $day_status = !empty($row[11]) ? $row[11] : 'Normal day';

                            $data = [
                                'agent_id' => $agentId,
                                'agent_name' => $agent['agent_name'], // Insert agent_name from Agent_model
                                'date' => $formattedDate,
                                'daily_salary' => $agent['daily_salary'],
                                'time_in' => $time_in,
                                'time_out' => $time_out,
                                'early_out' => $early_out,
                                'late_count' => $late,
                                'required_work' => $agent['required_work'],
                                'night_diff' => $night_diff,
                                'ovetime' => $overtime,
                                'nd_overtime' => $nd_overtime,
                                'actual_work' => $actual_work,
                                'status' => $status,
                                'day_status' => $day_status,
                            ];

                            $attendanceModel->insert($data);
                            $insertedRows++;
                        }
                    }
                }
            }

            if ($insertedRows > 0) {
                return redirect()->to('attendance/employee')
                    ->with('status_icon', 'success')
                    ->with('status', 'Attendance data uploaded successfully');
            } else {
                return redirect()->to('attendance/employee')
                    ->with('status_icon', 'error')
                    ->with('status', 'Failed to upload attendance data');
            }
        } else {
            return redirect()->to('attendance/employee')
                ->with('status_icon', 'error')
                ->with('status', 'Failed to upload attendance data');
        }
    }
    

    public function payroll_view()
    {
        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        }

        $Account_model = new Account_model();
        $model = new Agent_model();
        
        $userId = session()->get('isPayrollSuperAdmin')
        ? $useSessionData['payroll_superadmin_id']
        : $useSessionData['payroll_admin_id'];
        $userData = $Account_model->find($userId);

        $data = [
            // 'userData' => $userData,
            'agents' => $model->where('status', 'Active')->orderBy('agent_name', 'asc')->findAll(),
        ];

        return view('payroll/payroll_page',$data);
    }

    public function fetchLeaveData()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        } 
        $requestData = $this->request->getPost();

        $agentLeaveModel = new Agent_leave(); 

        $leaveData = $agentLeaveModel->getLeaveData($requestData['agent_id'], $requestData['start_date'], $requestData['end_date']);

        foreach ($leaveData as &$leave) {
            $leave['date_of_leave'] = date('l, F j, Y', strtotime($leave['date_of_leave']));
        }
        $response = [
            'leaveData' => $leaveData
        ];
        return $this->respond($response);
    }


    public function calculate_total_salary() 
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        } 
        $requestData = $this->request->getPost();
    
        $Agent_model = new Agent_model();
        
        $attendanceModel = new Attendance_model(); // Assuming your model is named Attendance_model

        
        $attendanceData = $attendanceModel->where('agent_id', $requestData['agent_id'])
                                           ->where('date >=', $requestData['start_date'])
                                           ->where('date <=', $requestData['end_date'])
                                           ->orderBy('date', 'asc')
                                           ->findAll();
                                           
        
        $agentDetails = $Agent_model->where('agent_id', $requestData['agent_id'])->first();
        
        $data = array();
        foreach ($attendanceData as $attendance) {
            $date = date_create($attendance['date']);
            $formattedDate = date_format($date, 'l, F j, Y');
    
            $requiredWork = $attendance['required_work'];
            $nightDiff = $attendance['night_diff'];
            $ovetime = $attendance['ovetime'];
            $lateCount = $attendance['late_count'];
            $earlyOut = $attendance['early_out'];
            $nd_overtime = $attendance['nd_overtime'];
            $actual_work = $attendance['actual_work'];
            $status = $attendance['status'];
            $day_status = $attendance['day_status'];
    
            $data[] = array(
                'date' => $formattedDate,
                'daily_salary' => $attendance['daily_salary'],
                'required_work' => $requiredWork,
                'night_diff' => $nightDiff,
                'ovetime' => $ovetime,
                'late_count' => $lateCount,
                'early_out' => $earlyOut,
                'nd_overtime' => $nd_overtime,
                'actual_work' => $actual_work,
                'status' => $status,
                'day_status' => $day_status,
            );
        }
        $response = array(
            'attendanceData' => $data,
            'SSS' => $agentDetails['SSS'],
            'pag_ibig' => $agentDetails['pag_ibig'],
            'philhealth' => $agentDetails['philhealth'],
            'required_work' => $agentDetails['required_work'],
            'daily_salary' => $agentDetails['daily_salary'],
            'agent_id' => $agentDetails['agent_id'],
            'agent_name' => $agentDetails['agent_name'],
            'user_email' => $agentDetails['user_email'],
            'house_rent' => $agentDetails['house_rent'],

        );
    
        return $this->response->setJSON($response);
    }


    public function leaveView($agentId)
    {
        $useSessionData = session()->get();
    
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        }
    
        $Account_model = new Account_model();
        $agentModel = new Agent_model();
        $Agent_leave = new Agent_leave();
    
        $agent = $agentModel->find($agentId);
    
        $currentYear = date('Y', strtotime('now'));
        $leave = $Agent_leave
            ->where('agent_fk_id', $agentId)
            ->where('YEAR(end_date)', $currentYear)
            ->findAll();
    
        $unusedCount = 0;
        $usedCount = 0;
        foreach ($leave as $leaveItem) {
            if ($leaveItem['status'] == 'Unused') {
                $unusedCount++;
            } elseif ($leaveItem['status'] == 'Used') {
                $usedCount++;
            }
        }
    
        $data = [
            'agent' => $agent,
            'leave' => $leave,
            'unusedCount' => $unusedCount,
            'usedCount' => $usedCount,
        ];
        
        return view('payroll/leaveView', $data);
    }

    public function leave_rows_optionalCOunt()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        } 
        $request = $this->request;
        $number_of_leave = $request->getPost('number_of_leave');
        $start_date = $request->getPost('start_date');
        $id = $request->getPost('id');
        $agent_id = $request->getPost('agent_id');
        $daily_salary = $request->getPost('daily_salary');
        $required_work = $request->getPost('required_work');

        $endOfYear = date('Y-12-31'); 

        $data = [];
        for ($i = 0; $i < $number_of_leave; $i++) {
            $data[] = [
                'required_work' => $required_work,
                'agent_id' => $agent_id,
                'agent_fk_id' => $id,
                'start_date' => $start_date,
                'end_date' => $endOfYear,
                'status' => 'Unused', 
                'comment' => 'None', 
                'date_of_leave' => '0000-00-00',
            ];
        }

        $agentLeaveModel = new Agent_leave();
        $agentLeaveModel->insertBatch($data);

        return redirect()->back();
    }

    
    public function update_leave($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        } 
        $Agent_leave = new Agent_leave();
        $Agent_model = new Agent_model();
    
        $id = $this->request->getPost('id');
        $agent_id = $this->request->getPost('agent_id');
    
        $agentData = $Agent_model->where('agent_id', $agent_id)->first();
        
        if ($agentData) {
            $data = [
                'date_of_leave' => $this->request->getPost('date_of_leave'),
                'comment' => $this->request->getPost('comment'),
                'status' => 'Used',
                'daily_salary' => $this->request->getPost('daily_salary'),
            ];
    
            $Agent_leave->update($id, $data);
    
            return redirect()->back()
                ->with('status_icon', 'success')
                ->with('status', 'Success');
        } else {
            return redirect()->back()
                ->with('status_icon', 'error')
                ->with('status', 'Agent not found.');
        }
    }
    
    public function delete_leave($id)
    {

        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        }

        $Agent_leave = new Agent_leave();

        $Agent_leave->delete($id);

        return redirect()->back()
            ->with('status_icon', 'success')
            ->with('status', 'Deleted');
    }


    public function add_leave_rows()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        } 
        $agentModel = new Agent_model();
        $agentLeaveModel = new Agent_leave();
    
        $agents = $agentModel->findAll(); 
    
        foreach ($agents as $agent) {
            $agent_fk_id = $agent['id'];
            $agent_id = $agent['agent_id']; // Assuming this is the field name in your database
            $required_work = $agent['required_work']; // Assuming this is the field name in your database
    
            $existingRowsCount = $agentLeaveModel->where('agent_fk_id', $agent_fk_id)->countAllResults();
    
            $rowsToAdd = 5 - $existingRowsCount;
    
            if ($rowsToAdd > 0) {
                $startOfYear = date('Y-01-01'); 
                $endOfYear = date('Y-12-31'); 
    
                for ($i = 0; $i < $rowsToAdd; $i++) {
                    $data = [
                        'agent_fk_id' => $agent_fk_id,
                        'agent_id' => $agent_id, // Include agent_id in the data array
                        'required_work' => $required_work, // Include required_work in the data array
                        'comment' => 'None',
                        'status' => 'Unused',
                        'date_of_leave' => 'None', 
                        'start_date' => $startOfYear,
                        'end_date' => $endOfYear,
                    ];
    
                    $agentLeaveModel->insert($data);
                }
            }
        }
    
        return $this->response->setJSON(['success' => true, 'message' => 'Rows inserted successfully']);
    }

    public function leaveHistory($agentId)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        } 
        $Agent_leave = new Agent_leave();
        $agentModel = new Agent_model();
        
        $leave = $Agent_leave
            ->where('agent_fk_id', $agentId)
            ->findAll();
        
        $leaveByYear = [];
        $currentYear = date('Y'); // Get the current year
        
        foreach ($leave as $leaveItem) {
            $year = date('Y', strtotime($leaveItem['end_date']));
            
            if ($year != $currentYear) {
                $leaveByYear[$year][] = $leaveItem;
            }
        }
        $agent = $agentModel->find($agentId);
    
        $data = [
            'leaveByYear' => $leaveByYear,
            'agent' => $agent,
        ];
        
        return view('payroll/leave_history', $data);
    }

    public function generatePayslip()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        } 
        $payslipno = mt_rand(10000000, 99999999);
        $input_start_date = $this->request->getVar('input_start_date');
        $input_end_date = $this->request->getVar('input_end_date');
    
        $start_date_formatted = date('F j, Y', strtotime($input_start_date));
    
        $end_date_formatted = date('F j, Y', strtotime($input_end_date));
    
        $data = [
            'input_attendanceData' => json_decode($this->request->getVar('input_attendanceData'), true),
            'input_leaveData' => json_decode($this->request->getVar('input_leaveData'), true),
            'payslipno' => $payslipno,
            'input_row_of_attendaceData' => $this->request->getVar('input_row_of_attendaceData'),
            'input_row_of_leaveData' => $this->request->getVar('input_row_of_leaveData'),
            'input_start_date' => $start_date_formatted,
            'input_end_date' => $end_date_formatted,
            'start_date' => $input_start_date,
            'end_date' => $input_end_date,
            'input_agent_name' => $this->request->getVar('input_agent_name'),
            'input_agent_id' => $this->request->getVar('input_agent_id'),
            'input_total_salary_before' => $this->request->getVar('input_total_salary_before'),
            'input_paid_leave' => $this->request->getVar('input_paid_leave'),
            'input_sss_deduction' => $this->request->getVar('input_sss_deduction'),
            'input_pag_ibig_deduction' => $this->request->getVar('input_pag_ibig_deduction'),
            'input_philhealth_deduction' => $this->request->getVar('input_philhealth_deduction'),
            'input_total_late_count' => $this->request->getVar('input_total_late_count'),
            'input_total_late_count_calculated' => $this->request->getVar('input_total_late_count_calculated'),
            'input_total_undertime_calculated' => $this->request->getVar('input_total_undertime_calculated'),
            'input_total_undertime_count' => $this->request->getVar('input_total_undertime_count'),
            'input_total_deductions' => $this->request->getVar('input_total_deductions'),
            'input_total_salary_after' => $this->request->getVar('input_total_salary_after'),
            'input_house_rent' => $this->request->getVar('input_house_rent'),
            'input_other_deduction' => $this->request->getVar('input_other_deduction'),
            'input_bonus' => $this->request->getVar('input_bonus'),
            'input_incentives' => $this->request->getVar('input_incentives'),
            'input_user_email' => $this->request->getVar('input_user_email'),
            'input_total_overtime_pay' => $this->request->getVar('input_total_overtime_pay'),
            'input_total_ND_pay' => $this->request->getVar('input_total_ND_pay'),
            
            'input_total_NDOT_pay' => $this->request->getVar('input_total_NDOT_pay'),
            
            
            'input_other_add_pay' => $this->request->getVar('input_other_add_pay'),
            'sss_loan' => $this->request->getVar('sss_loan'),
            'pag_ibig_loan' => $this->request->getVar('pag_ibig_loan'),
            'input_base_pay' => $this->request->getVar('input_base_pay'),
            'input_specify' => $this->request->getVar('input_specify'),
            'specify_deduction' => $this->request->getVar('specify_deduction'),
            'total_OFF' => $this->request->getVar('total_OFF'),
            'total_absent' => $this->request->getVar('total_absent'),
            'cashAdvanceInput' => $this->request->getVar('cashAdvanceInput'),
            'campAllow_input' => $this->request->getVar('campAllow_input'),
            'input_other1_add_pay' => $this->request->getVar('input_other1_add_pay'),
            'input_specify1' => $this->request->getVar('input_specify1'),
            'input_other_deductionOne' => $this->request->getVar('input_other_deductionOne'),
            'specifyOne_input' => $this->request->getVar('specifyOne_input'),

            'RD_totalPay_input' => $this->request->getVar('RD_totalPay_input'),
            'RdNd_totalPay_input' => $this->request->getVar('RdNd_totalPay_input'),
            'RdOvertime_totalPay_input' => $this->request->getVar('RdOvertime_totalPay_input'),
            'RdNdOvertime_totalPay_input' => $this->request->getVar('RdNdOvertime_totalPay_input'),

            'Rh_totalPay_input' => $this->request->getVar('Rh_totalPay_input'),
            'RhNd_totalPay_input' => $this->request->getVar('RhNd_totalPay_input'),
            'RhOvertime_totalPay_input' => $this->request->getVar('RhOvertime_totalPay_input'),
            'RhNdOvertime_totalPay_input' => $this->request->getVar('RhNdOvertime_totalPay_input'),

            'RhRd_totalPay_input' => $this->request->getVar('RhRd_totalPay_input'),
            'RhRdNd_totalPay_input' => $this->request->getVar('RhRdNd_totalPay_input'),
            'RhRdOvertime_totalPay_input' => $this->request->getVar('RhRdOvertime_totalPay_input'),
            'RhRdNdOvertime_totalPay_input' => $this->request->getVar('RhRdNdOvertime_totalPay_input'),

            'Sp_totalPay_input' => $this->request->getVar('Sp_totalPay_input'),
            'SpNd_totalPay_input' => $this->request->getVar('SpNd_totalPay_input'),
            'SpOvertime_totalPay_input' => $this->request->getVar('SpOvertime_totalPay_input'),
            'SpNdOvertime_totalPay_input' => $this->request->getVar('SpNdOvertime_totalPay_input'),

            'SpRd_totalPay_input' => $this->request->getVar('SpRd_totalPay_input'),
            'SpRdNd_totalPay_input' => $this->request->getVar('SpRdNd_totalPay_input'),
            'SpRdOvertime_totalPay_input' => $this->request->getVar('SpRdOvertime_totalPay_input'),
            'SpRdNdOvertime_totalPay_input' => $this->request->getVar('SpRdNdOvertime_totalPay_input'),
            
            'Db_totalPay_input' => $this->request->getVar('Db_totalPay_input'),
            'DbNd_totalPay_input' => $this->request->getVar('DbNd_totalPay_input'),
            'DbOvertime_totalPay_input' => $this->request->getVar('DbOvertime_totalPay_input'),
            'DbNdOvertime_totalPay_input' => $this->request->getVar('DbNdOvertime_totalPay_input'),

            'DbRd_totalPay_input' => $this->request->getVar('DbRd_totalPay_input'),
            'DbRdNd_totalPay_input' => $this->request->getVar('DbRdNd_totalPay_input'),
            'DbRdOvertime_totalPay_input' => $this->request->getVar('DbRdOvertime_totalPay_input'),
            'DbRdNdOvertime_totalPay_input' => $this->request->getVar('DbRdNdOvertime_totalPay_input'),

            'Dsh_totalPay_input' => $this->request->getVar('Dsh_totalPay_input'),
            'DshNd_totalPay_input' => $this->request->getVar('DshNd_totalPay_input'),
            'DshOvertime_totalPay_input' => $this->request->getVar('DshOvertime_totalPay_input'),
            'DshNdOvertime_totalPay_input' => $this->request->getVar('DshNdOvertime_totalPay_input'),

            'DshRd_totalPay_input' => $this->request->getVar('DshRd_totalPay_input'),
            'DshRdNd_totalPay_input' => $this->request->getVar('DshRdNd_totalPay_input'),
            'DshRdOvertime_totalPay_input' => $this->request->getVar('DshRdOvertime_totalPay_input'),
            'DshRdNdOvertime_totalPay_input' => $this->request->getVar('DshRdNdOvertime_totalPay_input'),
            
            
            'normal_totalPay_input' => $this->request->getVar('normal_totalPay_input'),
            'normalNd_totalPay_input' => $this->request->getVar('normalNd_totalPay_input'),
            'normalOT_totalPay_input' => $this->request->getVar('normalOT_totalPay_input'),
            'normalNdOvertime_totalPay_input' => $this->request->getVar('normalNdOvertime_totalPay_input'),
            
            'holidayleavePaid' => $this->request->getVar('holidayleavePaid'),

            'regHolPaid' => $this->request->getVar('regHolPaid'),
            
            'paid_leave' => $this->request->getVar('paid_leave'),

        ];
        return view('payroll/payslip', $data);
    }
    public function generate_payslip()
    {
        $pdfFile = $this->request->getFile('pdf');

        if (!$pdfFile->isValid()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid PDF file']);
        }

        // Generate a random name for the PDF
        $pdfName = 'payslip_' . uniqid() . '.pdf';

        // Move the uploaded PDF to the specified folder
        $savePath = FCPATH . 'payslip_pdf/' . $pdfName;
        $pdfFile->move(FCPATH . 'payslip_pdf', $pdfName);

        // Retrieve additional data from the request
        $request = service('request');

        $payslipModel = new Payslip_model();
        $Agent_payslips = new Agent_payslips();

        $data = [
            'image_name' => $pdfName,
            'user_email' => $request->getPost('user_email'),
            'agent_name' => $request->getPost('agent_name'),
            'payslip_no' => $request->getPost('payslip_no'),
            'startDate' => $request->getPost('start_date'),
            'end_date' => $request->getPost('end_date'),
            'status' => 'not_send',
        ];
        $payslipModel->insert($data);

        $datas = [
            'base_pay' => $request->getPost('base_pay'),
            'payslip_no' => $request->getPost('payslip_no'),
            'attendance_bonus' => $request->getPost('attendance_bonus'),
            'agent_name' => $request->getPost('agent_name'),
            'spiff_incentive' => $request->getPost('spiff_incentive'),
            'overtime_pay' => $request->getPost('overtime_pay'),
            'nd_pay' => $request->getPost('nd_pay'),
            'ndOt_pay' => $request->getPost('ndOt_pay'),
            'other_add' => $request->getPost('other_add'),
            'gross_pay' => $request->getPost('gross_pay'),
            'late_deduction' => $request->getPost('late_deduction'),
            'undertime_deduction' => $request->getPost('undertime_deduction'),
            'sss_deduction' => $request->getPost('sss_deduction'),
            'pag_ibig_deduction' => $request->getPost('pag_ibig_deduction'),
            'philhealth_deduction' => $request->getPost('philhealth_deduction'),
            'sss_loan' => $request->getPost('sss_loan'),
            'pag_ibig_loan' => $request->getPost('pag_ibig_loan'),
            'house_rent' => $request->getPost('house_rent'),
            'other_deduction' => $request->getPost('other_deduction'),
            'total_deduction' => $request->getPost('total_deduction'),
            'total_net_pay' => $request->getPost('total_net_pay'),
            'startDate' => $request->getPost('start_date'),
            'end_date' => $request->getPost('end_date'),
            'others_add_comment' => $request->getPost('others_add_comment'),
            'others_deduc_comment' => $request->getPost('others_deduc_comment'),
            'cash_advance' => $request->getPost('cash_advance'),
            'camp_allowance' => $request->getPost('camp_allowance'),
            'other_addPay_one' => $request->getPost('other_addPay_one'),
            'otherAddComment_one' => $request->getPost('otherAddComment_one'),
            'Otherdeduc_one' => $request->getPost('Otherdeduc_one'),
            'DeducComment_one' => $request->getPost('DeducComment_one'),
        ];
        $Agent_payslips->insert($datas);

        return $this->response->setJSON(['success' => true, 'pdf_path' => $savePath]);
    }

    // public function save_image()
    // {
    //     if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
    //     return redirect()->to('landingpage');
    //     } 

    //     $request = service('request');
    //     $image = $request->getFile('image');

    //     if ($image->isValid() && $image->getClientMimeType() === 'image/png') {
    //         $randomName = uniqid() . '_' . time() . '.png';

    //         $image->move(FCPATH . 'payslip_image', $randomName);

    //     // Handle other form data
    //     $payslipModel = new Payslip_model(); 
    //     $Agent_payslips = new Agent_payslips();
        
    //     $data = [
    //             'image_name' => $randomName,
    //             'user_email' => $request->getPost('user_email'),
    //             'agent_name' => $request->getPost('agent_name'),
    //             'payslip_no' => $request->getPost('payslip_no'),
    //             'startDate' => $request->getPost('start_date'),
    //             'end_date' => $request->getPost('end_date'),
    //             'status' => 'not_send',
    //         ];
    //         $payslipModel->insert($data);

    //         $datas = [
    //             'base_pay' => $request->getPost('base_pay'),
    //             'payslip_no' => $request->getPost('payslip_no'),
    //             'attendance_bonus' => $request->getPost('attendance_bonus'),
    //             'agent_name' => $request->getPost('agent_name'),
    //             'spiff_incentive' => $request->getPost('spiff_incentive'),
    //             'overtime_pay' => $request->getPost('overtime_pay'),
    //             'nd_pay' => $request->getPost('nd_pay'),
    //             'other_add' => $request->getPost('other_add'),
    //             'gross_pay' => $request->getPost('gross_pay'),
    //             'late_deduction' => $request->getPost('late_deduction'),
    //             'undertime_deduction' => $request->getPost('undertime_deduction'),
    //             'sss_deduction' => $request->getPost('sss_deduction'),
    //             'pag_ibig_deduction' => $request->getPost('pag_ibig_deduction'),
    //             'philhealth_deduction' => $request->getPost('philhealth_deduction'),
    //             'sss_loan' => $request->getPost('sss_loan'),
    //             'pag_ibig_loan' => $request->getPost('pag_ibig_loan'),
    //             'house_rent' => $request->getPost('house_rent'),
    //             'other_deduction' => $request->getPost('other_deduction'),
    //             'total_deduction' => $request->getPost('total_deduction'),
    //             'total_net_pay' => $request->getPost('total_net_pay'),
    //             'startDate' => $request->getPost('start_date'),
    //             'end_date' => $request->getPost('end_date'),
    //             'others_add_comment' => $request->getPost('others_add_comment'),
    //             'others_deduc_comment' => $request->getPost('others_deduc_comment'),
                
    //             'cash_advance' => $request->getPost('cash_advance'),
    //             'camp_allowance' => $request->getPost('camp_allowance'),
    //             'other_addPay_one' => $request->getPost('other_addPay_one'),
    //             'otherAddComment_one' => $request->getPost('otherAddComment_one'),
    //             'Otherdeduc_one' => $request->getPost('Otherdeduc_one'),
    //             'DeducComment_one' => $request->getPost('DeducComment_one'),
                
                
    //         ];
    //         $Agent_payslips->insert($datas);

    //         return $this->response->setStatusCode(200)->setJSON(['message' => 'Image saved and data inserted successfully.']);
    //     } else {
    //         return $this->response->setStatusCode(500)->setJSON(['message' => 'Error saving image or invalid image format.']);
    //     }
    // }
    public function payslip_list()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        } 
        $useSessionData = session()->get();

        $model = new Payslip_model();
        
        $data = [
            'payslip' => $model->where('status', 'not_send')->findAll(),
        ];

        return view('payroll/payslip_list', $data);
    }
    public function payslip_sendMail()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        } 
        $payslipNo = $this->request->getPost('payslip_no');
        $agentName = $this->request->getPost('agent_name');
        $userEmail = $this->request->getPost('user_email');
        $startDates = $this->request->getPost('startDate');
        $enDdate = $this->request->getPost('end_date');

        $imagePath = FCPATH . 'payslip_pdf/' . $this->request->getPost('image_name');
    
        $email = \Config\Services::email();
    
        $email->setFrom('tamtech101@gmail.com');
        $email->setTo($userEmail);
        $email->setSubject('Payslip');
        $email->attach($imagePath);


        $email->setMailType('html');

        $message = view('admin/emails/payslip_mail', [
            'startDate' => $startDates,
            'end_date' => $enDdate,
            'agent_name' => $agentName,
        ]);
        $email->setMessage($message);
        if ($email->send()) {
            $model = new Payslip_model();
            $model->updatePayslipStatus($payslipNo); // Update status after sending email
            return $this->response->setJSON(['success' => true, 'message' => 'Email sent successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Error sending email.']);
        }
    }

    public function payslip_history()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        } 
        $useSessionData = session()->get();

        $model = new Payslip_model();
        
        $data = [
            'payslips' => $model->getPayslipsWithFormattedDate(),
        ];

        return view('payroll/payslip_history', $data);
    }


    public function saveDates()
    {
        $request = $this->request->getJSON();

        // Save the dates to session
        session()->set('lastStartDate', $request->startDate);
        session()->set('lastEndDate', $request->endDate);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function add_agent()
    {
        $model = new Agent_model();
    
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        }      
        
        $data = [];
    
        if ($this->request->getMethod() == 'post') {
            // Handle required_work formatting
            $required_work_input = $this->request->getVar('required_work');
            $required_work_formatted = $this->formatRequiredWork($required_work_input);
    
            $data = [
                'agent_name' => $this->request->getVar('agent_name'),
                'agent_id' => $this->request->getVar('agent_id'),
                'campaign' => $this->request->getVar('campaign'),
                'start_date' => $this->request->getVar('start_date'),
                'user_email' => $this->request->getVar('user_email'),
                'required_work' => $required_work_formatted,
                'daily_salary' => $this->request->getVar('daily_salary'),
                'SSS' => $this->request->getVar('SSS'),
                'pag_ibig' => $this->request->getVar('pag_ibig'),
                'philhealth' => $this->request->getVar('philhealth'),
                'house_rent' => $this->request->getVar('house_rent'),
            ];
            if ($model->save($data)) {
                return redirect()->to('payroll/agents')
                    ->with('status_icon', 'success')
                    ->with('status', 'Success');
            }
        }
    
        return view('payroll/agent_list', $data);
    }
    
    private function formatRequiredWork($input)
    {
        $parts = explode('.', $input);
        $hours = isset($parts[0]) ? str_pad($parts[0], 2, '0', STR_PAD_LEFT) : '00';
        $minutes = isset($parts[1]) ? str_pad($parts[1], 2, '0', STR_PAD_LEFT) : '00';
        $seconds = '00'; // Assuming seconds are always 00
    
        return "$hours:$minutes:$seconds";
    }



    public function delete_payslip_leave($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        }

        $Payslip_model = new Payslip_model();
        $Agent_payslips = new Agent_payslips();

        $payslip = $Payslip_model->find($id);

        if ($payslip) {
            $image_name = $payslip['image_name'];
            $payslip_no = $payslip['payslip_no'];

            $Payslip_model->delete($id);

            $Agent_payslips->where('payslip_no', $payslip_no)->delete();

            if ($image_name && file_exists(FCPATH . 'payslip_pdf/' . $image_name)) {
                unlink(FCPATH . 'payslip_pdf/' . $image_name);
            }

            return redirect()->back()
                ->with('status_icon', 'success')
                ->with('status', 'Deleted');
        } else {
            return redirect()->back()
                ->with('status_icon', 'error')
                ->with('status', 'Payslip not found');
        }
    }
    
    public function deleteMultipleAttendance()
    {
        $ids = $this->request->getPost('ids');

        $attendanceModel = new Attendance_model();

        foreach ($ids as $id) {
            $attendanceModel->delete($id);
        }
        return $this->response->setJSON(['success' => true]);
    }
    
    public function agent_payslips()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        } 
        $useSessionData = session()->get();

        $model = new Agent_payslips();
        
        $data = [
            'agent_payslips' => $model->findAll(),
        ];

        return view('payroll/agent_payslips',$data);
    }

    public function get_payslips_data()
    {
        
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('landingpage');
        }
        
        $startDate = $this->request->getGet('startDate');
        $endDate = $this->request->getGet('endDate');
    
        // Fetch data from the database based on the startDate and endDate
        $model = new Agent_payslips();
        $data = $model->where('startDate', $startDate)
                ->where('end_date', $endDate)
                ->findAll();
    
        return $this->response->setJSON($data);
    }
    
    public function downloadTemplate()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
        return redirect()->to('landingpage');
        }
        $file = FCPATH . 'payroll_template/attendance_template.xlsx'; // Path to your file relative to public directory
        return $this->response->download($file, null); // Download the file
    }
    
    
     //resigned agents
    public function payroll_resignedTerminatedAgent_list()
    {
        $useSessionData = session()->get();

        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
        return redirect()->to('landingpage');
        }

        $Account_model = new Account_model();
        $model = new Agent_model();
        
         $Resigned_details = new Resigned_details();
         
        $agent_list = $model->whereIn('status', ['Resigned','Terminated'])->findAll();
        
        $resignedDetails = [];
        foreach ($agent_list as $agent) {
            $resignedDetails[$agent['id']] = $Resigned_details->where('agent_id', $agent['agent_id'])->findAll();
        }

        $data = [
            'agent_list' => $model->whereIn('status', ['Resigned','Terminated'])->findAll(),
            'resignedDetails' => $resignedDetails,
        ];

        return view('payroll/resignedTerminated_agents',$data);
    }
    

    public function resigned($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        }
        
        $Agent_model = new Agent_model();
        $Resigned_details = new Resigned_details();

        $id = $this->request->getPost('id');
        
        // Get the post data
        $data = [
            'status' => $this->request->getPost('status'),
        ];

        // Update the agent status
        $Agent_model->update($id, $data);

        // Insert into resigned details
        $resignedData = [
            'comment' => $this->request->getPost('comment'),
            'agent_id' => $this->request->getPost('agent_id'),
            'status' => $this->request->getPost('status'),
            'date' => $this->request->getPost('date'),
        ];
        $Resigned_details->insert($resignedData);

        return redirect()->back()
                ->with('status_icon', 'success')
                ->with('status', 'Success');
    }
    
    public function bactoActive($id)
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        }
        
        $Agent_model = new Agent_model();

        $id = $this->request->getPost('id');
        
        // Get the post data
        $data = [
            'status' => $this->request->getPost('status'),
        ];


        $Agent_model->update($id, $data);


        return redirect()->back()
                ->with('status_icon', 'success')
                ->with('status', 'Success');
    }
    //resigned agents
    
    public function extractAttendance()
    {
        if (!session()->get('isLoggedIn') || (!session()->get('isPayrollAdmin') && !session()->get('isPayrollSuperAdmin'))) {
            return redirect()->to('/');
        }
        $attendanceModel = new Attendance_model();
    
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');
    
        $startDateFormatted = date('F j, Y', strtotime($startDate));
        $endDateFormatted = date('F j, Y', strtotime($endDate));
    
        $attendanceData = $attendanceModel->where('date >=', $startDate)
                                          ->where('date <=', $endDate)
                                          ->findAll();
    
        if (!$attendanceData) {
            
            echo "<script>alert('No attendance data found for the specified date range.'); window.history.back();</script>";
            exit(); 
        }
    
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        $row = 1;
    
        $agentIdProcessed = []; 
    
        $sheet->setCellValueByColumnAndRow(1, $row, 'Start Date');
        $sheet->setCellValueByColumnAndRow(2, $row, $startDateFormatted);
        $row++;
        $sheet->setCellValueByColumnAndRow(1, $row, 'End Date');
        $sheet->setCellValueByColumnAndRow(2, $row, $endDateFormatted);
        $row++;
    
        foreach ($attendanceData as $attendance) {
            $agentId = $attendance['agent_id'];
    
            if (!in_array($agentId, $agentIdProcessed)) {
                if ($row !== 3) {
                    $row += 2;
                }
    
                $sheet->setCellValueByColumnAndRow(1, $row, 'Agent Name');
                $sheet->setCellValueByColumnAndRow(2, $row, 'Agent ID');
    
                $row++;
    
                $sheet->setCellValueByColumnAndRow(1, $row, $attendance['agent_name']);
                $sheet->setCellValueByColumnAndRow(2, $row, $agentId);
    
                $row++;
    
                $agentIdProcessed[] = $agentId;
    
                $headers = [
                    'Date', 'Time In', 'Time Out', 'Actual Work', 'Night Diff', 'Overtime', 'Status', 'Day Status'
                ];
    
                foreach ($headers as $col => $header) {
                    $sheet->setCellValueByColumnAndRow($col + 1, $row, $header);
                }
    
                $row++;
            }
    
            $dateFormatted = date('F j, Y', strtotime($attendance['date']));
    
            $actualWork = $this->convertTime($attendance['actual_work']);
            $nightDiff = $this->convertTime($attendance['night_diff']);
            $overtime = $this->convertTime($attendance['ovetime']);
    
            $sheet->setCellValueByColumnAndRow(1, $row, $dateFormatted);
            $sheet->setCellValueByColumnAndRow(2, $row, $attendance['time_in']);
            $sheet->setCellValueByColumnAndRow(3, $row, $attendance['time_out']);
            $sheet->setCellValueByColumnAndRow(4, $row, $actualWork);
            $sheet->setCellValueByColumnAndRow(5, $row, $nightDiff);
            $sheet->setCellValueByColumnAndRow(6, $row, $overtime);
            $sheet->setCellValueByColumnAndRow(7, $row, $attendance['status']);
            $sheet->setCellValueByColumnAndRow(8, $row, $attendance['day_status']);
    
            $row++;
        }
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="attendance.xlsx"');
        header('Cache-Control: max-age=0');
    
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    
    private function convertTime($time)
    {
        $timeArray = explode(':', $time);
    
        $hours = intval($timeArray[0]);
        $minutes = intval($timeArray[1]);
        $seconds = intval($timeArray[2]);
    
        $timeString = '';
    
        if ($hours > 0) {
            $timeString .= $hours . ' hours';
        }
    
        if ($minutes > 0) {
            $timeString .= ($hours > 0 ? ' ' : '') . $minutes . ' minutes';
        }
    
        if (empty($timeString)) {
            $timeString = '0 minutes';
        }
    
        return $timeString;
    }
    

}
