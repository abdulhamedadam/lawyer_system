<?php

namespace App\Models;

use App\Http\Requests\Admin\Cases\CaseSettings;
use App\Models\Admin\Cases;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseTanfizA7kam extends Model
{
    use HasFactory;

    protected $table='tbl_case_tanfiz_a7kam';
    protected $guarded=[];

    /*****************************************/
    public function cases()
    {
        return $this->belongsTo(Cases::class,'case_id','id');
    }

    public function court()
    {
        return $this->belongsTo(CaseSettings::class);
    }

}
