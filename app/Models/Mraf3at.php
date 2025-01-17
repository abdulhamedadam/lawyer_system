<?php

namespace App\Models;

use App\Models\Admin\Cases;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mraf3at extends Model
{
    use HasFactory;

    protected $table='tbl_mraf3at';
    protected $guarded=[];

    public function cases()
    {
        return $this->belongsTo(Cases::class,'case_id','id');
    }

}
