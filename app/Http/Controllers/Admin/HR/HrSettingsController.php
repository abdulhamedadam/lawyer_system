<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Hr\StoreSettingsRequests;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Hr\HrSettings;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;
class HrSettingsController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $HrSettingsRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->HrSettingsRepository = createRepository($basicRepository, new HrSettings());
    }
    /************************************************************/
    public function general_settings($type=null)
    {
        $data['type'] = $type;
        return view('dashbord.admin.Hr.hr_settings.hr_settings_data', $data);
    }
    /***********************************************************/
    public function get_ajax_hr_settings($type)
    {
        if (request()->ajax()) {
            $data = $this->HrSettingsRepository->getByWhere(['ttype' => $type], 'id', 'desc');
            $counter = 0;
            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('name', function ($row) {
                    return $row->title;
                })->addColumn('details', function ($row) {
                    return  $row->details ;
                }) ->addColumn('action', function ($row) {
                    return '<a data-bs-toggle="modal" data-bs-target="#modalsettings" onclick="edit_setting('.$row->id.')" class="btn btn-sm btn-warning" title="">
                            <i class="bi bi-pencil"></i>'.translate('edit').'
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="'.route('admin.delete_hr_settings',$row->id).'"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i> '.translate('delete').'
                        </a>';
                })
                ->rawColumns(['action','details'])
                ->make(true);
            return $dataTable->toJson();
        }
    }

    /***********************************************************/

    public function add_hr_settings (StoreSettingsRequests $request, $type)
    {
        // dd($request);
        try {
            $hr_setting_Model = new HrSettings();
            $data = $hr_setting_Model->add_setting_data($request, $type);
            if(empty($request->row_id))
            {
                $this->HrSettingsRepository->create($data);

            }else{
                $this->HrSettingsRepository->update($request->row_id,$data);
            }
            notify()->success(translate('hr_setting_added_successfully'), '');
            return redirect()->route('admin.hr_settings',$type);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /*****************************************************/
    public function delete_hr_settings(Request $request,$id)
    {
        try {
            $setting = $this->HrSettingsRepository->getById($id);
            $this->HrSettingsRepository->delete($id);
            notify()->success(translate('hr_setting_deleted_successfully'), '');
            return redirect()->route('admin.hr_settings',$setting->ttype);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /****************************************************/
    public function edit_hr_settings($id)
    {
        $data['all_data']=$this->HrSettingsRepository->getById($id);
        return response()->json($data);
    }
}
