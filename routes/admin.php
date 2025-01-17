<?php


use App\Http\Controllers\Admin\ContactController;

use App\Http\Controllers\Admin\Clients;
use App\Http\Controllers\Admin\CaseSettingsController;
use App\Http\Controllers\Admin\Setting\MaindataController;
use App\Http\Controllers\Admin\Users\ProfileController;
use App\Http\Controllers\Admin\Users\UsersController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\CasesController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\GeneralSettingsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Admin\HR\HrSettingsController;
use App\Http\Controllers\Admin\Archive\ArchiveSettings_C;
use App\Http\Controllers\Admin\Archive\Archive_c;
use App\Http\Controllers\Admin\Agenda_C;
use App\Http\Controllers\Admin\Library_C;
use App\Http\Controllers\Admin\OpenAIController;
use App\Http\Controllers\Admin\Daily_Reports_C;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Define routes for the "languages" prefix outside the group
Route::prefix('languages')->group(function () {
    // Your routes for the "languages" prefix
});
Route::get('/pre_home', function () {
    return view('welcome');
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin']
    ],
    function () {


        Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

            Route::get('dashboard', function () {
                return view('dashbord.home');
            })->name('dashboard');


            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

            /*--------------------------------------------------------------------------------------------------------*/
            Route::get('/add_user', [UsersController::class, 'index'])->name('add_users_form');
            Route::post('/add_user', [UsersController::class, 'store'])->name('add_users');
            Route::get('/all_users', [UsersController::class, 'get_all_users'])->name('all_users');
            Route::get('/all_users/{id}', [UsersController::class, 'edit'])->name('user.edit');
            Route::patch('/all_users/{id}', [UsersController::class, 'update'])->name('user_update');
            Route::delete('/all_users/{id}', [UsersController::class, 'destroy'])->name('user_destroy');

            /*-------------------------------------------------------------------------------------*/
            Route::get('/Clients/add_client', [Clients::class, 'add_client'])->name('add_client_form');
            Route::post('/Clients/add_client', [Clients::class, 'save_client'])->name('save_client');

            Route::get('/Clients/edit_client/{id}', [Clients::class, 'show_edit_form'])->name('show_edit_form');
            Route::post('/Clients/update/{id}', [Clients::class, 'update_client'])->name('update_client');
            Route::post('/Clients/save_client_case/{id}', [Clients::class, 'save_client_case'])->name('save_client_case');

            Route::get('/Clients/delete_client/{id}', [Clients::class, 'delete_client'])->name('delete_client');

            Route::get('/Clients/morfqat/{id}', [Clients::class, 'morfqat'])->name('morfqat');
            Route::get('/Clients/relatedCases/{id}', [Clients::class, 'relatedCases'])->name('relatedCases');
            Route::get('/Clients/payments/{id}', [Clients::class, 'payments'])->name('payments');
            Route::post('/Clients/client_add_archive/{id}', [Clients::class, 'client_add_archive'])->name('client_add_archive');

            Route::get('/Clients', [Clients::class, 'index'])->name('clients_data');
            Route::get('/get_ajax_clients', [Clients::class, 'get_ajax_clients'])->name('get_ajax_clients');
            Route::post('/Clients/add_files/{id}', [Clients::class, 'add_files'])->name('add_files');
            Route::get('/Clients/delete_file/{id}', [Clients::class, 'delete_file'])->name('delete_file');
            Route::get('/read_file/{id}', [Clients::class, 'read_file'])->name('read_file');
            Route::get('/download_file/{id}/{file?}', [Clients::class, 'download_file'])->name('download_file');


            //  Route::get('/download_file/{id}/{file?}', [Clients::class, 'download_file'])->name('download_file');
            Route::get('/Clients/notes/{id}', [Clients::class, 'notes'])->name('notes');
            Route::post('/Clients/add_notes/{id}', [Clients::class, 'add_notes'])->name('add_notes');
            Route::get('/Clients/delete_client_notes/{id}', [Clients::class, 'delete_client_notes'])->name('delete_client_notes');


            Route::get('/Cases', [CasesController::class, 'index'])->name('cases_data');
            Route::get('/Cases/get_ajex_notes', [CasesController::class, 'get_ajex_notes'])->name('get_ajex_notes');
            Route::get('/Cases/add_case', [CasesController::class, 'add_case'])->name('add_case');
            Route::post('/Cases/save_case', [CasesController::class, 'save_case'])->name('save_case');
            Route::post('/Cases/update_case/{id}', [CasesController::class, 'update_case'])->name('update_case');
            Route::get('/Cases/edit_case/{id}', [CasesController::class, 'edit_case'])->name('edit_case');
            Route::get('/Cases/delete_case/{id}', [CasesController::class, 'delete_case'])->name('delete_case');
            Route::get('/Cases/morfqat/{id}', [CasesController::class, 'morfqat'])->name('case_morfqat');
            Route::post('/Cases/case_add_archive/{id}', [CasesController::class, 'case_add_archive'])->name('case_add_archive');

            Route::post('/Cases/add_files/{id}', [CasesController::class, 'case_add_files'])->name('case_add_files');
            Route::get('/Cases/delete_file/{id}', [CasesController::class, 'delete_file'])->name('case_delete_file');
            Route::get('/Cases/read_file/{id}', [CasesController::class, 'read_file'])->name('case_read_file');
            Route::get('/Cases/download_file/{id}/{file?}', [CasesController::class, 'download_file'])->name('case_download_file');


            Route::get('/Cases/payments/{id}', [CasesController::class, 'payments'])->name('case_payments');
            Route::post('/Cases/add_payments/{id}', [CasesController::class, 'add_payments'])->name('case_add_payments');
            Route::get('/Cases/edit_payments/{id}', [CasesController::class, 'edit_payments'])->name('case_edit_payments');
            Route::post('/Cases/update_payments/{id}', [CasesController::class, 'update_payments'])->name('case_update_payments');
            Route::post('/Cases/delete_payments/{id}', [CasesController::class, 'delete_payments'])->name('case_delete_payments');

            Route::get('/Cases/tasks/{id}', [CasesController::class, 'tasks'])->name('case_tasks');
            Route::post('/Cases/add_tasks/{id}', [CasesController::class, 'add_tasks'])->name('case_add_tasks');
            Route::get('/Cases/edit_tasks/{id}', [CasesController::class, 'edit_tasks'])->name('case_edit_tasks');
            Route::post('/Cases/update_tasks/{id}', [CasesController::class, 'update_tasks'])->name('case_update_tasks');
            Route::post('/Cases/delete_tasks/{id}', [CasesController::class, 'delete_tasks'])->name('case_delete_tasks');
            Route::get('/Cases/sessions/{id}', [CasesController::class, 'sessions'])->name('case_sessions');
            Route::post('/Cases/add_session/{id}', [CasesController::class, 'add_session'])->name('case_add_session');
            Route::get('/Cases/edit_session/{id}', [CasesController::class, 'edit_session'])->name('case_edit_session');
            Route::post('/Cases/update_session/{id}', [CasesController::class, 'update_session'])->name('case_update_session');
            Route::get('/Cases/delete_session/{id}', [CasesController::class, 'delete_session'])->name('case_delete_session');
            Route::get('/Cases/session_results/{id}', [CasesController::class, 'session_results'])->name('case_session_results');
            Route::post('/Cases/update_session_results/{id}', [CasesController::class, 'update_session_results'])->name('case_update_session_results');

            Route::get('/Cases/case_status/{id}', [CasesController::class, 'case_status'])->name('case_status');
            Route::post('/Cases/add_case_status/{id}', [CasesController::class, 'add_case_status'])->name('add_case_status');
            Route::get('/Cases/edit_case_status/{id}', [CasesController::class, 'edit_case_status'])->name('edit_case_status');
            Route::post('/Cases/update_case_status/{id}', [CasesController::class, 'update_case_status'])->name('update_case_status');
            Route::get('/Cases/delete_case_status/{id}', [CasesController::class, 'delete_case_status'])->name('delete_case_status');

            Route::get('/Cases/mo7dareen/{id}', [CasesController::class, 'mo7dareen'])->name('case_mo7dareen');
            Route::post('/Cases/add_mo7dareen/{id}', [CasesController::class, 'add_mo7dareen'])->name('add_mo7dareen');
            Route::get('/Cases/case_edit_mo7dareen/{id}', [CasesController::class, 'case_edit_mo7dareen'])->name('case_edit_mo7dareen');
            Route::post('/Cases/update_mo7dareen/{id}', [CasesController::class, 'update_mo7dareen'])->name('case_update_mo7dareen');
            Route::get('/Cases/delete_mo7dareen/{id}', [CasesController::class, 'delete_mo7dareen'])->name('delete_mo7dareen');

            Route::get('/Cases/kafalate/{id}', [CasesController::class, 'kafalate'])->name('case_kafalate');
            Route::post('/Cases/add_kafalate/{id}', [CasesController::class, 'add_kafalate'])->name('add_kafalate');
            Route::get('/Cases/edit_kafalate/{id}', [CasesController::class, 'edit_kafalate'])->name('edit_kafalate');
            Route::post('/Cases/update_kafalate/{id}', [CasesController::class, 'update_kafalate'])->name('update_kafalate');
            Route::get('/Cases/delete_kafalate/{id}', [CasesController::class, 'delete_kafalate'])->name('delete_kafalate');

            Route::get('/Cases/tanfiz_a7kam/{id}', [CasesController::class, 'tanfiz_a7kam'])->name('case_tanfiz_a7kam');
            Route::post('/Cases/add_tanfiz_a7kam/{id}', [CasesController::class, 'add_tanfiz_a7kam'])->name('add_tanfiz_a7kam');
            Route::get('/Cases/edit_tanfiz_a7kam/{id}', [CasesController::class, 'edit_tanfiz_a7kam'])->name('edit_tanfiz_a7kam');
            Route::post('/Cases/update_tanfiz_a7kam/{id}', [CasesController::class, 'update_tanfiz_a7kam'])->name('update_tanfiz_a7kam');
            Route::get('/Cases/delete_tanfiz_a7kam/{id}', [CasesController::class, 'delete_tanfiz_a7kam'])->name('delete_tanfiz_a7kam');

            Route::get('/Cases/experts/{id}', [CasesController::class, 'experts'])->name('case_experts');
            Route::post('/Cases/add_experts/{id}', [CasesController::class, 'add_expert'])->name('add_expert');
            Route::get('/Cases/edit_experts/{id}', [CasesController::class, 'edit_expert'])->name('edit_expert');
            Route::post('/Cases/update_experts/{id}', [CasesController::class, 'update_expert'])->name('update_expert');
            Route::get('/Cases/delete_experts/{id}', [CasesController::class, 'delete_expert'])->name('delete_expert');


            Route::get('/Tasks', [TaskController::class, 'index'])->name('tasks');
            Route::post('/Tasks/add_task', [TaskController::class, 'add_task'])->name('add_task');
            Route::get('/Tasks/delete_task/{id}', [TaskController::class, 'delete_task'])->name('delete_task');
            Route::get('/Tasks/edit_task/{id}', [TaskController::class, 'edit_task'])->name('edit_task');
            Route::post('/Tasks/update_task/{id}', [TaskController::class, 'update_task'])->name('update_task');
            Route::get('/Tasks/All', [TaskController::class, 'all_tasks'])->name('all_task_data');
            Route::get('/Tasks/get_ajex_all_tasks', [TaskController::class, 'get_ajex_all_tasks'])->name('get_ajex_all_tasks');

            Route::get('/Tasks/wared', [TaskController::class, 'wared_tasks'])->name('wared_data');
            Route::get('/Tasks/sader', [TaskController::class, 'sader_tasks'])->name('sader_tasks');
            Route::get('/Tasks/doing', [TaskController::class, 'doing_tasks'])->name('doing_tasks');
            Route::get('/Tasks/done', [TaskController::class, 'done_tasks'])->name('done_tasks');
            Route::get('/Tasks/delayed', [TaskController::class, 'delayed_tasks'])->name('delayed_tasks');
            Route::get('/Tasks/cancelled', [TaskController::class, 'cancelled_tasks'])->name('cancelled_tasks');
            Route::get('/Tasks/evaluate', [TaskController::class, 'evaluate_tasks'])->name('evaluate_tasks');
            Route::get('/Tasks/needReply', [TaskController::class, 'needReply_tasks'])->name('needReply_tasks');
            Route::get('/Tasks/get_ajex_wared_tasks', [TaskController::class, 'get_ajex_wared_tasks'])->name('get_ajex_wared_tasks');
            Route::get('/Tasks/get_ajex_sader_tasks', [TaskController::class, 'get_ajex_sader_tasks'])->name('get_ajex_sader_tasks');
            Route::get('/Tasks/get_ajex_doing_tasks', [TaskController::class, 'get_ajex_doing_tasks'])->name('get_ajex_doing_tasks');
            Route::get('/Tasks/get_ajex_done_tasks', [TaskController::class, 'get_ajex_done_tasks'])->name('get_ajex_done_tasks');
            Route::get('/Tasks/get_ajex_delayed_tasks', [TaskController::class, 'get_ajex_delayed_tasks'])->name('get_ajex_delayed_tasks');
            Route::get('/Tasks/get_ajex_cancelled_tasks', [TaskController::class, 'get_ajex_cancelled_tasks'])->name('get_ajex_cancelled_tasks');
            Route::get('/Tasks/get_ajex_evaluate_tasks', [TaskController::class, 'get_ajex_evaluate_tasks'])->name('get_ajex_evaluate_tasks');
            Route::get('/Tasks/get_ajex_needReply_tasks', [TaskController::class, 'get_ajex_needReply_tasks'])->name('get_ajex_needReply_tasks');
            Route::get('/Tasks/estlam_task/{id}', [TaskController::class, 'estlam_task'])->name('estlam_task');
            Route::post('/Tasks/save_estlam_task/{id}', [TaskController::class, 'save_estlam_task'])->name('save_estlam_task');
            Route::get('/Tasks/takeem_task/{id}', [TaskController::class, 'takeem_task'])->name('takeem_task');
            Route::post('/Tasks/save_takeem_task/{id}', [TaskController::class, 'save_takeem_task'])->name('save_takeem_task');
            Route::get('/Tasks/details/{id}', [TaskController::class, 'details'])->name('task_details');
            Route::post('/Tasks/comment/{id}', [TaskController::class, 'add_task_comment'])->name('add_task_comment');
            Route::post('/Tasks/extend_task_date/{id}', [TaskController::class, 'extend_task_date'])->name('extend_task_date');
            Route::post('/Tasks/update_task_comment/{comment_id}/{task_id}', [TaskController::class, 'update_task_comment'])->name('update_task_comment');
            Route::get('/Tasks/delete_task_comment/{comment_id}/{task_id}', [TaskController::class, 'delete_task_comment'])->name('delete_task_comment');
            Route::get('/Tasks/end_task/{id}', [TaskController::class, 'end_task'])->name('end_task');
            Route::post('/Tasks/save_end_task/{id}', [TaskController::class, 'save_end_task'])->name('save_end_task');

            Route::get('/Case_Setting/{type}', [CaseSettingsController::class, 'case_settings'])->name('case_settings');
            Route::get('/get_ajax_case_settings/{type}', [CaseSettingsController::class, 'get_ajax_case_settings'])->name('get_ajax_case_settings');
            Route::post('/add_case_setting/{type}', [CaseSettingsController::class, 'add_case_setting'])->name('add_case_setting');
            Route::get('/delete_case_setting/{id}', [CaseSettingsController::class, 'delete_case_setting'])->name('delete_case_setting');
            Route::get('/edit_case_setting/{id}', [CaseSettingsController::class, 'edit_case_setting'])->name('edit_case_setting');

            Route::get('/general_settings/{type}', [GeneralSettingsController::class, 'general_settings'])->name('general_settings');
            Route::get('/get_ajax_general_settings/{type}', [GeneralSettingsController::class, 'get_ajax_general_settings'])->name('get_ajax_general_settings');
            Route::post('/add_general_settings/{type}', [GeneralSettingsController::class, 'add_general_settings'])->name('add_general_settings');
            Route::get('/delete_general_settings/{id}', [GeneralSettingsController::class, 'delete_general_settings'])->name('delete_general_settings');
            Route::get('/edit_general_settings/{id}', [GeneralSettingsController::class, 'edit_general_settings'])->name('edit_general_settings');
            Route::get('/show_setting', [GeneralSettingsController::class, 'show_setting'])->name('show_setting');
            Route::post('/add_popup_setting', [GeneralSettingsController::class, 'add_popup_setting'])->name('add_popup_setting');
            Route::get('/get_popup_settings', [GeneralSettingsController::class, 'get_popup_settings'])->name('get_popup_settings');
            Route::post('/update_popup_setting', [GeneralSettingsController::class, 'update_popup_setting'])->name('update_popup_setting');
            Route::post('/delete_popup_setting', [GeneralSettingsController::class, 'delete_popup_setting'])->name('delete_popup_setting');

            /*************************************************************************************/
            Route::get('/Assets/types', [\App\Http\Controllers\Admin\assets\AssetsTypeController::class, 'index'])->name('assets_type');
            Route::post('/Assets/types', [\App\Http\Controllers\Admin\assets\AssetsTypeController::class, 'add_assets_type'])->name('add_assets_type');
            Route::get('/Assets/types/edit/{id}', [\App\Http\Controllers\Admin\assets\AssetsTypeController::class, 'edit'])->name('edit_assets_type');
            Route::post('/Assets/types/delete/{id}', [\App\Http\Controllers\Admin\assets\AssetsTypeController::class, 'delete'])->name('delete_assets_type');

            Route::resource('Assets', \App\Http\Controllers\Admin\assets\AssetsController::class);
            /*************************************************************************************/
            Route::resource('Suppliers', \App\Http\Controllers\Admin\SupplierController::class);
            Route::resource('Tawkelate', \App\Http\Controllers\Admin\TawkelateController::class);
            Route::get('get_client_tawkel/{id}', [\App\Http\Controllers\Admin\TawkelateController::class, 'get_client_tawkel'])->name('get_client_tawkel');






            Route::get('/Employees', [EmployeesController::class, 'index'])->name('employee_data');
            Route::get('/get_ajax_employee', [EmployeesController::class, 'get_ajax_employee'])->name('get_ajax_employee');
            Route::get('/add_employee', [EmployeesController::class, 'add_employee'])->name('add_employee');
            Route::get('/edit_employee/{id}', [EmployeesController::class, 'edit_employee'])->name('edit_employee');
            Route::post('/update_employee/{id}', [EmployeesController::class, 'update_employee'])->name('update_employee');
            Route::post('/save_employee', [EmployeesController::class, 'save_employee'])->name('save_employee');
            Route::get('/employee_files/{id}', [EmployeesController::class, 'employee_files'])->name('employee_files');
            Route::get('/employee_details/{id}', [EmployeesController::class, 'employee_details'])->name('employee_details');
            Route::post('/employee_add_files/{id}', [EmployeesController::class, 'employee_add_files'])->name('employee_add_files');
            Route::get('/Roles', [RoleController::class, 'roles_data'])->name('roles_data');
            Route::get('/get_ajex_roles', [RoleController::class, 'get_ajex_roles'])->name('get_ajex_roles');
            Route::post('/Roles/add_role', [RoleController::class, 'add_role'])->name('add_role');
            Route::get('/Roles/edit_role/{id}', [RoleController::class, 'edit_role'])->name('edit_role');
            Route::get('/Roles/delete_role/{id}', [RoleController::class, 'delete_role'])->name('delete_role');

            Route::get('/Roles', [RoleController::class, 'roles_data'])->name('roles_data');
            Route::get('/get_ajex_roles', [RoleController::class, 'get_ajex_roles'])->name('get_ajex_roles');
            Route::post('/Roles/add_role', [RoleController::class, 'add_role'])->name('add_role');
            Route::get('/Roles/edit_role/{id}', [RoleController::class, 'edit_role'])->name('edit_role');
            Route::get('/Roles/delete_role/{id}', [RoleController::class, 'delete_role'])->name('delete_role');
            Route::get('/Roles/role_permissions/{id}', [RoleController::class, 'role_permissions'])->name('role_permissions');
            Route::post('/Roles/role_permissions/{id}', [RoleController::class, 'add_role_permissions'])->name('add_role_permissions');


            Route::get('/HumanResource/hr_settings/{type}', [HrSettingsController::class, 'general_settings'])->name('hr_settings');
            Route::get('/HumanResource/get_ajax_hr_settings/{type}', [HrSettingsController::class, 'get_ajax_hr_settings'])->name('get_ajax_hr_settings');
            Route::get('/HumanResource/delete_hr_settings/{id}', [HrSettingsController::class, 'delete_hr_settings'])->name('delete_hr_settings');
            Route::get('/HumanResource/edit_hr_settings/{id}', [HrSettingsController::class, 'edit_hr_settings'])->name('edit_hr_settings');
            Route::post('/HumanResource/add_hr_settings/{type}', [HrSettingsController::class, 'add_hr_settings'])->name('add_hr_settings');


            // Route::resource('users',UsersController::class);
            Route::get('users/users_data', [UserController::class, 'user_data'])->name('user_data');
            Route::get('users/get_ajax_users', [UserController::class, 'get_ajax_users'])->name('get_ajax_users');
            Route::get('users/add_user', [UserController::class, 'add_user'])->name('add_user');
            Route::post('users/save_user', [UserController::class, 'save_user'])->name('save_user');
            Route::get('users/delete_user/{id}', [UserController::class, 'delete_user'])->name('delete_user');
            Route::get('users/edit_user/{id}', [UserController::class, 'edit_user'])->name('edit_user');
            Route::post('users/update_user/{id}', [UserController::class, 'update_user'])->name('update_user');
            Route::get('users/change_status/{id}/{status}', [UserController::class, 'change_status'])->name('change_status');

            Route::controller(ArchiveSettings_C::class)->group(function () {
                Route::get('/archive_settings/{type}', 'archive_settings')->name('archive_settings');
                Route::get('/archive_shelf_settings/{type}', 'archive_shelf_settings')->name('archive_shelf_settings');
                Route::get('/get_ajax_archive_settings/{type}', 'get_ajax_archive_settings')->name('get_ajax_archive_settings');
                Route::get('/get_ajax_archive_shelf_settings', 'get_ajax_archive_shelf_settings')->name('get_ajax_archive_shelf_settings');
                Route::post('/add_archive_settings/{type}', 'add_archive_settings')->name('add_archive_settings');
                Route::post('/add_archive_shelf_settings', 'add_archive_shelf_settings')->name('add_archive_shelf_settings');
                Route::get('/delete_archive_settings/{id}', 'delete_archive_settings')->name('delete_archive_settings');
                Route::get('/edit_archive_settings/{id}', 'edit_archive_settings')->name('edit_archive_settings');
            });

            Route::controller(Archive_c::class)->group(function () {
                Route::get('/Archive/add_archive', 'add_archive')->name('add_archive');
                Route::get('/Archive/get_shelf/{id}', 'get_shelf')->name('get_shelf');
                Route::get('/Archive/get_related_data/{id}', 'get_related_data')->name('get_related_data');
                Route::get('/Archive/archive_data', 'archive_data')->name('archive_data');
                Route::get('/Archive/get_ajax_archive', 'get_ajax_archive')->name('get_ajax_archive');
                Route::post('/Archive/save_archive', 'save_archive')->name('save_archive');
                Route::get('/Archive/edit_archive/{id}', 'edit_archive')->name('edit_archive');
                Route::post('/Archive/update_archive/{id}', 'update_archive')->name('update_archive');
                Route::get('/Archive/delete_archive/{id}', 'delete_archive')->name('delete_archive');
                Route::get('/Archive/archive_files/{id}', 'archive_files')->name('archive_files');
                Route::post('/Archive/add_archive_files/{id}', 'add_archive_files')->name('add_archive_files');
                Route::get('/Archive/read_file/{id}', 'read_file')->name('archive_read_file');
                Route::get('/Archive/delete_file/{id}', 'delete_file')->name('archive_delete_file');
                Route::get('/Archive/download_file/{id}/{file?}', 'download_file')->name('archive_download_file');
            });
            Route::controller(Agenda_C::class)->group(function () {
                Route::get('/Agenda', 'agenda_data')->name('agenda_data');
                Route::post('/Agenda/save_agenda', 'save_agenda')->name('save_agenda');
                Route::get('/Agenda/delete_event/{id}', 'delete_event')->name('delete_event');
                Route::post('/Agenda/edit_event/{id}', 'edit_event')->name('edit_event');
            });

            Route::controller(Library_C::class)->group(function () {
                Route::get('/Library/{fe2a_id?}', 'library_data')->name('library_data');
                Route::get('/get_ajax_books/{fe2a_id?}', 'get_ajax_books')->name('get_ajax_books');
                Route::get('/add_book', 'add_book')->name('add_book');
                Route::post('/save_book', 'save_book')->name('save_book');
                Route::get('/edit_book/{id}', 'edit_book')->name('edit_book');
                Route::get('/view-pdf/{path}', 'viewPDF')->where('path', '(.*)')->name('view_pdf');
                Route::post('/update_seen/{id}', 'update_seen')->name('update_seen');
                Route::get('/delete_book/{id}', 'delete_book')->name('delete_book');
            });
            Route::controller(Daily_Reports_C::class)->group(function () {
                Route::get('/daily_reports_data', 'daily_reports_data')->name('daily_reports_data');
                Route::get('/get_ajax_reports', 'get_ajax_reports')->name('get_ajax_reports');
                Route::get('/add_report', 'add_report')->name('add_report');
                Route::post('/save_report', 'save_report')->name('save_report');
                Route::get('/delete_report/{id}', 'delete_report')->name('delete_report');
                Route::get('/edit_report/{id}', 'edit_report')->name('edit_report');
                Route::post('/update_report/{id}', 'update_report')->name('update_report');
                Route::get('/get_details/{id}', 'get_details')->name('get_details');
            });

            Route::controller(\App\Http\Controllers\Admin\ContractForms_C::class)->group(function () {
                Route::get('/Contract_forms/add', 'add_contract_form')->name('add_contract_form');
                Route::get('/Contract_forms/edit/{id}', 'edit_contract_form')->name('edit_contract_form');
                Route::post('/Contract_forms/update_contract/{id}', 'update_contract')->name('update_contract');
                Route::post('/Contract_forms/save_contract', 'save_contract')->name('save_contract');
                Route::post('/Contract_forms/delete_contract/{id}', 'save_contract')->name('delete_contract');
                Route::get('/Contract_forms/{id?}', 'contract_forms_data')->name('contract_forms_data');
                Route::get('/Contract_forms/get_contract_body/{id}', 'get_contract_body')->name('get_contract_body');
                Route::post('/generate_pdf', 'generate_pdf')->name('generate_pdf');
            });
            Route::controller(\App\Http\Controllers\Admin\MainDash::class)->group(function () {
                Route::get('/Dashboard', 'main_dash')->name('main_dash');
            });

            Route::controller(\App\Http\Controllers\Admin\Masrofat_C::class)->group(function () {
                Route::get('/add_masrofat', 'add_masrofat')->name('add_masrofat');
                Route::post('/Masrofate/save', 'save_masrofat')->name('save_masrofat');
                Route::get('/Masrofate/data', 'masrofat_data')->name('masrofat_data');
                Route::get('/Masrofate/ajax_data', 'ajax_data')->name('ajax_data');
                Route::get('/Masrofate/edit/{id}', 'edit_masrofat')->name('edit_masrofat');
                Route::post('/Masrofate/update/{id}', 'update_masrofat')->name('update_masrofat');
                Route::post('/Masrofate/delete/{id}', 'delete_masrofat')->name('delete_masrofat');
            });


            Route::controller(\App\Http\Controllers\Admin\CaseSessions_C::class)->group(function () {
                Route::get('/Case/sessions', 'sessions')->name('sessions');
                Route::get('/Case/get_ajax', 'get_ajax')->name('get_ajax_session');
                Route::get('/Case/add_session', 'add_session')->name('add_session');
                Route::post('/Case/save_session', 'save_session')->name('save_session');
                Route::get('/Case/edit_session/{id}', 'edit_session')->name('edit_session');
                Route::post('/Case/update_session/{id}', 'update_session')->name('update_session');
                Route::post('/Case/delete_session/{id}', 'delete_session')->name('delete_session');
                Route::get('/Case/session_results/{id}', 'session_results')->name('session_results');
                Route::post('/Case/update_session_results/{id}', 'update_session_results')->name('update_session_results');
            });

            Route::controller(\App\Http\Controllers\Admin\HR\HumanResource_C::class)->group(function () {
                Route::get('/HumanResource/add_attendance/{id?}', 'add_attendance')->name('add_attendance');
                Route::get('/HumanResource/attendance', 'attendance')->name('attendance');
                Route::get('/HumanResource/get_ajax_attendance', 'get_ajax_attendance')->name('get_ajax_attendance');
                Route::post('/HumanResource/save_attendance', 'save_attendance')->name('save_attendance');
            });

            Route::controller(\App\Http\Controllers\admin\LegalServicesController::class)->group(function () {
                Route::get('/legal_services_data', 'index')->name('index_legal_services');
                Route::get('/create_legal_services', 'create')->name('create_legal_services');
                Route::post('/store_legal_services', 'store')->name('store_legal_services');
                Route::get('/data_legal_services', 'get_ajax_lagal_services')->name('data_legal_services');
                Route::get('/edit_legal_services/{id}', 'edit')->name('edit_legal_services');
                Route::post('/update_legal_services/{id}', 'update')->name('update_legal_services');
                Route::delete('/delete_legal_services/{id}', 'delete')->name('delete_legal_services');
                Route::get('/legal_service_morfqat/{id}', 'morfqat')->name('legal_service_morfqat');
                Route::get('/legal_service_payments/{id}', 'payments')->name('legal_service_payments');
            });



            Route::post('/ask_ai', [ChatGPTController::class, 'ask'])->name('ask_ai');
            Route::post('/train-ai', [\App\Http\Controllers\AITrainingController::class, 'train'])->name('train.ai');
            Route::get('/ai-training-history', [\App\Http\Controllers\AITrainingController::class, 'trainingHistory'])->name('ai.training.history');

            Route::get('/chat', function () {
            return view('dashbord.admin.openAi.chat');
        });
            Route::post('/openai/generate-text', [OpenAIController::class, 'generateText'])->name('generateText');

            /************************** MAINDATA *****************************/
            Route::resource('mdata', MaindataController::class);
            /************************** Contact Us *****************************/
            Route::resource('contact', ContactController::class);
            Route::get('contact/delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');

            Route::get('/get_city/{id}', [Clients::class, 'get_city_list'])->name('get_city');


            //        Route::post('/get_quarter', [MainController::class, 'get_quarter_list'])->name('get_quarter');
            //        Route::post('/get_emara', [MainController::class, 'get_emara'])->name('get_emara');




            Route::get('/download_file/{file}/{file_name}', function ($file, $file_name) {
                $filePath = storage_path('app/files/' . $file);
                // Sanitize the filename
                $sanitizedFilename = str_replace(['/', '\\'], '_', $file_name);
                $headers = [
                    'Content-Type' => 'application/octet-stream',
                    'Content-Disposition' => 'attachment; filename="' . $sanitizedFilename . '"',
                ];
                return response()->download($filePath, $sanitizedFilename, $headers);
            })->where('file', '(.*)')->name('download_file2');
        });
    }
);
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        require __DIR__ . '/adminauth.php';
    }
);
Route::group(['middleware' => ['auth:admin']], function () {
    Route::resource('roles', 'RoleController');
});
