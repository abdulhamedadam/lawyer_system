<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\mraf3at\AddMraf3atRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Cases;
use App\Models\Mraf3at;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class Mraf3atController extends Controller
{
    protected $Mraf3atRepository;
    protected $CasesRepository;
    protected $CaseSettingRepository;


    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->Mraf3atRepository = createRepository($basicRepository, new Mraf3at());
        $this->CasesRepository = createRepository($basicRepository, new Cases());
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = Mraf3at::select('*');
            //dd($allData);
            return DataTables::of($allData)
                ->editColumn('case_num', function ($row) {
                    return '<a href="' . route('admin.case_status', $row->cases->id) . '" style="text-decoration: underline;">' . $row->cases->case_num . '</a>';
                })->editColumn('client_name', function ($row) {
                    return '<a href="' . route('admin.morfqat', $row->cases->client_id_fk) . '" style="text-decoration: underline;">' . $row->cases->client->name . '</a>';
                })->editColumn('case_name', function ($row) {
                    return '<a href="' . route('admin.case_status', $row->cases->id) . '" style="text-decoration: underline;">' . $row->cases->case_name . '</a>';
                })->editColumn('case_type', function ($row) {
                    return $row->cases->caseType->title;
                })->editColumn('source', function ($row) {
                    return $row->source;
                })->editColumn('mraf3a_name', function ($row) {
                    return $row->mraf3a_name;
                })->editColumn('addition_date', function ($row) {
                    return $row->addition_date;
                })->editColumn('mraf3a_text', function ($row) {
                    return Str::words($row->mraf3a_text, 25);
                })->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.Mraf3at.edit', $row->id) . '" class="btn btn-sm btn-warning" title="">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="' . route('admin.Mraf3at.destroy', $row->id) . '" method="POST" style="display: inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are You Sure To Delete?\')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>';
                })
                ->rawColumns(['action', 'case_num', 'case_name', 'client_name'])
                ->make(true);
        }
        return view('dashbord.admin.mraf3at.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['cases'] = $this->CasesRepository->getAll();
        return view('dashbord.admin.mraf3at.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddMraf3atRequest $request)
    {
        try {
            $data = $this->prepared_data($request, 'save');
            $this->Mraf3atRepository->create($data);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.Mraf3at.index');
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['mraf3a'] = $this->Mraf3atRepository->getById($id);
        $data['cases'] = $this->CasesRepository->getAll();
        return view('dashbord.admin.mraf3at.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddMraf3atRequest $request, string $id)
    {
        try {
            $data = $this->prepared_data($request, 'update');
            $this->Mraf3atRepository->update($id, $data);
            $request->session()->flash('toastMessage', translate('updated_successfully'));
            return redirect()->route('admin.Mraf3at.index');
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $this->Mraf3atRepository->delete($id);
            $request->session()->flash('toastMessage', translate('deleted_successfully'));
            return redirect()->route('admin.Mraf3at.index');
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function prepared_data($request, $type = 'save')
    {
        $data = [];

        $data['case_id'] = $request->input('case_id');
        $data['source'] = $request->input('source');
        $data['mraf3a_name'] = $request->input('mraf3a_name');
        $data['addition_date'] = $request->input('addition_date');
        $data['mraf3a_text'] = $request->input('mraf3a_text');

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
