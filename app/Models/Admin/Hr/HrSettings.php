<?php

namespace App\Models\Admin\Hr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrSettings extends Model
{
    use HasFactory;
    protected $table   ='hr_general_settings';
    protected $guarded = [];
    /******************************************************/
    public function add_setting_data($request,$type)
    {
        $data['title']= $request->setting_name;
        $data['details']= $request->details;
        $data['ttype']= $type;
        return $data;
    }
}
