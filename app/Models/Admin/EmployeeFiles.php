<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFiles extends Model
{
    use HasFactory;
    protected $table   ='employees_files';
    protected $fillable = [
        'emp_id_fk','file_name','file','publisher','publisher_n'
    ];



}
