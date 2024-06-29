<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CaseSessions_M extends Model
{
    use HasFactory;
    protected $table = 'tbl_cases_sessions';
    protected $guarded = [];

    /*******************************************************/
    public function save_case_session($request)
    {
        $data['session_title']              = $request->session_title;
        $data['court_id']                   = $request->court_id;
        $data['case_id']                    = $request->case_id;
        $data['session_judge']              = $request->session_judge;
        $data['emp_id']                     = $request->esnad_to;
        $data['session_date']               = $request->session_date;
        $data['session_time']               = $request->session_time;
        $data['session_requirements']       = $request->session_requirements;
        $data['session_notes']            = $request->session_notes;

        return $data;
    }

    /****************************************************/
    public function save_case_session_agenda($request,$session_id)
    {
        $data['title']       = $request->session_title;
        $data['description'] = $request->session_notes;
        $start_date_time     = $request->session_date . ' ' . $request->session_time;
        $data['start']       = date('Y-m-d H:i:s', strtotime($start_date_time));
        $data['status']      = 'do';
        $data['category']    = 'session';
        $data['related_id']  = $session_id;

        return $data;
    }
    /***************************************************/
    public function get_sessions($case_id = null)
    {
        $sessions = DB::table('tbl_cases_sessions')
            ->leftJoin('tbl_clients_cases', 'tbl_cases_sessions.case_id', '=', 'tbl_clients_cases.id')
            ->leftJoin('tbl_cases_settings', 'tbl_cases_sessions.court_id', '=', 'tbl_cases_settings.id')
            ->leftJoin('employees', 'tbl_cases_sessions.emp_id', '=', 'employees.id')
            ->select(
                'tbl_cases_sessions.*',
                'tbl_clients_cases.case_name',
                'tbl_cases_settings.title as court_name',
                'employees.employee as employee_name'
            );
        if ($case_id !== null) {
            $sessions->where('tbl_cases_sessions.case_id', $case_id);
        }
        $sessionsData = $sessions->get();

        return $sessionsData;
    }

    /************************************************/
    public function get_sessions_by_id($session_id)
    {
        $session = DB::table('tbl_cases_sessions')
            ->leftJoin('tbl_clients_cases', 'tbl_cases_sessions.case_id', '=', 'tbl_clients_cases.id')
            ->leftJoin('tbl_cases_settings', 'tbl_cases_sessions.court_id', '=', 'tbl_cases_settings.id')
            ->leftJoin('employees', 'tbl_cases_sessions.emp_id', '=', 'employees.id')
            ->select(
                'tbl_cases_sessions.*',
                'tbl_clients_cases.case_name',
                'tbl_cases_settings.title as court_name',
                'employees.employee as employee_name'
            )
            ->where('tbl_cases_sessions.id', $session_id) ;

    $sessionData = $session->first();

    return $sessionData;
}





}
