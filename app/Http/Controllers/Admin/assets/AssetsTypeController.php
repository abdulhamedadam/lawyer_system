<?php

namespace App\Http\Controllers\Admin\assets;

use App\Http\Controllers\Controller;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\AssetsType;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;

class AssetsTypeController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $AssetsTypeRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->AssetsTypeRepository = createRepository($basicRepository, new AssetsType());

    }

    /**********************************************************/
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = $this->AssetsTypeRepository->getAll();


            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    return '<a data-bs-toggle="modal" data-bs-target="#modalsettings" onclick="edit_setting(' . $row->id . ')" class="btn btn-sm btn-warning" title="">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="' . route('admin.delete_assets_type', $row->id) . '"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>';
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        $data['type'] = '';
        return view('dashbord.admin.assets.assets_type', $data);
    }

    /********************************************************/
    public function add_assets_type(Request $request)
    {
        // dd($request);
        try {
            $data['name']=$request->setting_name;
            if (empty($request->row_id)) {
                $this->AssetsTypeRepository->create($data);

            } else {
                $this->AssetsTypeRepository->update($request->row_id, $data);
            }
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.assets_type');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /***********************************************************/
    public function edit(Request $request,$id)
    {
        $data['all_data']=$this->AssetsTypeRepository->getById($id);
        return response()->json($data);
    }
    /***********************************************************/
    public function delete(Request $request,$id)
    {
        try {
            $setting = $this->AssetsTypeRepository->getById($id);
            $this->AssetsTypeRepository->delete($id);
            $request->session()->flash('toastMessage', translate('deleted_successfully'));
            return redirect()->route('admin.general_settings',$setting->ttype);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
