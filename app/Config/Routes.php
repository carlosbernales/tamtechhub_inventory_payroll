<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('');
$routes->setDefaultMethod('');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.



//superadmin
$routes->match(['get','post'], '/', 'Home::index', ['filter' => 'noauth']);
$routes->match(['get','post'], 'Register', 'Account::register', ['filter' => 'noauth']);
$routes->match(['get','post'], 'login', 'Account::signin', ['filter' => 'noauth']);
$routes->match(['get','post'], 'dashboard', 'Home::dashboard', ['filter' => 'auth']);
$routes->match(['get','post'], 'verify_admin/(:any)', 'Account::verify_admin/$1', ['filter' => 'noauth']);
$routes->match(['get','post'], 'verify_itOfficer/(:any)', 'Account::verify_it_officer/$1', ['filter' => 'noauth']);

$routes->match(['get','post'], 'users/list', 'Home::users', ['filter' => 'auth']);
$routes->match(['get','post'], 'user/update(:any)', 'Account::user_update/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'users/data', 'Account::user_Data', ['filter' => 'auth']);
$routes->match(['get','post'], 'email_profile/check', 'Account::email_profile_check', ['filter' => 'auth']);
$routes->match(['get','post'], 'username_profile/check', 'Account::username_profile_check', ['filter' => 'auth']);
$routes->match(['get','post'], 'profilUsername/update', 'Account::profilUsername_update', ['filter' => 'auth']);
$routes->match(['get','post'], 'profilEmail/update', 'Account::profilEmail_update', ['filter' => 'auth']);
$routes->match(['get','post'], 'verify-otp', 'Account::verifyOtp_page', ['filter' => 'auth']);
$routes->match(['get','post'], 'verifyOTP', 'Account::verify', ['filter' => 'auth']);
$routes->match(['get','post'], 'profilePassword/update', 'Account::profilePassword_update', ['filter' => 'auth']);
$routes->match(['get','post'], 'emailOrUsername/Check', 'Account::emailOrUsernameCheck', ['filter' => 'noauth']);
$routes->match(['get','post'], 'register/UsernameCheck', 'Account::register_UsernameCheck', ['filter' => 'noauth']);
$routes->match(['get','post'], 'register/emailCheck', 'Account::register_emailCheck', ['filter' => 'noauth']);
$routes->match(['get','post'], 'profilfullname/update', 'Account::profilfullname_update', ['filter' => 'noauth']);
$routes->match(['get','post'], 'profileImage/update', 'Account::profileImage_update', ['filter' => 'auth']);



//viewers
$routes->match(['get','post'], 'agent/viewers', 'Viewers::agent_list_viewers', ['filter' => 'auth']);
$routes->match(['get','post'], 'dashboard/viewers', 'Viewers::views_dashboard', ['filter' => 'auth']);
$routes->match(['get','post'], 'cpu/viewers', 'Viewers::cpu_list_viewers', ['filter' => 'auth']);
$routes->match(['get','post'], 'headset/viewers', 'Viewers::headset_list_viewers', ['filter' => 'auth']);
$routes->match(['get','post'], 'mouse/viewers', 'Viewers::mouse_list_viewers', ['filter' => 'auth']);
$routes->match(['get','post'], 'keyboard/viewers', 'Viewers::keyboard_list_viewers', ['filter' => 'auth']);
$routes->match(['get','post'], 'monitor/viewers', 'Viewers::monitor_list_viewers', ['filter' => 'auth']);
$routes->match(['get','post'], 'agentmonitor/viewers', 'Viewers::agentmonitor_list_viewers', ['filter' => 'auth']);
$routes->match(['get','post'], 'phone/viewers', 'Viewers::phone_list_viewers', ['filter' => 'auth']);
$routes->match(['get','post'], 'sgsimcard/viewers', 'Viewers::sgsimcard_list_viewers', ['filter' => 'auth']);
$routes->match(['get','post'], 'laptop/viewers', 'Viewers::laptop_list_viewers', ['filter' => 'auth']);
$routes->match(['get','post'], 'webcam/viewers', 'Viewers::webcam_list_viewers', ['filter' => 'auth']);
$routes->match(['get','post'], 'locker/viewers', 'Viewers::locker_list_viewers', ['filter' => 'auth']);


//agents

$routes->match(['get','post'], 'agents', 'Home::agent_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'add_agent', 'Home::add_agent', ['filter' => 'auth']);
$routes->match(['get','post'], 'agents_update(:any)', 'Home::agents_update/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete_agents(:any)', 'Home::delete_agents/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'check_agent_id', 'Home::check_agent_id', ['filter' => 'auth']);




//IT 
$routes->match(['get','post'], 'IT_agent/list', 'Home::IT_agent_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'IT/add_agent', 'Home::IT_add_agent', ['filter' => 'auth']);
$routes->match(['get','post'], 'IT/agents_update(:any)', 'Home::IT_agents_update/$1', ['filter' => 'auth']);



//agent files
$routes->match(['get','post'], 'files/VIew_(:any)', 'Home::filesVIew/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'file/Upload', 'Home::fileUpload', ['filter' => 'auth']);
$routes->match(['get','post'], 'deleteFiles_(:any)', 'Home::deleteFile/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'rename/File-(:any)', 'Home::renameFile/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'deleteMultiple/Files', 'Home::deleteMultipleFiles', ['filter' => 'auth']);

//cpu
$routes->match(['get','post'], 'machine', 'Home::machine_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'add_cpu', 'Home::add_cpu', ['filter' => 'auth']);
$routes->match(['get','post'], 'machine/update(:any)', 'Home::update_machine/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete_machine(:any)', 'Home::delete_machine/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'cpu_check_agentID/update', 'Home::cpu_check_agentID', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'cpu_check_equip_id/check', 'Home::cpu_check_equip_id', ['filter' => 'auth']);
//headset
$routes->match(['get','post'], 'headset', 'Home::headset_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'add_headset', 'Home::add_headset', ['filter' => 'auth']);
$routes->match(['get','post'], 'headset/update(:any)', 'Home::update_headset/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'headset/headset_check_agentID', 'Home::headset_check_agentID', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete_headset(:any)', 'Home::delete_headset/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'headset_check_equip_id', 'Home::headset_check_equip_id', ['filter' => 'auth']);
//mouse
$routes->match(['get','post'], 'mouse', 'Home::mouse_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'add_mouse', 'Home::add_mouse', ['filter' => 'auth']);
$routes->match(['get','post'], 'mouse/update(:any)', 'Home::update_mouse/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete/mouse(:any)', 'Home::delete_mouse/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'mouse_check_equip_id/check', 'Home::mouse_check_equip_id', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'mouse_check_agentID', 'Home::mouse_check_agentID', ['filter' => 'auth']);
//keyboard
$routes->match(['get','post'], 'keyboard', 'Home::keyboard_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'add_keyboard', 'Home::add_keyboard', ['filter' => 'auth']);
$routes->match(['get','post'], 'update_keyboard(:any)', 'Home::update_keyboard/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete/keyboard(:any)', 'Home::delete_keyboard/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'keyboard_check_equip_id', 'Home::keyboard_check_equip_id', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'keyboard_check_agentID', 'Home::keyboard_check_agentID', ['filter' => 'auth']);

//monitor
$routes->match(['get','post'], 'monitor', 'Home::monitor_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'add_monitor', 'Home::add_monitor', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'monitor_check_equip_id/check', 'Home::monitor_check_equip_id', ['filter' => 'auth']);
$routes->match(['get','post'], 'update/monitor(:any)', 'Home::updateThemonitors/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'agent_check_equip_id/update', 'Home::agent_check_equip_id', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'agent_check_name/update', 'Home::agent_check_name', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete/monitor(:any)', 'Home::delete_monitor/$1', ['filter' => 'auth']);

//agentmonitor
$routes->match(['get','post'], 'agent_monitor', 'Home::agent_monitor', ['filter' => 'auth']);
$routes->match(['get','post'], 'addagent_monitor', 'Home::addagent_monitor', ['filter' => 'auth']);
$routes->match(['get','post'], 'addagent_monitor_check_agent', 'Home::addagent_monitor_check_agent', ['filter' => 'auth']);
$routes->match(['get','post'], 'addagent_monitor_one_check', 'Home::addagent_monitor_one_check', ['filter' => 'auth']);
$routes->match(['get','post'], 'monitor_agent/update(:any)', 'Home::updates_monitor_agent/$1', ['filter' => 'auth']);

//phone
$routes->match(['get','post'], 'phone/list', 'Home::phone_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'add/phone', 'Home::add_phone', ['filter' => 'auth']);
$routes->match(['get','post'], 'phone/check_equip_id', 'Home::phone_check_equip_id', ['filter' => 'auth']);
$routes->match(['get','post'], 'phone_update/first(:any)', 'Home::update_phone/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'phone_check_agentID/check', 'Home::phone_check_agentID', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete/phone(:any)', 'Home::delete_phone/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'update_phone_one/first(:any)', 'Home::update_phone_one/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'update_phone_two/two(:any)', 'Home::update_phone_two/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'update_phone_three/three(:any)', 'Home::update_phone_three/$1', ['filter' => 'auth']);

//5gsimcard
$routes->match(['get','post'], 'fiveGsimcard/list', 'Home::fiveGsimcard_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'getphone/details', 'Home::getPhoneDataById', ['filter' => 'auth']);
$routes->match(['get','post'], 'add/SGsimcard', 'Home::add_SGsimcard', ['filter' => 'auth']);
$routes->match(['get','post'], 'update/SGsimcard(:any)', 'Home::update_SGsimcard/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete/SGsimcard(:any)', 'Home::delete_SGsimcard/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'getphone/bydetails', 'Home::getPhoneDetails', ['filter' => 'auth']);

//laptop
$routes->match(['get','post'], 'laptop/list', 'Home::laptop_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'add/laptop', 'Home::add_laptop', ['filter' => 'auth']);
$routes->match(['get','post'], 'laptop_check_equip_id/check', 'Home::laptop_check_equip_id', ['filter' => 'auth']);
$routes->match(['get','post'], 'laptop_check_agentID/check', 'Home::laptop_check_agentID', ['filter' => 'auth']);
$routes->match(['get','post'], 'update/laptop(:any)', 'Home::update_laptop/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete/laptop(:any)', 'Home::delete_laptop/$1', ['filter' => 'auth']);
//webcam
$routes->match(['get','post'], 'webcam/list', 'Home::webcam_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'webcam/add', 'Home::add_webcam', ['filter' => 'auth']);
$routes->match(['get','post'], 'webcam_check_equip_id/check', 'Home::webcam_check_equip_id', ['filter' => 'auth']);
$routes->match(['get','post'], 'update/webcam(:any)', 'Home::update_webcam/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'webcam_check_agentID/check', 'Home::webcam_check_agentID', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete/webcam(:any)', 'Home::delete_webcam/$1', ['filter' => 'auth']);
//locker

$routes->match(['get','post'], 'locker/list', 'Home::locker_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'add/locker', 'Home::add_locker', ['filter' => 'auth']);
$routes->match(['get','post'], 'locker_check_equip_id/check', 'Home::locker_check_equip_id', ['filter' => 'auth']);
$routes->match(['get','post'], 'locker_check_agentID/check', 'Home::locker_check_agentID', ['filter' => 'auth']);
$routes->match(['get','post'], 'update/locker(:any)', 'Home::update_locker/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete/locker(:any)', 'Home::delete_locker/$1', ['filter' => 'auth']);

//accountability_model

$routes->match(['get','post'], 'accountability_form', 'Home::accountability_form', ['filter' => 'auth']);
$routes->match(['get','post'], 'get_agent_and_mouse_details', 'Home::get_agent_and_mouse_details', ['filter' => 'auth']);

//===================================================
$routes->match(['get','post'], 'logout', 'Home::logout', ['filter' => 'auth']);
$routes->match(['get','post'], 'reset/password', 'Account::resetpassword', ['filter' => 'noauth']);
$routes->match(['get','post'], 'sendReset/Link', 'Account::sendResetLink', ['filter' => 'noauth']);
$routes->match(['get','post'], 'update/Password', 'Account::updatePassword', ['filter' => 'noauth']);
$routes->match(['get','post'], 'verify/otptoken/', 'Account::token', ['filter' => 'noauth']);
$routes->match(['get','post'], 'verify/otptoken/(:any)', 'Account::token/$1', ['filter' => 'noauth']);


$routes->get('logout', 'Home::logout');


//PAYROLL========================================================================
//PAYROLL========================================================================
//PAYROLL========================================================================
$routes->match(['get','post'], 'payroll/login', 'Payroll_account::payroll_signin', ['filter' => 'noauth']);
$routes->match(['get','post'], 'payroll/agents', 'Payroll::payroll_agents', ['filter' => 'auth']);
$routes->match(['get','post'], 'payrollDelete/agents/(:any)', 'Payroll::payrollDelete_agents/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'payrollAgents/update/(:any)', 'Payroll::payrollAgents_update/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'attendance/employee', 'Payroll::attendance', ['filter' => 'auth']);
$routes->match(['get','post'], 'upload/attendance', 'Payroll::upload_attendance', ['filter' => 'auth']);
$routes->match(['get','post'], 'payroll/view', 'Payroll::payroll_view', ['filter' => 'auth']);
$routes->match(['get','post'], 'calculateTotalSalary', 'Payroll::calculate_total_salary', ['filter' => 'auth']);

$routes->match(['get','post'], 'updateselected/PagIbig', 'Payroll::updatePagIbig', ['filter' => 'auth']);

$routes->match(['get','post'], 'updateselected/DailySalary', 'Payroll::updateDailySalary', ['filter' => 'auth']);
$routes->match(['get','post'], 'update/SSS', 'Payroll::updateSSS', ['filter' => 'auth']);
$routes->match(['get','post'], 'update/philhealth', 'Payroll::update_philhealth', ['filter' => 'auth']);
$routes->match(['get','post'], 'update/houserent', 'Payroll::update_houserent', ['filter' => 'auth']);
$routes->match(['get','post'], 'deleteMultiple/Attendance', 'Payroll::deleteMultipleAttendance', ['filter' => 'auth']);


$routes->match(['get','post'], 'agent/payslips', 'Payroll::agent_payslips', ['filter' => 'auth']);
$routes->match(['get','post'], 'agents/payslips', 'Payroll::get_payslips_data', ['filter' => 'auth']);


$routes->match(['get','post'], 'attendance/calendar/(:any)', 'Payroll::attendance_calendar/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'payslip/list', 'Payroll::payslip_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'payslip/sendMmail', 'Payroll::payslip_sendMail', ['filter' => 'auth']);
$routes->match(['get','post'], 'payslip/AllsendMail', 'Payroll::payslip_AllsendMail', ['filter' => 'auth']);
$routes->match(['get','post'], 'payslip/history', 'Payroll::payslip_history', ['filter' => 'auth']);
$routes->match(['get','post'], 'attendance/delete_(:any)', 'Payroll::attendance_delete/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete_payslip/leave/(:any)', 'Payroll::delete_payslip_leave/$1', ['filter' => 'auth']);
//$routes->match(['get','post'], 'savePayslip/Image', 'Payroll::save_image', ['filter' => 'auth']);
$routes->match(['get','post'], 'save/Dates', 'Payroll::saveDates', ['filter' => 'auth']);
$routes->match(['get','post'], 'fetchLeaveData', 'Payroll::fetchLeaveData', ['filter' => 'auth']);
$routes->match(['get','post'], 'payroll/addagent', 'Payroll::add_agent', ['filter' => 'auth']);

$routes->match(['get','post'], 'download/Template', 'Payroll::downloadTemplate', ['filter' => 'auth']);
$routes->match(['get','post'], 'update/requiredWork', 'Payroll::update_requiredWork', ['filter' => 'auth']);

//resigned agent
$routes->match(['get','post'], 'resigned/update(:any)', 'Payroll::resigned/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'agents/notActive', 'Payroll::payroll_resignedTerminatedAgent_list', ['filter' => 'auth']);
$routes->match(['get','post'], 'exctract/attendance', 'Payroll::extractAttendance', ['filter' => 'auth']);

$routes->match(['get','post'], 'backto/active_(:any)', 'Payroll::bactoActive/$1', ['filter' => 'auth']);


//leave_records
$routes->match(['get','post'], 'leave/View_(:any)', 'Payroll::leaveView/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'add_leave/rows', 'Payroll::add_leave_rows', ['filter' => 'auth']);
$routes->match(['get','post'], 'leave_rows_optional/COunt', 'Payroll::leave_rows_optionalCOunt', ['filter' => 'auth']);
$routes->match(['get','post'], 'delete_leave_(:any)', 'Payroll::delete_leave/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'update/leave_(:any)', 'Payroll::update_leave/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'leave/History(:any)', 'Payroll::leaveHistory/$1', ['filter' => 'auth']);
$routes->match(['get','post'], 'generate/payslip', 'Payroll::generatePayslip', ['filter' => 'auth']);








$routes->match(['get','post'], 'uploadPDF', 'Payroll::generate_payslip', ['filter' => 'auth']);


















/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
