<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasePayments extends Model
{
    use HasFactory;
    protected $table   ='tbl_case_payments';
    protected $fillable = [
        'case_id_fk','client_id_fk','paid_date','paid_time','pay_method_fk','person_name','notes','person_phone','notes','paid_value','month','year'
    ];



    /********************************************************/
    public function add_case_payment($request,$case)
    {
        $data['paid_date']    = $request->paid_date;
        $data['paid_value']   = $request->paid_value;
        $data['person_name']  = $request->person_name;
        $data['person_phone'] = $request->person_phone;
        $data['notes']        = $request->notes;
        $data['year']         = Carbon::now()->year;
        $data['month']        = Carbon::now()->month;
        $data['paid_time']    = Carbon::now()->toTimeString();
        $data['case_id_fk']   = $case->id ;
        $data['client_id_fk'] = $case->client_id_fk ;
        $data['publisher']    = auth('admin')->user()->id;
        $data['publisher_n']  = auth('admin')->user()->name;


        return $data;
    }
    /*************************************************************/
    public function update_case_payment($request)
    {
        $data['paid_date']    = $request->paid_date;
        $data['paid_value']   = $request->paid_value;
        $data['person_name']  = $request->person_name;
        $data['person_phone'] = $request->person_phone;
        $data['notes']        = $request->notes;
        $data['paid_time']    = Carbon::now()->toTimeString();
        $data['publisher']    = auth('admin')->user()->id;
        $data['publisher_n']  = auth('admin')->user()->name;

        return $data;
    }

}
