<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Agenda_M;
use Illuminate\Http\Request;

class MainDash extends Controller
{
    public function main_dash()
    {
        $agenda_m=new Agenda_M();
        $data['all_agenda']=Agenda_M::all();
        $data['all_data'] =Agenda_M::all();
        //dd($data['all_agenda']);

        return view('dashbord.admin.dash.main_dash',$data);
    }
}
