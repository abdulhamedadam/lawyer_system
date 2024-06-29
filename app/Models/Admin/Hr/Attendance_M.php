<?php

namespace App\Models\Admin\Hr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance_M extends Model
{
    use HasFactory;
    protected $table = 'tbl_hr_attendance';
    protected $guarded = [];


    /****************************************/
    public function add_data($request)
    {
        $data['attendance_date']= $request->attendance_date;
        $data['month']          = date('m');
        $data['year']           = date('Y');
        $data['publisher_id']   = auth('admin')->user()->id;
        $data['publisher_name'] = auth('admin')->user()->name;

        return $data;
    }
}
