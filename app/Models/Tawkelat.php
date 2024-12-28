<?php

namespace App\Models;

use App\Models\Admin\CaseSettings;
use App\Models\Admin\Cleints;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tawkelat extends Model
{
    use HasFactory;
    protected $table='tbl_tawkelat';
    protected $guarded=[];


    /***************************************/
    public function Client()
    {
        return $this->belongsTo(Cleints::class,'client_id','id');
    }

    /***************************************/
    public function TawkelType()
    {
        return $this->belongsTo(CaseSettings::class,'tawkel_type','id');
    }
    /***************************************/

}
