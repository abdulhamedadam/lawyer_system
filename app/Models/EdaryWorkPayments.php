<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EdaryWorkPayments extends Model
{
    use HasFactory;

    protected $table   ='tbl_edary_work_payments';
    protected $fillable = [
        'edary_work_id','client_id','paid_date','person_name','notes','person_phone','paid_value', 'created_by', 'updated_by'
    ];



    /********************************************************/
    public function add_edary_work_payment($request, $edary_work)
    {
        $data['paid_date']    = $request->paid_date;
        $data['paid_value']    = $request->paid_value;
        $data['person_name']  = $request->person_name;
        $data['person_phone'] = $request->person_phone;
        $data['notes']        = $request->notes;
        $data['edary_work_id']   = $edary_work->id ;
        $data['client_id']       = $edary_work->client_id ;
        $data['created_by']    = auth('admin')->user()->id;
        return $data;
    }
    /*************************************************************/
    public function update_edary_work_payment($request)
    {
        $data['paid_date']    = $request->paid_date;
        $data['paid_value']   = $request->paid_value;
        $data['person_name']  = $request->person_name;
        $data['person_phone'] = $request->person_phone;
        $data['notes']        = $request->notes;
        $data['updated_by']    = auth('admin')->user()->id;

        return $data;
    }
}
