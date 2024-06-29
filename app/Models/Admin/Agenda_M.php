<?php

namespace App\Models\Admin;

use Flasher\Laravel\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda_M extends Model
{
    use HasFactory;
    protected $table = 'tbl_agenda';
    protected $guarded = [];


    /**********************************************/
    public function save_agenda_data($request)
    {
        $data['title']=$request->title;
        $data['description']=$request->description;
        $data['start']=$request->start;
        $data['end']=$request->end;
        $data['status']='do';

        return $data;
    }

    /*********************************************/
    public function update_agenda_data($request)
    {
        $data['title']=$request->title;
        $data['description']=$request->description;
        $data['start']=$request->start;
        $data['end']=$request->end;
        $data['status']=$request->status;

        return $data;
    }
}
