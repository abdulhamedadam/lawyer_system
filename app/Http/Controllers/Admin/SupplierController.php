<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Employees;
use App\Models\Assets;
use App\Models\AssetsType;
use App\Models\Suppliers;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;
class SupplierController extends Controller
{

    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $SuppliersRepository;


    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->SuppliersRepository = createRepository($basicRepository, new Suppliers());

    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = Suppliers::select('*');
            //dd($allData);
            return DataTables::of($allData)
                ->editColumn('name', function ($row) {
                    return $row->name;
                })->editColumn('company_name', function ($row) {
                    return $row->company_name;
                })->editColumn('address', function ($row) {
                    return $row->address;
                })->editColumn('phone_number', function ($row) {
                    return $row->phone_number;
                })->editColumn('tax_record', function ($row) {
                    return $row->tax_record;
                })->editColumn('commercial_record', function ($row) {
                    return $row->commercial_record;
                })->editColumn('email', function ($row) {
                    return $row->email;
                })->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.Suppliers.edit', $row->id) . '" class="btn btn-sm btn-warning" title="">
            <i class="bi bi-pencil"></i>
        </a>
        <form action="' . route('admin.Suppliers.destroy', $row->id) . '" method="POST" style="display: inline;">
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
        return view('dashbord.admin.suppliers.index');
    }

    /**********************************************************/
    public function create()
    {
        return view('dashbord.admin.suppliers.form');
    }
    /***********************************************/
    public function store(Request $request)
    {
        try {

            $data = $this->prepared_data($request, 'save');

             $this->SuppliersRepository->create($data);

            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.Suppliers.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /***********************************************/
    public function show(string $id)
    {
        $data['all_data']=$this->SuppliersRepository->getById($id);
        return view('dashbord.admin.suppliers.show',$data);
    }
    /***********************************************/
    public function edit(string $id)
    {
        $data['all_data']=$this->SuppliersRepository->getById($id);
        return view('dashbord.admin.suppliers.edit',$data);
    }
    /***********************************************/
    public function update(Request $request, string $id)
    {
        try {

            $data = $this->prepared_data($request, 'update');

            $this->SuppliersRepository->update($id,$data);

            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.Suppliers.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /***********************************************/
    public function destroy(Request $request,$id)
    {
        try {

            $this->SuppliersRepository->delete($id);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.Assets.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /***********************************************/
    private function prepared_data($request, $type = 'save')
    {
        $data = [];
        $data['name'] = $request->input('name');
        $data['company_name'] = $request->input('company_name');
        $data['address'] = $request->input('address');
        $data['phone_number'] = $request->input('phone_number');
        $data['tax_record'] = $request->input('tax_record');
        $data['commercial_record'] = $request->input('commercial_record');
        $data['email'] = $request->input('email');
        $data['notes'] = $request->input('notes');
        if ($type == 'save') {
            $data['created_at'] = now();
            $data['created_by'] = auth()->user()->id;
        }

        if ($type == 'update') {
            $data['updated_at'] = now();
            $data['updated_by'] = auth()->user()->id;
        }

        return $data;
    }

}
