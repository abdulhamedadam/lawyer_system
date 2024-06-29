<?php


namespace App\Http\Controllers;


use App\Models\settings\State;
use App\Traits\MainFunction;
use Illuminate\Http\Request;

class MainController extends Controller
{
use MainFunction;

    function get_emara(Request $request)
    {
        $data = State::where(['country_id_fk' => $request->country_id, 'is_deleted' => 0])->get()->toArray();
        /*        return json_encode(array('data' => get_city($request->emara_id)));*/
        return json_encode(array('data' => $data));

    }

    function get_city_list(Request $request)
    {
        $data = $this->get_city($request);
        return json_encode(array('data' => $data));

    }

    function get_quarter_list(Request $request)
    {

        $data = $this->get_quarter($request);
        return json_encode(array('data' => $data));
    }
}
