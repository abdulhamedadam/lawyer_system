<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\Cleints;
use App\Models\Admin\GeneralSetting;
use App\Models\Suppliers;
use App\Models\Tawkelat;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class TawkelateController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $TawkelateRepository;
    protected $ClientRepository;
    protected $CaseSettingRepository;


    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->TawkelateRepository = createRepository($basicRepository, new Tawkelat());
        $this->ClientRepository = createRepository($basicRepository, new Cleints());
        $this->CaseSettingRepository = createRepository($basicRepository, new CaseSettings());

    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = Tawkelat::select('*');
            //dd($allData);
            return DataTables::of($allData)
                ->editColumn('tawkel_type', function ($row) {
                    return $row->TawkelType->title;
                })->editColumn('client', function ($row) {
                    return $row->Client->name;
                })->editColumn('tawkel_number', function ($row) {
                    return $row->tawkel_number;
                })->editColumn('tawkel_authority', function ($row) {
                    return $row->tawkel_authority;
                })->editColumn('client_phone', function ($row) {
                    return $row->client_phone;
                })->editColumn('tawkel_date', function ($row) {
                    return $row->tawkel_date;
                })->editColumn('tawkel_image', function ($row) {
                    $imageUrl = asset(Storage::disk('images')->url($row->tawkel_image));
                    return '<img src="' . $imageUrl . '" alt="Image" style="width: 50px; height: 50px; cursor: pointer;" onclick="showImagePopup(\'' . $imageUrl . '\')">';
                })->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.Tawkelate.edit', $row->id) . '" class="btn btn-sm btn-warning" title="">
            <i class="bi bi-pencil"></i>
        </a>
        <form action="' . route('admin.Tawkelate.destroy', $row->id) . '" method="POST" style="display: inline;">
            ' . csrf_field() . '
            ' . method_field('DELETE') . '
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are You Sure To Delete?\')">
                <i class="bi bi-trash"></i>
            </button>
        </form>';

                })
                ->rawColumns(['action','tawkel_image'])
                ->make(true);
        }
        return view('dashbord.admin.tawkelate.index');
    }

    /**********************************************************/
    public function create()
    {
        $data['tawkel_type'] = $this->CaseSettingRepository->getBywhere(['ttype' => 'tawkel_type']);
        $data['clients'] = $this->ClientRepository->getAll();
        return view('dashbord.admin.tawkelate.form', $data);
    }

    /***********************************************/
    public function store(Request $request)
    {
        try {

            $data = $this->prepared_data($request, 'save');

            $this->TawkelateRepository->create($data);

            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.Tawkelate.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /***********************************************/
    public function show(string $id)
    {
        $data['all_data'] = $this->TawkelateRepository->getById($id);
        return view('dashbord.admin.tawkelate.show', $data);
    }

    /***********************************************/
    public function edit(string $id)
    {
        $data['all_data'] = $this->TawkelateRepository->getById($id);
        $data['tawkel_type'] = $this->CaseSettingRepository->getBywhere(['ttype' => 'tawkel_type']);
        $data['clients'] = $this->ClientRepository->getAll();
        return view('dashbord.admin.tawkelate.edit', $data);
    }

    /***********************************************/
    public function update(Request $request, string $id)
    {
        try {

            $data = $this->prepared_data($request, 'update');

            $this->TawkelateRepository->update($id, $data);

            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.Tawkelate.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /***********************************************/
    public function destroy(Request $request, $id)
    {
        try {

            $this->TawkelateRepository->delete($id);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.Tawkelate.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /***********************************************/
    private function prepared_data($request, $type = 'save')
    {
        $data = [];
        $clients = $this->ClientRepository->getById($request->input('client_id'));
        $data['tawkel_type'] = $request->input('tawkel_type');
        $data['client_id'] = $request->input('client_id');
        $data['client_name'] = $clients->name;
        $data['client_address'] = $request->input('client_address');
        $data['tawkel_number'] = $request->input('tawkel_number');
        $data['client_phone'] = $request->input('client_phone');
        $data['client_email'] = $request->input('email');
        $data['tawkel_authority'] = $request->input('tawkel_authority');
        $data['notes'] = $request->input('notes');
        $data['tawkel_image'] = $request->input('tawkel_image');
        $data['tawkel_date'] = $request->input('tawkel_date');
        $data['documentation_date'] = $request->input('documentation_date');


        if ($type == 'save') {
            if ($request->hasFile('tawkel_image')) {
                $file = $request->file('tawkel_image');
                $dataX = $this->saveFile($file, 'tawkelate');
                $data['tawkel_image'] = $dataX;
            }

            $data['created_at'] = now();
            $data['created_by'] = auth()->user()->id;
        }

        if ($type == 'update') {

            if ($request->hasFile('tawkel_image')==true) {
             //   dd('sss');
                $file = $request->file('tawkel_image');
                $dataX = $this->saveImage($file,'tawkelate');
                $data['tawkel_image'] = $dataX;
            }
           // dd($data['tawkel_image']);
            $data['updated_at'] = now();
            $data['updated_by'] = auth()->user()->id;
        }

        return $data;

    }
    /***********************************************/
    public function get_client_tawkel($id)
    {
        $tawkelate = $this->TawkelateRepository->getBywhere(['client_id' => $id])->load('TawkelType');
        $client = $this->ClientRepository->getById($id);
        // dd($client);
        return response()->json([
            'tawkelate' => $tawkelate,
            'phone' => $client->phone_number,
        ]);

    }

}
