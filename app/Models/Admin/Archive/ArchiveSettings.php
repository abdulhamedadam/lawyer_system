<?php

namespace App\Models\Admin\Archive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArchiveSettings extends Model
{
    use HasFactory;
    protected $table='tbl_archive_settings';
    protected $guarded = [];

    public function add_setting_data($request,$type)
    {
        $data['title']  =$request->setting_name;
//        $data['color']  =$request->color;
        $data['from_id'] =0;
        $data['ttype']  =$type;

        return $data;
    }
    /*********************************************/
    public function add_shelf_setting_data($request)
    {
        $data['title']  =$request->shelf_name;
//        $data['color']  =null;
        $data['from_id'] =$request->desk_name;
        $data['ttype']  ='shelf';

        return $data;
    }

    /************************************************/
    public function get_archive_shelf_data()
    {
        $data = DB::table('tbl_archive_settings AS a')
            ->select('a.*', 'b.title AS disk_name')
            ->join('tbl_archive_settings AS b', 'a.from_id', '=', 'b.id')
            ->where('a.ttype', '=', 'shelf')
            ->get();

        return $data;
    }
}
