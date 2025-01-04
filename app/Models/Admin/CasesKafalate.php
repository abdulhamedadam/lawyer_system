<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasesKafalate extends Model
{
    use HasFactory;
    protected $table='tbl_cases_kafalate';
    protected $guarded=[];

    /**********************************************/
    public function cases()
    {
        return $this->belongsTo(Cases::class,'case_id','id');
    }
    /**********************************************/
}
