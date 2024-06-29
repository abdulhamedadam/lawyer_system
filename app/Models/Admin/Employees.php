<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Employees extends Model
{
    use HasFactory;
    protected $table   ='employees';
    protected $guarded = [];


    /****************************************************/
    public function get_employee_data($id=null)
    {

        $query = DB::table('employees')
            ->select(
                'employees.*',
                't1.title as religion',
                't2.title as gender_type',
                't3.title as nationality_name',
                't4.title as mosma_wazefy',
                't5.title as qualifications',
                't6.title as degrees',
                't7.title as governate',
                't8.title as city',
            )
            ->join('general_settings as t1', 't1.id', '=', 'employees.deyana')
            ->join('general_settings as t2', 't2.id', '=', 'employees.gender')
            ->join('general_settings as t3', 't3.id', '=', 'employees.nationality')
            ->join('general_settings as t4', 't4.id', '=', 'employees.mosma_wazefy_code')
            ->join('general_settings as t5', 't5.id', '=', 'employees.employee_qualification')
            ->join('general_settings as t6', 't6.id', '=', 'employees.employee_degree')
            ->join('tbl_areas_setting as t7', 't7.id', '=', 'employees.governate_id_fk')
            ->join('tbl_areas_setting as t8', 't8.id', '=', 'employees.city_id_fk')

            ;

        if (!empty($id)) {
            $query->where('employees.id', '=', $id);
        }

        $data = $query->get();

        return $data;
    }

    /******************************************************/
    public function data_to_insert($request)
    {
        $insert_data['employee'] = $request->employee_name;
        $insert_data['emp_code'] = $request->employee_code;
        $insert_data['card_num'] = $request->national_id;
        $insert_data['nationality'] = $request->nationality_id;
        $insert_data['gender'] = $request->gender;
        $insert_data['birth_date'] = $request->date_of_barth;;
        $insert_data['address'] = $request->address;
        $insert_data['deyana'] = $request->religion;
        $insert_data['material_status'] = $request->marital_status;
      //  $insert_data['mosma_wazfy_n'] = $request->job_title;
        $insert_data['phone'] = $request->phone_number;
        $insert_data['email'] = $request->email;
        $insert_data['whatsapp'] = $request->whats_number;
        $insert_data['governate_id_fk'] = $request->governate_id;
        $insert_data['city_id_fk'] = $request->city_id;
        $insert_data['employee_degree'] = $request->degrees;
        $insert_data['employee_qualification'] = $request->qualifications;
        $insert_data['manager'] = $request->manager;
        $insert_data['start_work_date'] = $request->start_work_date;
        $insert_data['end_contract_date'] = $request->end_contract_date;
        $insert_data['mosma_wazefy_code'] = $request->job_title;
        $insert_data['test_num_month'] = $request->test_num_month;
        $insert_data['end_test_date'] = $request->end_test_date;

        return $insert_data;
    }
}
