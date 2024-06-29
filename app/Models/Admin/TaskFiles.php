<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskFiles extends Model
{
    use HasFactory;
    protected $table   ='tbl_tasks_files';
    protected $guarded = [];
}
