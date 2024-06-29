<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractForms_M extends Model
{
    use HasFactory;
    protected $table = 'tbl_contract_forms';
    protected $guarded = [];


    /***************************************/
    public function save_contract_data($request)
    {
        $data['contract_name']=$request->contract_name;
        $data['contract_body']=$request->contract_body;
        $data['publisher_id']=auth('admin')->user()->id;
        $data['publisher_name']=auth('admin')->user()->name;

        return $data;
    }
}
