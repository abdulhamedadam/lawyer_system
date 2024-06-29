<?php

namespace App\Models\Admin\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HumanResource_M extends Model
{
    use HasFactory;
    protected $table = 'tbl_hr_attendance';
    protected $guarded = [];
}
