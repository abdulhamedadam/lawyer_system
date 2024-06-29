<?php

namespace App\Models\Admin\Archive;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Achive_m extends Model
{
    use HasFactory;

    protected $table = 'tbl_archive';
    protected $guarded = [];


    /***********************************************/
    public function save_archive($request)
    {
        $data['type_id'] = $request->type_id;
        $data['related_folder'] = $request->related_folder;
        $data['related_entity_id'] = $request->related_entity_id;
        $data['secret_degree'] = $request->secret_degree;
        $data['desk_id'] = $request->desk_id;
        $data['shelf_id'] = $request->shelf_id;
        $data['folder_code'] = $request->folder_code;
        $data['year'] = Carbon::now()->year;
        $data['month'] = Carbon::now()->month;
        $data['publisher_id'] = auth('admin')->user()->id;
        $data['publisher_name'] = auth('admin')->user()->name;
        // dd($data);
        return $data;
    }

    /**************************************************/
    public function save_archive_files($archive, $file)
    {

        $data['archive_id'] = $archive->id;
        $data['folder_code'] = $archive->folder_code;
        $data['file_name'] = $file->file_name;
        $data['file'] = $file->file;
        // dd($data);
        return $data;
    }

    /**************************************************/
    public function get_data_table($id = null)
    {
        $query = DB::table('tbl_archive')
            ->select('tbl_archive.*', 't1.title as archive_type', 't2.case_name', 't3.employee', 't4.name as client_name', 't5.title as secret_degree_name', 't6.color as secret_color', 't7.title as desk', 't8.title as shelf')
            ->leftJoin('tbl_archive_settings as t1', 't1.id', '=', 'tbl_archive.type_id')
            ->leftJoin('tbl_clients_cases as t2', 't2.id', '=', 'tbl_archive.related_entity_id')
            ->leftJoin('employees as t3', 't3.id', '=', 'tbl_archive.related_entity_id')
            ->leftJoin('tbl_clients as t4', 't4.id', '=', 'tbl_archive.related_entity_id')
            ->leftJoin('tbl_archive_settings as t5', 't5.id', '=', 'tbl_archive.secret_degree')
            ->leftJoin('tbl_archive_settings as t6', 't6.id', '=', 'tbl_archive.secret_degree')
            ->leftJoin('tbl_archive_settings as t7', 't7.id', '=', 'tbl_archive.desk_id')
            ->leftJoin('tbl_archive_settings as t8', 't8.id', '=', 'tbl_archive.shelf_id');

        if (!is_null($id)) {
            $query->where('tbl_archive.id', '=', 1);
        }


        $query->orderBy('tbl_archive.id', 'desc');

        // Execute the query and fetch the results
        $results = $query->get();

        return $results;
    }
    /********************************************************/
    public function get_archive_data($id,$type)
    {
        $query = DB::table('tbl_archive')
            ->select('tbl_archive.*', 't1.title as archive_type', 't2.case_name', 't3.employee', 't4.name as client_name', 't5.title as secret_degree_name', 't6.color as secret_color', 't7.title as desk', 't8.title as shelf')
            ->leftJoin('tbl_archive_settings as t1', 't1.id', '=', 'tbl_archive.type_id')
            ->leftJoin('tbl_clients_cases as t2', 't2.id', '=', 'tbl_archive.related_entity_id')
            ->leftJoin('employees as t3', 't3.id', '=', 'tbl_archive.related_entity_id')
            ->leftJoin('tbl_clients as t4', 't4.id', '=', 'tbl_archive.related_entity_id')
            ->leftJoin('tbl_archive_settings as t5', 't5.id', '=', 'tbl_archive.secret_degree')
            ->leftJoin('tbl_archive_settings as t6', 't6.id', '=', 'tbl_archive.secret_degree')
            ->leftJoin('tbl_archive_settings as t7', 't7.id', '=', 'tbl_archive.desk_id')
            ->leftJoin('tbl_archive_settings as t8', 't8.id', '=', 'tbl_archive.shelf_id');

            $query->where('tbl_archive.related_entity_id', '=', $id);
            $query->where('tbl_archive.related_folder', '=', $type);



        $query->orderBy('tbl_archive.id', 'desc');

        // Execute the query and fetch the results
        $results = $query->get();

        return $results;
    }

    /***************************************/
    public function save_case_archive($request,$case_id)
    {
        $data['type_id'] = $request->type_id;
        $data['related_folder'] = 1;
        $data['related_entity_id'] = $case_id;
        $data['secret_degree'] = $request->secret_degree;
        $data['desk_id'] = $request->desk_id;
        $data['shelf_id'] = $request->shelf_id;
        $data['folder_code'] = $request->folder_code;
        $data['year'] = Carbon::now()->year;
        $data['month'] = Carbon::now()->month;
        $data['publisher_id'] = auth('admin')->user()->id;
        $data['publisher_name'] = auth('admin')->user()->name;

        return $data;
    }

}
