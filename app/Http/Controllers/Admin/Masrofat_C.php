<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\masrofat\MasrofatSave_R;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Cases;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\Employees;
use App\Models\Admin\Masrofat_M;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;

class Masrofat_C extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /*---------------------------------------------------*/

    protected $CaseSettingsRepository;
    protected $EmployeeRepository;
    protected $CasesRepository;
    protected $MasrofatRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->CaseSettingsRepository = createRepository($basicRepository, new CaseSettings());
        $this->EmployeeRepository  = createRepository($basicRepository, new Employees());
        $this->CasesRepository  = createRepository($basicRepository, new Cases());
        $this->MasrofatRepository  = createRepository($basicRepository, new Masrofat_M());

    }

    /***************************************************/
    public function add_masrofat()
    {
        $data['masrofat']=$this->CaseSettingsRepository->getBywhere(['ttype'=>'sarf_band']);
        $data['employees']=$this->EmployeeRepository->getAll();
        $data['cases']=$this->CasesRepository->getAll();
        return view('dashbord.admin.masrofat.masrofat_form',$data);
    }
    /****************************************************/
    public function save_masrofat(MasrofatSave_R $request,Masrofat_M $masrofat_M)
    {
        try {
            $data=$masrofat_M->save_masrofat_data($request);
            $this->MasrofatRepository->create($data);
            $request->session()->flash('toastMessage', translate('masrofat_added_successfully'));
            return redirect()->route('admin.add_masrofat');

        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /****************************************************/
    public function masrofat_data()
    {
        return view('dashbord.admin.masrofat.masrofat_data');
    }
    /****************************************************/
    public function ajax_data(Request $request,Masrofat_M $masrofat_M)
    {
        if ($request->ajax()) {
            $data =$masrofat_M->getAll();
             //   dd($data);
            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('related_to_case', function ($row) {
                    if($row->related_to_case =='no')
                    {
                        $case = translate('not_related_to_case');
                    }elseif ($row->related_to_case =='yes')
                    {
                        $case = $row->case_name;
                    }
                    return $case;
                })
                ->addColumn('band_name', function ($row) {
                    return $row->band_name;
                })
                ->addColumn('value', function ($row) {
                    return $row->value;
                })
                ->addColumn('emp_id', function ($row) {
                    return $row->cashier;
                })
                ->addColumn('notes', function ($row) {
                    return $row->notes;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route('admin.edit_masrofat',$row->id).'"class="btn btn-sm btn-warning" title="">
                          <i class="bi bi-pencil fs-2"></i>
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="'.route('admin.delete_masrofat',$row->id).'"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash fs-2"></i>
                        </a>

                        ';

                })->rawColumns(['action', 'details'])
                ->make(true);

            return $dataTable->toJson();
        }
    }


    /*********************************************************/
    public function edit_masrofat($id)
    {
        $data['masrofat']=$this->CaseSettingsRepository->getBywhere(['ttype'=>'sarf_band']);
        $data['employees']=$this->EmployeeRepository->getAll();
        $data['cases']=$this->CasesRepository->getAll();
        $data['all_data']=$this->MasrofatRepository->getById($id);
        return view('dashbord.admin.masrofat.masrofat_edit',$data);
    }
    /*******************************************************/
    public function update_masrofat(MasrofatSave_R $request,Masrofat_M $masrofat_M,$id)
    {
        try {
            $data=$masrofat_M->save_masrofat_data($request);
            $this->MasrofatRepository->update($id,$data);
            $request->session()->flash('toastMessage', translate('masrofat_added_successfully'));
            return redirect()->route('admin.masrofat_data');

        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /***************************************************/
    public function delete_masrofat(Request $request,$id)
    {
        try {

            $this->MasrofatRepository->delete($id);
            $request->session()->flash('toastMessage', translate('masrofat_deleted_successfully'));
            return redirect()->route('admin.masrofat_data');

        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
