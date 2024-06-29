<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientNotes extends Model
{
    use HasFactory;
    protected $table   ='tbl_client_notes';
    protected $fillable = [
        'client_id_fk','notes','publisher','publisher_n'
    ];
    /****************************************************************/
    public function add_notes($request,$id)
    {
        $data['notes']           = $request->notes;
        $data['client_id_fk']    = $id;
        $data['publisher']       = auth('admin')->user()->id;
        $data['publisher_n']     = auth('admin')->user()->name;

        return $data;
    }
}
