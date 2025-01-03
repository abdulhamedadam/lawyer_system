<?php

namespace App\Models;

use App\Models\Admin\Cases;
use App\Models\Admin\Employees;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasesMo7dareen extends Model
{
    use HasFactory;
    protected $table='tbl_cases_mo7dareen';
    protected $guarded=[];


    /*****************************************/
    public function cases()
    {
        return $this->belongsTo(Cases::class,'case_id','id');
    }
    /*****************************************/
    public function employee()
    {
        return $this->belongsTo(Employees::class,'lawyer','id');
    }
}
