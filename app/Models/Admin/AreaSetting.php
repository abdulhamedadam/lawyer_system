<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaSetting extends Model
{
    use HasFactory;
    protected $table   ='tbl_areas_setting';
    protected $fillable = [
        'title','from_id'
    ];
}
