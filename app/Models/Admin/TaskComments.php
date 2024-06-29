<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaskComments extends Model
{
    use HasFactory;
    protected $table   ='tbl_tasks_comments';
    protected $guarded = [];


    /*************************************************/
    public function get_insert_data($request,$task=null)
    {
        $data['task_id_fk']  = $task->id;
        $data['comment']     = $request->comment;
        $data['from_user_id']     = auth()->user()->id;
        if(auth()->user()->id == $task->from_user_id)
        {
            $data['to_user_id'] =$task->to_user_id;
        }elseif (auth()->user()->id == $task->from_user_id){
            $data['to_user_id'] =$task->from_user_id;
        }
        return $data;
    }
    /***********************************************/
    public function get_update_data($request,$task=null)
    {
        $data['comment']     = $request->comment;
        return $data;
    }
    /*********************************************/
    public function get_task_details_comments($id=null)
    {
        $query = DB::table($this->table)
            ->select($this->table . '.*','t1.name as from_user_name','t2.image as personal_photo')
            ->join('admins as t1', 't1.id', '=', $this->table . '.from_user_id')
            ->join('admins as t2', 't2.id', '=', $this->table . '.from_user_id');
        if (!empty($id)) {
        $query->where($this->table . '.task_id_fk', '=', $id);
            }
        $results = $query->get();

        return $results;
    }
}
