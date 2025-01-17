<?php

namespace App\Models;

use App\Models\Admin\Employees;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EdaryWorkAgra2at extends Model
{
    use HasFactory;

    protected $table   ='tbl_edary_work_agra2at';
    protected $guarded = [];

    public function add_edary_work_agra2($request, $edary_work)
    {
        $data['agra2_num']    = $request->agra2_num;
        $data['year']    = $request->year;
        $data['agra2_date']  = $request->agra2_date;
        $data['agra2_take_place'] = $request->agra2_take_place;
        $data['lawyer_id']        = $request->lawyer_id;
        $data['edary_work_id']   = $edary_work->id ;
        $data['alagra2']       = $request->alagra2 ;
        $data['created_by']    = auth('admin')->user()->id;
        return $data;
    }
    /*************************************************************/
    public function update_edary_work_agra2($request)
    {
        $data['agra2_num']    = $request->agra2_num;
        $data['year']    = $request->year;
        $data['agra2_date']  = $request->agra2_date;
        $data['agra2_take_place'] = $request->agra2_take_place;
        $data['lawyer_id']        = $request->lawyer_id;
        $data['alagra2']       = $request->alagra2 ;
        $data['created_by']    = auth('admin')->user()->id;

        return $data;
    }

    public function employee()
    {
        return $this->belongsTo(Employees::class,'lawyer_id','id');
    }
}
