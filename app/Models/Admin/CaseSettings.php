<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseSettings extends Model
{
    use HasFactory;
    protected $table='tbl_cases_settings';
    protected $fillable=[
        'title','ttype','from_id','color'
    ];


    /***********************************************************/
    public function add_setting_data($request,$type)
    {
        $data['title']  =$request->setting_name;
//        $data['color']  =$request->color;
        $data['ttype']  =$type;

        return $data;
    }
    /**********************************************************/

}
