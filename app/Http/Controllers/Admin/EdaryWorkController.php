<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cases\ArchiveCase_R;
use App\Http\Requests\Admin\edaryWork\AddEdaryWorkRequest;
use App\Http\Requests\Admin\FileRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Archive\Achive_m;
use App\Models\Admin\Archive\AchiveFiles_m;
use App\Models\Admin\Archive\ArchiveSettings;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\Cleints;
use App\Models\Admin\Employees;
use App\Models\EdaryWork;
use App\Models\EdaryWorkAgra2at;
use App\Models\EdaryWorkFiles;
use App\Models\EdaryWorkPayments;
use App\Models\Tawkelat;
use App\Traits\ImageProcessing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class EdaryWorkController extends Controller
{
    use ImageProcessing;
    protected $EdaryWorkRepository;
    protected $ClientRepository;
    protected $CaseSettingRepository;
    protected $EmployeeRepository;
    protected $CasesSettingRepository;
    protected $TawkelateRepository;
    protected $EdaryWorkPaymentRepository;
    protected $EdaryWorkagra2atRepository;
    protected $ArchiveRepository;
    protected $ArchiveFilesRepository;
    protected $ArchiveStructureRepository;
    protected $EdaryWorkFilesRepository;


    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->EdaryWorkRepository = createRepository($basicRepository, new EdaryWork());
        $this->ClientRepository = createRepository($basicRepository, new Cleints());
        $this->CaseSettingRepository = createRepository($basicRepository, new CaseSettings());
        $this->EmployeeRepository = createRepository($basicRepository, new Employees());
        $this->CasesSettingRepository = createRepository($basicRepository, new CaseSettings());
        $this->TawkelateRepository = createRepository($basicRepository, new Tawkelat());
        $this->EdaryWorkPaymentRepository = createRepository($basicRepository, new EdaryWorkPayments());
        $this->EdaryWorkagra2atRepository = createRepository($basicRepository, new EdaryWorkAgra2at());
        $this->ArchiveRepository = createRepository($basicRepository, new Achive_m());
        $this->ArchiveFilesRepository = createRepository($basicRepository, new AchiveFiles_m());
        $this->ArchiveStructureRepository = createRepository($basicRepository, new ArchiveSettings());
        $this->EdaryWorkFilesRepository = createRepository($basicRepository, new EdaryWorkFiles());
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = EdaryWork::with(['client', 'employee', 'tawkelat'])->select('*');

            return DataTables::of($allData)
                ->editColumn('client_name', function ($row) {
                    return $row->client->name ?? 'N/A';
                })
                ->editColumn('esnad_to', function ($row) {
                    return $row->employee->employee ?? 'N/A';
                })
                ->editColumn('estlam_date', function ($row) {
                    return $row->estlam_date;
                })
                ->editColumn('tawkel_num', function ($row) {
                    return $row->tawkelat->tawkel_number;
                })
                ->editColumn('tawkel_type', function ($row) {
                    return $row->tawkelat->TawkelType->title ?? 'N/A';
                })
                ->editColumn('tawkel_authority', function ($row) {
                    return $row->authority_entity ?? 'N/A';
                })
                ->editColumn('date_authority', function ($row) {
                    return $row->date_authority;
                })
                ->editColumn('fees', function ($row) {
                    return number_format($row->total_fees, 2) . ' EGP';
                })
                ->editColumn('edary_work_type', function ($row) {
                    return $row->edaryType->title;
                })
                ->addColumn('action', function ($row) {
                    return '
                    <div class="btn-group">
                        <button style="font-size: 16px" type="button" class="btn btn-sm btn-secondary">' . translate('actions') . '</button>
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="hover-effect dropdown-item" target="_blank" href="' . route('admin.edary_work.edit', $row->id) . '">
                                    <i class="bi bi-info-circle-fill"></i> ' . translate('edit') . '
                                </a>
                            </li>
                            <li>
                                <form action="' . route('admin.edary_work.destroy', $row->id) . '" method="POST" class="dropdown-item hover-effect" style="display: inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-link p-0 m-0 text-decoration-none text-start">
                                        <i class="bi bi-trash-fill"></i> ' . translate('delete') . '
                                    </button>
                                </form>
                            </li>
                            <li><a  class="hover-effect dropdown-item" target="_blank" href="' . route('admin.edary_work_morfqat', $row->id) . '"><i class="bi bi-file-earmark-check"></i> ' . translate('attachments') . '</a></li>
                            <li><a  class="hover-effect dropdown-item" target="_blank" href="' . route('admin.edary_work_payments', $row->id) . '"><i class="bi bi-cash"></i> ' . translate('payments') . '</a></li>
                            <li><a  class="hover-effect dropdown-item" target="_blank" href="' . route('admin.edary_work_agra2at', $row->id) . '"><i class="bi bi-file-earmark-text"></i> ' . translate('required_agra2at') . '</a></li>
                        </ul>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashbord.admin.edary_work.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['emps'] = $this->EmployeeRepository->getAll();
        $data['clients'] = $this->ClientRepository->getAll();
        $data['edary_types'] = $this->CasesSettingRepository->getBywhere(array('ttype' => 'administrative_work'));
        // dd($data['edary_types']);
        return view('dashbord.admin.edary_work.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddEdaryWorkRequest $request)
    {
        try {
            $data = $this->prepared_data($request, 'save');
            // dd($data);
            $this->EdaryWorkRepository->create($data);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.edary_work.index');
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
        $data['edaryWork'] = $this->EdaryWorkRepository->getById($id);
        // dd($data['edaryWork']);
        $data['emps'] = $this->EmployeeRepository->getAll();
        $data['clients'] = $this->ClientRepository->getAll();
        $data['edary_types'] = $this->CasesSettingRepository->getBywhere(array('ttype' => 'administrative_work'));
        $data['tawkelate'] = $this->TawkelateRepository->getAll();
        return view('dashbord.admin.edary_work.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $data = $this->prepared_data($request, 'update');

            $this->EdaryWorkRepository->update($id, $data);

            $request->session()->flash('toastMessage', translate('updated_successfully'));
            return redirect()->route('admin.edary_work.index');
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
            $this->EdaryWorkRepository->delete($id);
            $request->session()->flash('toastMessage', translate('deleted_successfully'));
            return redirect()->route('admin.edary_work.index');
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function prepared_data($request, $type = 'save')
    {
        $data = [];

        $data['estlam_date'] = $request->input('estlam_date');
        $data['date_authority'] = $request->input('date_authority');
        $data['client_id'] = $request->input('client_id');
        $data['tawkel_id'] = $request->input('tawkel_id');
        $data['edary_work_type'] = $request->input('edary_work_type');
        $data['esnad_to_id'] = $request->input('esnad_to_id');
        $data['subject_entity'] = $request->input('subject_entity');
        $data['authority_entity'] = $request->input('authority_entity');
        $data['subject_entity_address'] = $request->input('subject_entity_address');
        $data['total_fees'] = $request->input('total_fees');
        $data['subject'] = $request->input('subject');

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

    /*******************************************************************************/
    public function payments(EdaryWork $edaryWork, $id)
    {
        // $data['all_data'] = $edaryWork->get_data_table_data($id)[0];
        $data['all_data'] = $edaryWork->with('client', 'tawkelat', 'employee')->first();
        $data['payment_data'] = $this->EdaryWorkPaymentRepository->getBywhere(array('edary_work_id' => $id))->toArray();
        // dd($data);
        return view('dashbord.admin.edary_work.payments.edary_work_payments', $data);
    }

    /******************************************************************************/
    public function add_payments(Request $request, $id)
    {
        $request->validate([
            'notes' => 'required',
            'paid_date' => 'required',
            'paid_value' => 'required',
            'person_name' => 'required',
            'person_phone' => 'required',
        ]);
        try {
            $edaryWork = $this->EdaryWorkRepository->getById($id);
            $edaryWorkPayment = new EdaryWorkPayments();
            $data = $edaryWorkPayment->add_edary_work_payment($request, $edaryWork);
            // dd($data);
            $this->EdaryWorkPaymentRepository->create($data);
            notify()->success(translate('payment_added_successfully'), '');
            return redirect()->route('admin.edary_work_payments', $id);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /******************************************************************************/
    public function edit_payments($id)
    {
        $data['payments'] = $this->EdaryWorkPaymentRepository->getById($id);
        return view('dashbord.admin.edary_work.payments.edary_work_payments_edit', $data);
    }

    /*******************************************************************************/
    public function update_payments(Request $request, $payment_id)
    {
        $request->validate([
            'notes' => 'required',
            'paid_date' => 'required',
            'paid_value' => 'required',
            'person_name' => 'required',
            'person_phone' => 'required',
        ]);
        try {
            $edary_work_payment_data = $this->EdaryWorkPaymentRepository->getById($payment_id);
            $edaryWorkPayment = new EdaryWorkPayments();
            $data = $edaryWorkPayment->update_edary_work_payment($request);
            $this->EdaryWorkPaymentRepository->update($payment_id, $data);
            notify()->success(translate('payment_updated_successfully'), '');
            return redirect()->route('admin.edary_work_payments', $edary_work_payment_data->edary_work_id);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /******************************************************************************/
    public function delete_payments($payment_id)
    {
        try {
            $edary_work_payment = $this->EdaryWorkPaymentRepository->getById($payment_id);
            $edary_work_id = $edary_work_payment->edary_work_id;
            $this->EdaryWorkPaymentRepository->delete($payment_id);

            notify()->error(translate('payemnt_deleted_successfully'), '');
            return redirect()->route('admin.edary_work_payments', $edary_work_id);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /*******************************************************************************/
    public function agra2at(EdaryWork $edaryWork, $id)
    {
        $data['all_data'] = $edaryWork->with('client', 'tawkelat', 'employee')->first();
        $data['emps'] = $this->EmployeeRepository->getAll();

        $lastAgra2NumData = $this->EdaryWorkagra2atRepository->getBywhere([
            'edary_work_id' => $id
        ]);
        $lastAgra2Num = $lastAgra2NumData->max('agra2_num');
        $data['newAgra2Num'] = $lastAgra2Num ? $lastAgra2Num + 1 : 1;

        $agra2at_data = $this->EdaryWorkagra2atRepository->getBywhere(['edary_work_id' => $id]);

        $data['agra2at_data'] = $agra2at_data->load('employee');
        // dd($data);
        return view('dashbord.admin.edary_work.agra2at.edary_work_agra2at', $data);
    }

    /******************************************************************************/
    public function add_agra2(Request $request, $id)
    {
        $request->validate([
            'agra2_num' => 'required|integer|min:1',
            'year' => 'required|integer|min:2000',
            'agra2_date' => 'required|date',
            'agra2_take_place' => 'required|string|max:255',
            'lawyer_id' => 'required|integer|exists:employees,id',
            'alagra2' => 'required|string',
        ]);
        try {
            $edaryWork = $this->EdaryWorkRepository->getById($id);
            $edaryWorkagra2 = new EdaryWorkAgra2at();
            $data = $edaryWorkagra2->add_edary_work_agra2($request, $edaryWork);
            // dd($data);
            $this->EdaryWorkagra2atRepository->create($data);
            notify()->success(translate('agra2_added_successfully'), '');
            return redirect()->route('admin.edary_work_agra2at', $id);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /******************************************************************************/
    public function edit_agra2($id)
    {
        $data['agra2'] = $this->EdaryWorkagra2atRepository->getById($id);
        $data['emps'] = $this->EmployeeRepository->getAll();
        return view('dashbord.admin.edary_work.agra2at.edary_work_agra2at_edit', $data);
    }

    /*******************************************************************************/
    public function update_agra2(Request $request, $agra2_id)
    {
        $request->validate([
            'agra2_num' => 'required|integer|min:1',
            'year' => 'required|integer|min:2000',
            'agra2_date' => 'required|date',
            'agra2_take_place' => 'required|string|max:255',
            'lawyer_id' => 'required|integer|exists:employees,id',
            'alagra2' => 'required|string',
        ]);
        try {
            $edary_work_agra2_data = $this->EdaryWorkagra2atRepository->getById($agra2_id);
            $edaryWorkagra2 = new EdaryWorkAgra2at();
            $data = $edaryWorkagra2->update_edary_work_agra2($request);
            $this->EdaryWorkagra2atRepository->update($agra2_id, $data);
            notify()->success(translate('agra2_updated_successfully'), '');
            return redirect()->route('admin.edary_work_agra2at', $edary_work_agra2_data->edary_work_id);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /******************************************************************************/
    public function delete_agra2($agra2_id)
    {
        try {
            $edary_work_agra2 = $this->EdaryWorkagra2atRepository->getById($agra2_id);
            $edary_work_id = $edary_work_agra2->edary_work_id;
            $this->EdaryWorkagra2atRepository->delete($agra2_id);

            notify()->error(translate('agra2_deleted_successfully'), '');
            return redirect()->route('admin.edary_work_agra2at', $edary_work_id);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**********************************************************************/

    public function morfqat(Request $request, EdaryWork $edaryWork, $id)
    {
        $data['all_data'] = $edaryWork->with('client', 'tawkelat', 'employee')->first();
        $archive = $this->ArchiveRepository->getBywhere(array('type' => 'edary', 'related_entity_id' => $id));
        // dd($archive);
        $data['archive'] = $archive;

        if ($archive->isNotEmpty()) {
            $data['files_data'] = $this->ArchiveFilesRepository->getBywhere(array('archive_id' => $archive[0]->id));
            $archive_model = new Achive_m();
            $data['archive_data'] = $archive_model->get_archive_data($id, 'edary')[0];
        } else {
            $data['files_data'] = [];
        }

        $data['types'] = $this->ArchiveStructureRepository->getBywhere(['ttype' => 'archive_type']);
        $data['desk'] = $this->ArchiveStructureRepository->getBywhere(['ttype' => 'desk']);
        $data['secret_degree'] = $this->ArchiveStructureRepository->getBywhere(['ttype' => 'secret_degree']);

        // Flashing the toast message
        // $request->session()->flash('toastMessage', 'تم اضافة الملف بنجاح');


        return view('dashbord.admin.edary_work.morfqat.edary_work_morfqat', $data);
    }

    /**********************************************************************/
    public function edary_work_add_archive(ArchiveCase_R $request, $edary_work_id)
    {
        try {
            $archive_model = new Achive_m();
            $archive_data = $archive_model->save_case_archive($request, $edary_work_id);
            $this->ArchiveRepository->create($archive_data);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.edary_work_morfqat', $edary_work_id);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************************************/
    public function edary_work_add_files(FileRequest $request, $id)
    {
        try {
            $edary_work = $this->EdaryWorkRepository->getById($id);
            $edary_work_model = new EdaryWork();
            if ($request->hasFile('file')) {
                $files = $request->file('file');

                foreach ($files as $file) {
                    $dataX = $this->saveFile($file, 'edary/' . $edary_work->id);
                    // dd($dataX);
                    $data['file'] = $dataX;
                    $data['file_name'] = $request->file_name;
                    $data['edary_work_id_fk'] = $edary_work->id;
                    $data['publisher'] = auth('admin')->user()->id;
                    $data['publisher_n'] = auth('admin')->user()->name;
                    // dd($data);
                    $file = $this->EdaryWorkFilesRepository->create($data);
                    $data_file = save_archive_file($dataX, $request);
                    // dd($data_file);
                    $this->ArchiveFilesRepository->create($data_file);
                }
            }
            $request->session()->flash('toastMessage', translate('file_added_successfully'));
            return redirect()->route('admin.edary_work_morfqat', $id);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************************************/
    public function read_file($file_id)
    {
        try {
            $edary_work_file = $this->ArchiveFilesRepository->getById($file_id);
            $file_path = Storage::disk('files')->path($edary_work_file->file);
            $fileContent = Storage::get($file_path);
            return response()->file($file_path);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************************************/
    public function delete_file(Request $request, $file_id)
    {
        DB::beginTransaction();
        try {
            $archive = $this->ArchiveFilesRepository->getById($file_id);
            $file = $archive->file;
            $edary_work_id = $archive->archive->related_entity_id;

            $this->ArchiveFilesRepository->delete($file_id);
            EdaryWorkFiles::where('file', $file)->where('edary_work_id_fk', $edary_work_id)->delete();

            DB::commit();

            $request->session()->flash('toastMessage', translate('File_deleted_successfully'));
            return redirect()->route('admin.edary_work_morfqat', $edary_work_id);
        } catch (\Exception $e) {
            DB::rollBack();
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function download_file($file_id)
    {
        try {
            $edary_work_file = $this->ArchiveFilesRepository->getById($file_id);

            $file_path = Storage::disk('files')->path($edary_work_file->file);
            $file_extension = pathinfo($edary_work_file->file, PATHINFO_EXTENSION);
            $file_name_with_extension = $edary_work_file->file_name;

            if (!str_ends_with($file_name_with_extension, ".$file_extension")) {
                $file_name_with_extension .= ".$file_extension";
            }

            $headers = [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $file_name_with_extension . '"',
            ];

            return response()->download($file_path, $file_name_with_extension, $headers);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
