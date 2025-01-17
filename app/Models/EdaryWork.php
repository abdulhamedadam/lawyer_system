<?php

namespace App\Models;

use App\Models\Admin\CaseSettings;
use App\Models\Admin\Cleints;
use App\Models\Admin\Employees;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EdaryWork extends Model
{
    use HasFactory;

    protected $table='tbl_edary_works';
    protected $guarded=[];



    public function employee()
    {
        return $this->belongsTo(Employees::class,'esnad_to_id','id');
    }

    public function client()
    {
        return $this->belongsTo(Cleints::class,'client_id','id');
    }

    public function tawkelat()
    {
        return $this->belongsTo(Tawkelat::class,'tawkel_id','id');
    }

    public function edaryType()
    {
        return $this->belongsTo(CaseSettings::class,'edary_work_type','id');
    }

}
