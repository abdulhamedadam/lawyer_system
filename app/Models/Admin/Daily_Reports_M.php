<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Daily_Reports_M extends Model
{
    use HasFactory;
    protected $table = 'tbl_daily_reports';
    protected $guarded = [];



    /*****************************************/
    public function save_report_data($request)
    {
        $employee = Employees::find($request->to_emp_id);
       $data['related_to_case']=$request->related_to_case;
       $data['case_id']=$request->case_id;
       $data['details']=$request->details;
       $data['from_emp_id']=auth('admin')->user()->id;
       $data['from_emp_name']=auth('admin')->user()->name;
       $data['to_emp_id']=$request->to_emp_id;
       $data['to_emp_name']=$employee->employee;
       $data['publisher_id']=auth('admin')->user()->id;
       $data['publisher_name']=auth('admin')->user()->name;

       return $data;
    }

    /****************************************/


    public function getAll()
    {
        $reports = DB::table('tbl_daily_reports')
            ->select('tbl_daily_reports.*', 'tbl_clients_cases.case_name')
            ->LeftJoin('tbl_clients_cases', 'tbl_daily_reports.case_id', '=', 'tbl_clients_cases.id')
            ->get();

        return $reports;
    }

}
