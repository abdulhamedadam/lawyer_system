<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Models\Admin\CaseSettings;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use App\Http\Requests\Admin\Cases\CaseSettings as CaseSettingsRequest;
use Illuminate\Http\Request;
use DataTables;

class CaseSettingsController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /*---------------------------------------------------*/

    protected $CaseSettingsRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->CaseSettingsRepository = createRepository($basicRepository, new CaseSettings());

    }

    /*****************************************************/
    public function case_settings($type = null)
    {
        $data['type'] = $type;
        return view('dashbord.admin.cases.settings.main_settings', $data);
    }

    /*****************************************************/
    public function get_ajax_case_settings($type)
    {
        if (request()->ajax()) {
            $data = $this->CaseSettingsRepository->getByWhere(['ttype' => $type], 'id', 'desc');


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
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="'.route('admin.delete_case_setting',$row->id).'"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>';
                })
                ->rawColumns(['action','color'])
                ->make(true);
            return $dataTable->toJson();
        }
    }

    /*****************************************************/
    public function add_case_setting(CaseSettingsRequest $request, $type)
    {
       // dd($request);
        try {
            $case_setting_Model = new CaseSettings();
            $data = $case_setting_Model->add_setting_data($request, $type);
            if(empty($request->row_id))
            {
             $this->CaseSettingsRepository->create($data);

            }else{
                $this->CaseSettingsRepository->update($request->row_id,$data);
            }
            notify()->success(translate('case_setting_successfully'), '');
            return redirect()->route('admin.case_settings',$type);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /*****************************************************/
    public function delete_case_setting(Request $request,$id)
    {
        try {
            $setting = $this->CaseSettingsRepository->getById($id);
            $this->CaseSettingsRepository->delete($id);
            notify()->success(translate('case_setting_deleted_successfully'), '');
            return redirect()->route('admin.case_settings',$setting->ttype);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /****************************************************/
    public function edit_case_setting($id)
    {
        $data['all_data']=$this->CaseSettingsRepository->getById($id);
        return response()->json($data);
    }


}

