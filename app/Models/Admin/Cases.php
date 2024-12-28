<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cases extends Model
{
    use HasFactory;
    protected $table   ='tbl_clients_cases';
    protected $fillable = [
        'client_id_fk','case_name','case_num','case_type_fk','court_id_fk','fees','start_date','end_date','case_status','notes'
    ];


    public function get_next_case_num()
    {
        $lastCase = Cases::orderByDesc('case_num')->first();
        $nextCaseNum = $lastCase ? $lastCase->case_num + 1 : 1;
        return $nextCaseNum;
    }




    /********************************************/
    public function get_clients_cases($id=null)
    {
        $query = DB::table($this->table)
            ->select($this->table . '.*','t1.title as case_type','t2.title as court','t3.title as case_status','t4.color as case_status_color')
            ->join('tbl_cases_settings as t1', 't1.id', '=', $this->table . '.case_type_fk')
            ->join('tbl_cases_settings as t2', 't2.id', '=', $this->table . '.court_id_fk')
            ->join('tbl_cases_settings as t3', 't3.id', '=', $this->table . '.case_status')
            ->join('tbl_cases_settings as t4', 't4.id', '=', $this->table . '.case_status');


        if (!empty($id)) {
            $query->where($this->table . '.id', '=', $id);
        }

        $results = $query->get();
        return $results->toArray();
    }
    /********************************************/
    public function all_client_cases($client_id=null)
    {
        $query = DB::table($this->table)
            ->select($this->table . '.*','t1.title as case_type','t2.title as court','t3.title as case_status','t4.color as case_status_color')
            ->join('tbl_cases_settings as t1', 't1.id', '=', $this->table . '.case_type_fk')
            ->join('tbl_cases_settings as t2', 't2.id', '=', $this->table . '.court_id_fk')
            ->join('tbl_cases_settings as t3', 't3.id', '=', $this->table . '.case_status')
            ->join('tbl_cases_settings as t4', 't4.id', '=', $this->table . '.case_status');


        if (!empty($client_id)) {
            $query->where($this->table . '.client_id_fk', '=', $client_id);
        }

        $results = $query->get();
        return $results->toArray();
    }


    /***********************************************/
    public function get_data_table_data($id = null)
    {
        $query = DB::table('tbl_clients_cases')
            ->select(
                'tbl_clients_cases.*',
                't5.name as client_name',
                't6.phone_number',
                't1.title as case_type',
                't2.title as court',
                't3.title as case_status',
                't4.color as case_status_color' // Add this line
            )
            ->join('tbl_cases_settings as t1', 't1.id', '=', 'tbl_clients_cases.case_type_fk')
            ->join('tbl_cases_settings as t2', 't2.id', '=', 'tbl_clients_cases.court_id_fk')
            ->join('tbl_cases_settings as t3', 't3.id', '=', 'tbl_clients_cases.case_status')
            ->join('tbl_cases_settings as t4', 't4.id', '=', 'tbl_clients_cases.case_status')
            ->join('tbl_clients as t5', 't5.id', '=', 'tbl_clients_cases.client_id_fk')
            ->join('tbl_clients as t6', 't6.id', '=', 'tbl_clients_cases.client_id_fk')
            ->leftJoin('tbl_case_payments', 'tbl_case_payments.case_id_fk', '=', 'tbl_clients_cases.id'); // Add this line

        if (!empty($id)) {
            $query->where('tbl_clients_cases.id', '=', $id);
        }

      
        $query->orderBy('tbl_clients_cases.id', 'desc'); // Sort by case id in descending order

        $data = $query->get();

        return $data;
    }



    /*******************************************/
    public function insert_data($request)
    {
        $data['client_id_fk']   = $request->client_id;
        $data['case_name']      = $request->case_title;
        $data['case_num']       = $request->case_num;
        $data['case_type_fk']   = $request->case_type;
        $data['court_id_fk']    = $request->court_id;
        $data['fees']           = $request->fees;
        $data['start_date']     = $request->start_date;
        $data['case_status']    = $request->case_status;
        $data['notes']          = $request->notes;

        //dd($data);

        return $data;

    }

    /************************************************************/


}
