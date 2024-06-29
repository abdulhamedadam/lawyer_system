<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleintsFile extends Model
{
    use HasFactory;
    protected $table   ='tbl_clients_files';
    protected $fillable = [
        'client_id_fk','file_name','file','publisher','publisher_n'
    ];
}
