<?php

namespace App\Models;

use App\Models\Admin\Cases;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\Employees;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStatus extends Model
{
    use HasFactory;

    protected $table='tbl_case_status';
    protected $guarded=[];

    public function cases()
    {
        return $this->belongsTo(Cases::class,'case_id','id');
    }

    public function case_status()
    {
        return $this->belongsTo(CaseSettings::class, 'case_status_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employees::class,'lawyer_id','id');
    }
}
