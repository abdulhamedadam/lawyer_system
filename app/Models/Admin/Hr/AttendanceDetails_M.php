<?php

namespace App\Models\Admin\Hr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceDetails_M extends Model
{
    use HasFactory;
    protected $table = 'tbl_hr_attendance_details';
    protected $guarded = [];
}
