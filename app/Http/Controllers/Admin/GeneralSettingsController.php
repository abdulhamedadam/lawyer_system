<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\GeneralSettingsRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\GeneralSetting;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;
class GeneralSettingsController extends Controller
{

    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $GeneralSettingsRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->GeneralSettingsRepository = createRepository($basicRepository, new GeneralSetting());

    }
    /***********************************************************/

    public function general_settings($type=null)
    {
        $data['type'] = $type;
        return view('dashbord.admin.settings.general_settings', $data);
    }
    /***********************************************************/
    public function get_ajax_general_settings($type)
    {
        if (request()->ajax()) {
            $data = $this->GeneralSettingsRepository->getByWhere(['ttype' => $type], 'id', 'desc');


            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('name', function ($row) {
                    return $row->title;
                })
                ->addColumn('action', function ($row) {
                    return '<a data-bs-toggle="modal" data-bs-target="#modalsettings" onclick="edit_setting('.$row->id.')" class="btn btn-sm btn-warning" title="">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="'.route('admin.delete_general_settings',$row->id).'"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>';
                })
                ->rawColumns(['action','color'])
                ->make(true);
            return $dataTable->toJson();
        }
    }

    /*****************************************************/
    public function add_general_settings(GeneralSettingsRequest $request, $type)
    {
        // dd($request);
        try {
            $general_setting_Model = new GeneralSetting();
            $data = $general_setting_Model->add_setting_data($request, $type);
            if(empty($request->row_id))
            {
                $this->GeneralSettingsRepository->create($data);

            }else{
                $this->GeneralSettingsRepository->update($request->row_id,$data);
            }
            notify()->success(translate('case_setting_successfully'), '');
            return redirect()->route('admin.general_settings',$type);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /*****************************************************/
    public function delete_general_settings(Request $request,$id)
    {
        try {
            $setting = $this->GeneralSettingsRepository->getById($id);
            $this->GeneralSettingsRepository->delete($id);
            notify()->success(translate('general_setting_deleted_successfully'), '');
            return redirect()->route('admin.general_settings',$setting->ttype);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /****************************************************/
    public function edit_general_settings($id)
    {
        $data['all_data']=$this->GeneralSettingsRepository->getById($id);
        return response()->json($data);
    }


    /**************************************************/
    public function show_setting(Request $request)
    {
        $data['type']=$request->type;
        $data['input_id']=$request->input_id;
        $data['all_data'] = GeneralSetting::where('ttype', $data['type'])->orderBy('id', 'desc')->get();

        return view('dashbord.admin.settings.show_popup_setting',$data);

    }
    /*************************************************/
    public function add_popup_setting(Request $request)
    {
        $data['title']=$request->title;
        $data['ttype']=$request->type;
        $settings= GeneralSetting::create($data);
        return response()->json($settings);

    }

    /***************************************************/
    public function get_popup_settings(Request  $request)
    {
        $type = $request->input('type');
        $settings = GeneralSetting::where('type', $type)->get();
        return response()->json($settings);
    }

    /*************************************************/
    public function update_popup_setting(Request $request)
    {
        $data['title'] = $request->title;
        $data['type'] = $request->type;
        $data['id'] = $request->id;

        $setting = GeneralSetting::find($data['id']);
        $setting->update($data);

        $settings = GeneralSetting::where('ttype',$data['type'])->get();

        return response()->json(['settings' => $settings, 'message' => 'Setting updated successfully!']);
    }

    /************************************************/
    public function delete_popup_setting(Request $request)
    {
        $data['id'] = $request->id;
        $data['type'] = $request->type;
        GeneralSetting::where('id', $data['id'])->delete();
        $settings = GeneralSetting::where('ttype',$data['type'])->get();
        return response()->json(['settings' => $settings, 'message' => 'Setting deleted successfully!']);
    }





}
