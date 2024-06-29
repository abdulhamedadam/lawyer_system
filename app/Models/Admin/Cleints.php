<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cleints extends Model
{
    use HasFactory;
    protected $table   ='tbl_clients';
    protected $fillable = [
        'name', 'nationality_id', 'national_id', 'date_of_birth_st', 'date_of_birth_ar',
        'place_of_birth', 'current_address', 'phone_number', 'whats_number',
        'gender', 'work_place', 'personal_image', 'governate_id', 'city_id',
        'region', 'status', 'marital_status', 'job_title', 'date_st', 'date_ar', 'time_ar','religion'
    ];

    /********************************************************/
    public function get_client_data($id)
    {
        return DB::table($this->table)
            ->select($this->table . '.*', 't1.title as job','t2.title as nationality','t3.title as religion','t4.title as governate','t5.title as city')
            ->join('general_settings as t1', 't1.id', '=', $this->table . '.job_title')
            ->join('general_settings as t2', 't2.id', '=', $this->table . '.nationality_id')
            ->join('general_settings as t3', 't3.id', '=', $this->table . '.religion')
            ->join('tbl_areas_setting as t4', 't4.id', '=', $this->table . '.governate_id')
            ->join('tbl_areas_setting as t5', 't5.id', '=', $this->table . '.city_id')
            ->where($this->table . '.id', '=', $id)
            ->first();
    }
    /******************************************************/
    public function get_data_table()
    {
        $query = DB::table('tbl_clients')
            ->select('tbl_clients.*', 't1.title as job', DB::raw('COUNT(tbl_clients_cases.id) as case_count'))
            ->join('general_settings as t1', 't1.id', '=', 'tbl_clients.job_title')
            ->leftJoin('tbl_clients_cases', 'tbl_clients.id', '=', 'tbl_clients_cases.client_id_fk')
            ->groupBy('tbl_clients.id')
            ->get();
        return $query;
    }

}
