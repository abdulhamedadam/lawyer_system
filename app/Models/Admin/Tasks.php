<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tasks extends Model
{
    use HasFactory;
    protected $table   ='tbl_tasks';
    protected $guarded = [];

    /*************************************************/
    public function save_task_data($request,$id=null)
    {
        $data['ensha_date']       =  $request->ensha_data;
        $data['task_name']        =  $request->task_name;
        $data['esnad_to']         =  $request->esnad_to;
        $data['priority_id_fk']   =  $request->priority;
        $data['start_date']       =  $request->start_date;
        $data['from_date']       =  $request->start_date;
        $data['end_date']         =  $request->end_date;
        $data['to_date']          =  $request->end_date;
        $data['deadline_date']    =  $request->end_date;
        $data['task_details']     =  $request->details;
        $data['from_user_id']     =  auth()->user()->id;
        $data['to_user_id']       =  $request->esnad_to;
        $data['from_agent_id']    =  auth()->user()->id;
        $data['to_agent_id']      =  $request->esnad_to;
        $data['publisher']        =  auth()->user()->id;
        $data['publisher_name']   =  auth()->user()->name;
        if(!empty($id))
        {
        $data['case_id_fk']       =  $id;
        }else{
        $data['case_id_fk']       =  $request->case_id;
        }

        return $data;
    }
    /*****************************************************/
    public function update_task_date($request,$task)
    {
        $params['to_date']              = $request->to_date;
        $params['deadline_date']        = $request->to_date;
        $params['last_mad_user']        = auth()->user()->id;
        $params['last_mad_date']        = Carbon::now()->toDateString();
        $params['last_mad_time']        = Carbon::now()->toTimeString();
        $params['last_mad_notes']       = $request->last_mad_notes;

        return $params;
    }
    /******************************************************/
    public function get_tasks_data($id=null)
    {
        $query = DB::table($this->table)
            ->select($this->table . '.*','t1.title as priority','t3.color as priority_color','t2.name as to_emp')
            ->join('general_settings as t1', 't1.id', '=', $this->table . '.priority_id_fk')
            ->join('general_settings as t3', 't3.id', '=', $this->table . '.priority_id_fk')
            ->join('admins as t2', 't2.id', '=', $this->table . '.esnad_to');
        if (!empty($id)) {
            $query->where($this->table . '.case_id_fk', '=', $id);
        }

        $results = $query->get();

        return $results->toArray();
    }

    /********************************************************/
    public function data_table($date=null,$wared_emp_id=null,$action_ended=null,$sader_emp_id=null,$need_commentnull=null,$all_from_to=null,$end_takeem=null)
    {
        $query = DB::table($this->table)
            ->select($this->table . '.*','t1.title as priority','t3.color as priority_color','t2.name as to_emp_name',
            't4.case_name','t5.name as from_emp_name')
            ->join('general_settings as t1', 't1.id', '=', $this->table . '.priority_id_fk')
            ->join('general_settings as t3', 't3.id', '=', $this->table . '.priority_id_fk')
            ->join('admins as t2', 't2.id', '=', $this->table . '.to_user_id')
            ->join('admins as t5', 't5.id', '=', $this->table . '.from_user_id')
            ->join('tbl_clients_cases as t4', 't4.id', '=', $this->table . '.case_id_fk');


             if(!empty($all_from_to)){

            $query->where($this->table . '.from_user_id', '=', $all_from_to);
            $query->orWhere($this->table . '.to_user_id', '=', $all_from_to);
             }
            if (!empty($date)) {
                $today    = Carbon::now()->toDateString();
                $user_id  = auth()->user()->id;
                $query->where($this->table . '.action_ended', '!=', 'done');
                $query->where($this->table . '.deadline_date', '<', $today);
                if(auth('admin')->user()->role_id_fk != 1){
                       $query ->where($this->table . '.to_user_id', $user_id)->orWhere($this->table . '.from_user_id', $user_id);
                }
            }
            if (!empty($need_comment)) {
                $query->where($this->table . '.current_to_user_id', '=', $need_comment);
                $query->where($this->table . '.comment_seen', '=', 0);

            }

            if (!empty($wared_emp_id)) {
                $query->where($this->table . '.to_user_id', '=', $wared_emp_id);
            }

            if (!empty($sader_emp_id)) {
                $query->where($this->table . '.from_user_id', '=', $sader_emp_id);
            }
            if (!empty($action_ended)) {
                $query->where($this->table . '.action_ended', '=', $action_ended);
            }
            if (!empty($end_takeem)) {
                $query->where($this->table . '.end_takeem', '=', $end_takeem);
            }




        $results = $query->get();

        return $results;
    }
    /******************************************************************/
    public function get_task_by_id($task_id)
    {
        $query = DB::table($this->table)
            ->select($this->table . '.*','t1.title as priority','t3.color as priority_color','t2.name as to_emp_name',
                't4.case_name','t5.name as from_emp_name')
            ->join('general_settings as t1', 't1.id', '=', $this->table . '.priority_id_fk')
            ->join('general_settings as t3', 't3.id', '=', $this->table . '.priority_id_fk')
            ->join('admins as t2', 't2.id', '=', $this->table . '.to_user_id')
            ->join('admins as t5', 't5.id', '=', $this->table . '.from_user_id')
            ->join('tbl_clients_cases as t4', 't4.id', '=', $this->table . '.case_id_fk');
        $query->where($this->table . '.id', '=', $task_id);
        $results = $query->get();

        return $results;
    }

    /*****************************************************************/
    public function estlam_task($request)
    {
        $params['estlam']                = $request->estlam_option;
        $params['action_estlam_date']    = Carbon::now()->toDateString();
        $params['action_estlam_time']    = Carbon::now()->toTimeString();
        $params['action_ended']          = 'doing';
        $params['action_estlam_notes']   = empty($request->notes) ? null : $request->notes;
//        $params['estlam']                = $request->estlam_option;
//        $params['action_estlam_date']    = Carbon::now()->toDateString();
//        $params['action_estlam_time']    = Carbon::now()->toTimeString();
//        $params['action_estlam_emp_id']  = auth()->user()->id;
//        $params['action_ended']          = 'doing';
//        $params['action_estlam_notes']   = empty($request->notes) ? null : $request->notes;
        return $params;

    }
    /*****************************************************************/
    public function get_takeem_data($request)
    {
        $params['end_takeem']               = 'yes';
        $params['amal_elazem']              = $request->do_necessary;
        $params['takeem_gwda']              = $request->accuracy;
        $params['takeem_complet']           = $request->takeem_complet;
        $params['takeem_reason']            = $request->takeem_reason;
      //  $params['takeem_time_work']         = $request->takeem_time_work;
        $params['takeem_date']              = Carbon::now()->toDateString();
        $params['takeem_time']              = Carbon::now()->toTimeString();
        $params['takeem_user']              = auth()->user()->id;
        //dd($params);
        return $params;

    }
    /**************************************************************/
    public function end_task($request,$task)
    {
        $to_date                        = $task->to_date;
        $params['action_ended_date']    = Carbon::now()->toDateString();
        $params['action_ended_time']    = Carbon::now()->toTimeString();
        $params['action_ended_emp_id']  = auth()->user()->id;
        $params['action_ended']         = 'done';
        $params['action_ended_reason']  = empty($request->act_ended_reason) ? null : $request->act_ended_reason;
        $params['action_ended_result']     = empty($request->act_ended_result) ? null : $request->act_ended_result;
        $params['takeem_time_work']         = diffDaysNew(Carbon::now()->toDateString(),$to_date);
        return $params;
    }


    /************************************************************/
    public function save_task_agenda($request,$task_id)
    {
        $data['title']       = $request->start_date;
        $start_date_time     = $request->session_date ;
        $data['start']       = date('Y-m-d H:i:s', strtotime($start_date_time));
        $data['status']      = 'do';
        $data['category']    = 'task';
        $data['related_id']  = $task_id;

        return $data;
    }




}
