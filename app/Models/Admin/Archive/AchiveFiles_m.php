<?php

namespace App\Models\Admin\Archive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchiveFiles_m extends Model
{
    use HasFactory;
    protected $table='tbl_archive_files';
    protected $guarded = [];


    /****************************************/
    public function archive()
    {
        return $this->belongsTo(Achive_m::class);
    }
}
