<?php

namespace App\Http\Controllers\Admin\assets;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\assets\StoreAssetsRequests;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Cases;
use App\Models\Admin\Employees;
use App\Models\Admin\GeneralSetting;
use App\Models\Assets;
use App\Models\AssetsType;
use App\Models\Finance\payment;
use App\Models\Suppliers;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;

class AssetsController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $AssetsRepository;
    protected $AssetsTypeRepository;
    protected $SuppliersRepository;
    protected $EmployeesRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->AssetsRepository = createRepository($basicRepository, new Assets());
        $this->AssetsTypeRepository = createRepository($basicRepository, new AssetsType());
        $this->SuppliersRepository = createRepository($basicRepository, new Suppliers());
        $this->EmployeesRepository = createRepository($basicRepository, new Employees());

    }

    /**********************************************************/
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = Assets::select('*');
            return Datatables::of($allData)
                ->editColumn('asset_name', function ($row) {
                    return $row->name;
                })->editColumn('asset_type', function ($row) {
                    return $row->AssetType->name;
                })->editColumn('purchases_value', function ($row) {
                    return $row->purchase_value;
                })->editColumn('purchases_date', function ($row) {
                    return $row->purchase_date;
                })->editColumn('supplier', function ($row) {
                    return $row->Supplier->name;
                })->editColumn('received_by', function ($row) {
                    return $row->ReceivedBy->employee;

                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.Assets.edit', $row->id) . '" class="btn btn-sm btn-warning" title="">
            <i class="bi bi-pencil"></i>
        </a>
        <form action="' . route('admin.Assets.destroy', $row->id) . '" method="POST" style="display: inline;">
            ' . csrf_field() . '
            ' . method_field('DELETE') . '
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are You Sure To Delete?\')">
                <i class="bi bi-trash"></i>
            </button>
        </form>';

                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashbord.admin.assets.index');
    }

    /**********************************************************/
    public function create()
    {
        $data['assets_types'] = $this->AssetsTypeRepository->getAll();
        $data['suppliers'] = $this->SuppliersRepository->getAll();
        $data['employees'] = $this->EmployeesRepository->getAll();

        return view('dashbord.admin.assets.form', $data);
    }

    /*********************************************************/
    public function store(StoreAssetsRequests $request)
    {
        try {

            $data = $this->prepared_data($request, 'save');
            $case = $this->AssetsRepository->create($data);

            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.Assets.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /***************************************************/
    private function prepared_data($request, $type = 'save')
    {
        $data['name'] = $request->asset_name;
        $data['assets_type'] = $request->assets_type;
        $data['notes'] = $request->notes;
        $data['received_by'] = $request->received_by;
        $data['supplier'] = $request->supplier;
        $data['purchase_value'] = $request->purchases_value;
        $data['purchase_date'] = $request->purchases_date;
        if ($type == 'save') {
            $data['created_by'] = auth()->user()->id;
        } else {
            $data['updated_by'] = auth()->user()->id;
        }
        return $data;
    }

    /***************************************************/
    public function edit($id)
    {
        $data['all_data'] = $this->AssetsRepository->getById($id);
        $data['assets_types'] = $this->AssetsTypeRepository->getAll();
        $data['suppliers'] = $this->SuppliersRepository->getAll();
        $data['employees'] = $this->EmployeesRepository->getAll();

        return view('dashbord.admin.assets.edit', $data);
    }

    /*************************************************/
    public function update(StoreAssetsRequests $request, $id)
    {
        try {

            $data = $this->prepared_data($request, 'update');
            $case = $this->AssetsRepository->update($id, $data);

            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.Assets.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /************************************************/
    public function destroy(Request $request,$id)
    {
        try {

            $this->AssetsRepository->delete($id);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.Assets.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
