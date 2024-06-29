<?php

namespace App\Http\Controllers\Admin\Archive;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Archive\ArchiveShelfSetting_R;
use App\Http\Requests\Admin\Setting\GeneralSettingsRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Archive\ArchiveSettings;
use App\Models\Admin\GeneralSetting;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;
class ArchiveSettings_C extends Controller
{

    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $ArchiveStructureRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->ArchiveStructureRepository = createRepository($basicRepository, new ArchiveSettings());

    }
    /***********************************************************/

    public function archive_settings($type=null)
    {
        $data['type'] = $type;
        return view('dashbord.admin.archive.archive_settings', $data);
    }
    /***********************************************************/
    public function get_ajax_archive_settings($type)
    {
        if (request()->ajax()) {
            $data = $this->ArchiveStructureRepository->getByWhere(['ttype' => $type], 'id', 'desc');


            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('name', function ($row) {
                    return $row->title;


                })
                ->addColumn('color', function ($row) {
                    return '<div  style="width: 20px; height: 20px; background-color: ' . $row->color . '; text-align: center"></div>';
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
    public function add_archive_settings(GeneralSettingsRequest $request, $type)
    {
        // dd($request);
        try {
            $archivel_setting_Model = new ArchiveSettings();
            $data = $archivel_setting_Model->add_setting_data($request, $type);
            if(empty($request->row_id))
            {
                $this->ArchiveStructureRepository->create($data);

            }else{
                $this->ArchiveStructureRepository->update($request->row_id,$data);
            }
            notify()->success(translate('archive_setting_successfully'), '');
            return redirect()->route('admin.archive_settings',$type);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /*****************************************************/
    public function delete_archive_settings(Request $request,$id)
    {
        try {
            $setting = $this->ArchiveStructureRepository->getById($id);
            $this->ArchiveStructureRepository->delete($id);
            notify()->success(translate('archive_setting_deleted_successfully'), '');
            return redirect()->route('admin.archive_settings',$setting->ttype);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /****************************************************/
    public function edit_archive_settings($id)
    {
        $data['all_data']=$this->ArchiveStructureRepository->getById($id);
        return response()->json($data);
    }
    /********************************************************/
    public function archive_shelf_settings($type=null)
    {
        $data['type'] = $type;
        $data['desks']=$this->ArchiveStructureRepository->getBywhere(['ttype'=>'desk']);
        return view('dashbord.admin.archive.archive_shelf_settings', $data);
    }

    /***********************************************************/
    public function get_ajax_archive_shelf_settings($type=null)
    {
        if (request()->ajax()) {
            $archive_settings_model   = new ArchiveSettings();
            $data = $archive_settings_model->get_archive_shelf_data();
           // dd($data);
            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('desk', function ($row) {
                    return $row->disk_name;
                })
                ->addColumn('shelf', function ($row) {
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

    /********************************************************/
    public function add_archive_shelf_settings(ArchiveShelfSetting_R $request)
    {
        try {
            $archivel_setting_Model = new ArchiveSettings();
            $data = $archivel_setting_Model->add_shelf_setting_data($request);
            if(empty($request->row_id))
            {
                $this->ArchiveStructureRepository->create($data);

            }else{
                $this->ArchiveStructureRepository->update($request->row_id,$data);
            }
            notify()->success(translate('archive_setting_successfully'), '');
            return redirect()->route('admin.archive_shelf_settings','shelf');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
