<?php


namespace App\Services;


use App\Models\Admin\Dues;
use Carbon\Carbon;

class DuesService
{
    /*************************************************/
    public function SaveDues($type,$value,$id,$client_id)
    {
        $dues=new Dues();
        //dd($type);
       $data['date']            = Carbon::now()->day;
       $data['month']           = Carbon::now()->month;
       $data['year']            = Carbon::now()->year;
       $data['value']           = $value;
       $data['type']            = $type;
       $data['type_related_id'] = $id;
       $data['client_id']       = $client_id;
      // dd($data);
        Dues::create($data);
    }
    /*************************************************/
    public function updateDues($type,$value,$id,$client_id)
    {
        $data['date']            = Carbon::now()->day;
        $data['month']           = Carbon::now()->month;
        $data['year']            = Carbon::now()->year;
        $data['value']           = $value;
        $data['type']            = $type;
        $data['type_related_id'] = $id;
        $data['client_id']       = $client_id;
        Dues::where('type_related_id',$id)->where('type',$type)->update($data);
    }

    /**************************************************/
    public function DeleteDues($type,$id)
    {
        Dues::where('type_related_id',$id)->where('type',$type)->delete();
    }

}
