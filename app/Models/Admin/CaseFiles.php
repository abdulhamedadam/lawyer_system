<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseFiles extends Model
{
    use HasFactory;
    protected $table   ='tbl_cases_files';
    protected $fillable = [
        'case_id_fk','file_name','file','publisher','publisher_n'
    ];
}
