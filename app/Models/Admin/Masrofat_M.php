<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Masrofat_M extends Model
{
    use HasFactory;
    protected $table = 'tbl_masrofat';
    protected $guarded = [];


    /*********************************************/
    public function save_masrofat_data($request)
    {
         $data['related_to_case']=$request->related_to_case;
         $data['case_id']=$request->case_id;
         $data['emp_id']=$request->to_emp_id;
         $data['band_id']=$request->band_id;
         $data['value']=$request->value;
         $data['notes']=$request->notes;
        $data['year']         = Carbon::now()->year;
        $data['month']        = Carbon::now()->month;
        $data['sarf_date']    = Carbon::now()->day;
         $data['publisher_id']=auth('admin')->user()->id;
         $data['publisher_name']=auth('admin')->user()->name;

         return $data;
    }

    /*************************************************/
    public function getAll()
    {
        $reports = DB::table('tbl_masrofat')
            ->select('tbl_masrofat.*', 'tbl_cases_settings.title as band_name','employees.employee as cashier','tbl_clients_cases.case_name')
            ->LeftJoin('tbl_cases_settings', 'tbl_masrofat.band_id', '=', 'tbl_cases_settings.id')
            ->LeftJoin('tbl_clients_cases', 'tbl_masrofat.case_id', '=', 'tbl_clients_cases.id')
            ->LeftJoin('employees', 'tbl_masrofat.emp_id', '=', 'employees.id')
            ->get();

        return $reports;
    }

}
