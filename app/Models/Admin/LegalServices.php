<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LegalServices extends Model
{
    use HasFactory;
    protected $table   ='tbl_legal_services';
    protected $fillable = [
        'client_name', 'type_of_service', 'esnad_to', 'cost_of_service', 'notes',
        'legal_services_file', 'date_st', 'date_ar', 'time_ar'
    ];

    /**************************************************/
    public function add_service_data($request)
    {
        $insert_data['client_name'] = $request->client_name;
        $insert_data['type_of_service'] = $request->type_of_service;
        $insert_data['esnad_to'] = $request->esnad_to;
        $insert_data['cost_of_service'] = $request->cost_of_service;
        $insert_data['notes'] = $request->notes;

        return $insert_data;
    }


}
