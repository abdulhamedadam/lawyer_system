<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddCasesKafalateRequest;
use App\Http\Requests\Admin\Cases\ArchiveCase_R;
use App\Http\Requests\Admin\Cases\CaseSessions_R;
use App\Http\Requests\Admin\Cases\CasesStoreRequest;
use App\Http\Requests\Admin\FileRequest;
use App\Http\Requests\Admin\mo7dareen\AddMo7dareenRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Models\Admin\Agenda_M;
use App\Models\Admin\Archive\Achive_m;
use App\Models\Admin\Archive\AchiveFiles_m;
use App\Models\Admin\Archive\ArchiveSettings;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\CaseFiles;
use App\Models\admin\CasesKafalate;
use App\Models\Admin\Employees;
use App\Models\Admin\CasePayments;
use App\Models\Admin\Cases;
use App\Models\Admin\CaseSessions_M;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\Cleints;
use App\Models\Admin\CleintsFile;
use App\Models\Admin\ClientNotes;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Tasks;
use App\Models\CasesMo7dareen;
use App\Services\CaseSessionService;
use App\Services\DuesService;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CasesController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /*---------------------------------------------------*/
    protected $CasesSettingRepository;
    protected $ClientRepository;
    protected $ClientCasesRepository;
    protected $CasesFilesRepository;
    protected $CasesPaymentRepository;
    protected $CasesTasksRepository;
    protected $GeneralSettingsRepository;
    protected $EmployeeRepository;
    protected $ArchiveFilesRepository;
    protected $ArchiveRepository;
    protected $ArchiveStructureRepository;
    protected $CaseSessionRepository;
    protected $AgendaRepository;
    protected $caseSessionService;
    protected $CaseMo7dareen;
    protected $CaseKafalate;

    public function __construct(BasicRepositoryInterface $basicRepository, CaseSessionService $caseSessionService, DuesService $duesService)
    {

        $this->ClientRepository = createRepository($basicRepository, new Cleints());
        $this->CaseKafalate = createRepository($basicRepository, new CasesKafalate());
        $this->ArchiveRepository = createRepository($basicRepository, new Achive_m());
        $this->ArchiveFilesRepository = createRepository($basicRepository, new AchiveFiles_m());
        $this->ArchiveStructureRepository = createRepository($basicRepository, new ArchiveSettings());
        $this->CasesSettingRepository = createRepository($basicRepository, new CaseSettings());
        $this->ClientCasesRepository = createRepository($basicRepository, new Cases());
        $this->CasesFilesRepository = createRepository($basicRepository, new CaseFiles());
        $this->CasesPaymentRepository = createRepository($basicRepository, new CasePayments());
        $this->CasesTasksRepository = createRepository($basicRepository, new Tasks());
        $this->GeneralSettingsRepository = createRepository($basicRepository, new GeneralSetting());
        $this->EmployeeRepository = createRepository($basicRepository, new Employees());
        $this->CaseSessionRepository = createRepository($basicRepository, new CaseSessions_M());
        $this->AgendaRepository = createRepository($basicRepository, new Agenda_M());
        $this->CaseMo7dareen = createRepository($basicRepository, new CasesMo7dareen());
        $this->caseSessionService = $caseSessionService;
        $this->duesService = $duesService;

    }

    /**************************************************************************/
    public function index()
    {
        return view('dashbord.admin.cases.cases_data');
    }

    /**************************************************************************/
    public function get_ajex_notes(Request $request)
    {
        if ($request->ajax()) {

            $caseModel = new Cases();
            $data = $caseModel->get_data_table_data();
            //test($data);
            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('case_num', function ($row) {
                    return '<span style="color: green;">' . translate('case_num') . '</span> : <span style="color: blue;">' . $row->case_num . '</span><br>' .
                        '<span style="color: green;">' . translate('for_year') . ':</span> : <span style="color: blue;">' . $row->year . '</span>';
                })
                ->addColumn('client_name', function ($row) {
                    $icon = '<i class="fas fa-user"></i>';
                    return $row->client_name;
                })
                ->addColumn('case_title', function ($row) {
                    return $row->case_name;
                })
                ->addColumn('case_type', function ($row) {
                    return $row->case_type;;
                })
                ->addColumn('court', function ($row) {
                    return $row->court;;
                })
                ->addColumn('fees', function ($row) {

                    return '<span style="background-color: lightgreen ; " class="span_data_table">' . $row->fees . '</span>' . ' ' . get_currency();
                })
                ->addColumn('total_paid', function ($row) {

                    return '<span style="background-color: lightgoldenrodyellow ; " class="span_data_table">' . get_all_paid_by_case($row->id) . '</span>' . ' ' . get_currency();
                })
                ->addColumn('remain', function ($row) {

                    return '<span style="background-color: lightcoral ; " class="span_data_table">' . ($row->fees - get_all_paid_by_case($row->id)) . '</span>' . ' ' . get_currency();
                })
                ->addColumn('case_status', function ($row) {
                    return $row->case_status;;
                })
                ->addColumn('action', function ($row) {
                    return '
<div class="btn-group">
    <button style="font-size: 16px" type="button" class="btn btn-sm btn-secondary">' . translate('actions') . '</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">

        <li><a  class="hover-effect dropdown-item" target="_blank" href="' . route('admin.edit_case', $row->id) . '"><i class="bi bi-info-circle-fill"></i> ' . translate('edit') . '</a></li>
        <li><a  class="hover-effect dropdown-item" target="" href="' . route('admin.delete_case', $row->id) . '"><i class="bi bi-trash-fill"></i> ' . translate('delete') . '</a></li>
        <li><a  class="hover-effect dropdown-item" target="_blank" href="' . route('admin.case_morfqat', $row->id) . '"><i class="bi bi-paperclip"></i> ' . translate('files') . '</a></li>
        <li><a  class="hover-effect dropdown-item" target="_blank" href="' . route('admin.case_payments', $row->id) . '"><i class="bi bi-cash"></i> ' . translate('case_payments') . '</a></li>
        <li><a  class="hover-effect dropdown-item" target="_blank" href="' . route('admin.case_tasks', $row->id) . '"><i class="bi bi-list-task"></i> ' . translate('tasks') . '</a></li>
        <li><a  class="hover-effect dropdown-item" target="_blank" href="' . route('admin.case_sessions', $row->id) . '"><i class="bi bi-list-task"></i> ' . translate('Case_sessions') . '</a></li>
    </ul>
</div>';

                })->rawColumns(['image', 'action', 'client_name', 'fees', 'remain', 'total_paid', 'case_num'])
                ->make(true);

            return $dataTable->toJson();
        }
    }

    /**************************************************************************/
    public function add_case()
    {
        $case_model = new Cases();
        $data['clients'] = $this->ClientRepository->getAll();
        $data['emps'] = $this->EmployeeRepository->getAll();
        $data['case_num'] = $case_model->get_next_case_num();
        $data['case_type'] = $this->CasesSettingRepository->getBywhere(array('ttype' => 'case_type'));
        $data['courts'] = $this->CasesSettingRepository->getBywhere(array('ttype' => 'courts'));
        $data['case_status'] = $this->CasesSettingRepository->getBywhere(array('ttype' => 'case_status'));
        $data['khesm_type'] = $this->CasesSettingRepository->getBywhere(['ttype' => 'mawkel_type']);
        $data['litigation_degree'] = $this->CasesSettingRepository->getBywhere(['ttype' => 'litigation_degree']);
        return view('dashbord.admin.cases.cases_form', $data);
    }

    /************************************************************************/
    public function save_case(CasesStoreRequest $request)
    {
        try {
            // dd($request->fees);
            $case_model = new Cases();
            $insert_data = $case_model->insert_data($request);
            $case = $this->ClientCasesRepository->create($insert_data);

            $this->duesService->SaveDues('case', $request->fees, $case->id, $request->client_id);

            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.cases_data');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /***********************************************************************/
    public function edit_case($id)
    {

        $case_model = new Cases();
        $data['clients'] = $this->ClientRepository->getAll();
        $data['case_type'] = $this->CasesSettingRepository->getBywhere(array('ttype' => 'case_type'));
        $data['courts'] = $this->CasesSettingRepository->getBywhere(array('ttype' => 'courts'));
        $data['case_status'] = $this->CasesSettingRepository->getBywhere(array('ttype' => 'case_status'));
        $data['all_data'] = $this->ClientCasesRepository->getById($id);
        return view('dashbord.admin.cases.cases_edit', $data);
    }

    /***********************************************************************/
    public function update_case(CasesStoreRequest $request, $id)
    {
        try {
            $case_model = new Cases();
            $insert_data = $case_model->insert_data($request);
            // dd($insert_data);
            $case = $this->ClientCasesRepository->update($id, $insert_data);
            $this->duesService->updateDues('case', $request->fees, $id, $request->client_id);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.cases_data');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /***********************************************************************/
    public function delete_case(Request $request, $id)
    {
        $case = $this->ClientCasesRepository->getById($id);
        $client = $this->ClientCasesRepository->delete($id);
        $this->duesService->DeleteDues('case', $case->id);

        if ($client) {
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.cases_data');
        } else {
            return redirect()->route('admin.cases_data');
        }


    }

    /**********************************************************************/

    public function morfqat(Request $request, Cases $cases, $id)
    {
        $data['all_data'] = $cases->get_data_table_data($id)[0];
        $archive = $this->ArchiveRepository->getBywhere(array('type' => 'cases', 'related_entity_id' => $id));
        //dd($archive);
        $data['archive'] = $archive;

        if ($archive->isNotEmpty()) {
            $data['files_data'] = $this->ArchiveFilesRepository->getBywhere(array('archive_id' => $archive[0]->id));
            $archive_model = new Achive_m();
            $data['archive_data'] = $archive_model->get_archive_data($id, 'cases')[0];

        } else {
            $data['files_data'] = [];
        }

        $data['types'] = $this->ArchiveStructureRepository->getBywhere(['ttype' => 'archive_type']);
        $data['desk'] = $this->ArchiveStructureRepository->getBywhere(['ttype' => 'desk']);
        $data['secret_degree'] = $this->ArchiveStructureRepository->getBywhere(['ttype' => 'secret_degree']);

        // Flashing the toast message
        //  $request->session()->flash('toastMessage', 'تم اضافة القضية بنجاح');


        return view('dashbord.admin.cases.cases_morfqat', $data);
    }

    /****************************************************************************/
    public function case_add_files(FileRequest $request, $id)
    {

        try {
            $case = $this->ClientCasesRepository->getById($id);
            $case_model = new Cases();
            if ($request->hasFile('file')) {
                $files = $request->file('file');


                foreach ($files as $file) {
                    $dataX = $this->saveFile($file, 'case/' . $case->id);


                    $data['file'] = $dataX;
                    $data['file_name'] = $request->file_name;
                    $data['case_id_fk'] = $case->id;
                    $data['publisher'] = auth('admin')->user()->id;
                    $data['publisher_n'] = auth('admin')->user()->name;
                    $file = $this->CasesFilesRepository->create($data);
                    $data_file = save_archive_file($dataX, $request);
                    //dd($data_file);
                    $this->ArchiveFilesRepository->create($data_file);

                }

            }
            // notify()->success(translate('File_added_successfully'), '');
            // Flashing the toast message
            $request->session()->flash('toastMessage', translate('file_added_successfully'));
            return redirect()->route('admin.case_morfqat', $id);


        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /****************************************************************************/
    public function read_file($file_id)
    {

        try {
            $case_file = $this->CasesFilesRepository->getById($file_id);
            $file_path = Storage::disk('files')->path($case_file->file);
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
            $case_id = $archive->archive->related_entity_id;

            $this->ArchiveFilesRepository->delete($file_id);
            CaseFiles::where('file', $file)->where('case_id_fk', $case_id)->delete();

            DB::commit();

            $request->session()->flash('toastMessage', translate('File_deleted_successfully'));
            return redirect()->route('admin.case_morfqat', $case_id);
        } catch (\Exception $e) {
            DB::rollBack();
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /****************************************************************************/
    public function download_file($file_id)
    {
        try {
            $client_file = $this->ArchiveFilesRepository->getById($file_id);
            $file_path = Storage::disk('files')->path($client_file->file);
            $headers = [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $client_file->file_name . '"',
            ];
            return response()->download($file_path, $client_file->file_name, $headers);


        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /*******************************************************************************/
    public function payments(Cases $cases, $id)
    {
        $data['all_data'] = $cases->get_data_table_data($id)[0];
        $data['payment_data'] = $this->CasesPaymentRepository->getBywhere(array('case_id_fk' => $id))->toArray();
        return view('dashbord.admin.cases.cases_payments', $data);
    }

    /******************************************************************************/
    public function add_payments(Request $request, $id)
    {
        try {
            $request->validate([
                'notes' => 'required',
                'paid_date' => 'required',
                'paid_value' => 'required',
                'person_name' => 'required',
                'person_phone' => 'required',

            ]);

            $case = $this->ClientCasesRepository->getById($id);
            $casePayment = new CasePayments();
            $data = $casePayment->add_case_payment($request, $case);
            $this->CasesPaymentRepository->create($data);
            notify()->success(translate('payment_added_successfully'), '');
            return redirect()->route('admin.case_payments', $id);


        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /******************************************************************************/
    public function edit_payments($id)
    {
        $data['payments'] = $this->CasesPaymentRepository->getById($id);
        return view('dashbord.admin.cases.cases_payments_edit', $data);
    }

    /*******************************************************************************/
    public function update_payments(Request $request, $payment_id)
    {
        try {
            $request->validate([
                'notes' => 'required',
                'paid_date' => 'required',
                'paid_value' => 'required',
                'person_name' => 'required',
                'person_phone' => 'required',

            ]);
            $case_payment_data = $this->CasesPaymentRepository->getById($payment_id);
            $casePayment = new CasePayments();
            $data = $casePayment->update_case_payment($request);
            $this->CasesPaymentRepository->update($payment_id, $data);
            notify()->success(translate('payment_added_successfully'), '');
            return redirect()->route('admin.case_payments', $case_payment_data->case_id_fk);


        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /******************************************************************************/
    public function delete_payments(Request $request, $payment_id)
    {
        try {
            $case = $this->CasesPaymentRepository->getById($payment_id);
            $case_id = $case->case_id_fk;
            $this->CasesFilesRepository->delete($payment_id);

            notify()->error(translate('payemnt_deleted_successfully'), '');
            return redirect()->route('admin.case_payments', $case_id);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /******************************************************************************/
    public function tasks(Cases $cases, $id)
    {
        $data['all_data'] = $cases->get_data_table_data($id)[0];
        $data['priority'] = $this->GeneralSettingsRepository->getBywhere(array('ttype' => 'priority'));
        $data['emps'] = $this->EmployeeRepository->getAll();

        $tasks = new Tasks();
        $data['tasks_data'] = $tasks->get_tasks_data($id);
        // dd($data['tasks_data'] );
        return view('dashbord.admin.cases.cases_tasks', $data);
    }

    /*******************************************************************************/
    public function add_tasks(Request $request, $id)
    {
        try {
            $request->validate([
                'ensha_data' => 'required',
                'esnad_to' => 'required',
                'priority' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'details' => 'required',

            ]);
            $case = new Tasks();
            $data = $case->save_task_data($request, $id);
            $this->CasesTasksRepository->create($data);
            notify()->success(translate('tasks_added_successfully'), '');
            return redirect()->route('admin.case_tasks', $id);

        } catch (\Exception $e) {
            //test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /******************************************************************************/
    public function edit_tasks($id)
    {
        $data['priority'] = $this->GeneralSettingsRepository->getBywhere(array('ttype' => 'priority'));
        $data['emps'] = $this->EmployeeRepository->getAll();
        $data['tasks_data'] = $this->CasesTasksRepository->getById($id);
        return view('dashbord.admin.cases.cases_tasks_edit', $data);
    }

    /******************************************************************************/
    public function update_tasks(Request $request, $id)
    {
        try {
            $request->validate([
                'ensha_data' => 'required',
                'esnad_to' => 'required',
                'priority' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'details' => 'required',

            ]);
            $case = new Tasks();
            $data = $case->save_task_data($request, '');
            $this->CasesTasksRepository->update($id, $data);
            $case_id = $request->case_id;
            notify()->success(translate('tasks_added_successfully'), '');
            return redirect()->route('admin.case_tasks', $case_id);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /******************************************************************************/
    public function delete_tasks(Request $request, $task_id)
    {
        try {
            $case = $this->CasesTasksRepository->getById($task_id);
            $case_id = $case->case_id_fk;
            $this->CasesTasksRepository->delete($task_id);

            notify()->error(translate('tasks_deleted_successfully'), '');
            return redirect()->route('admin.case_tasks', $case_id);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /********************************************************************/
    public function case_add_archive(ArchiveCase_R $request, $case_id)
    {
        try {

            $archive_model = new Achive_m();
            $archive_data = $archive_model->save_case_archive($request, $case_id);
            $archive = $this->ArchiveRepository->create($archive_data);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.case_morfqat', $case_id);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**********************************************************************/
    /* public function sessions(Cases $cases,CaseSessions_M $caseSessions_M,$case_id)
     {
         $data['all_data']     =  $cases->get_data_table_data($case_id)[0];
         $data['emps']         =  $this->EmployeeRepository->getAll();
         $data['cases']        =  $this->ClientCasesRepository->getAll();
         $data['courts']       =  $this->CasesSettingRepository->getBywhere(array('ttype'=>'courts'));
         $data['session_data'] =  $caseSessions_M->get_sessions($case_id);
         return view('dashbord.admin.cases.cases_sessions',$data);
     }*/

    /****************************************************************/
    /* public function add_session(CaseSessions_R $request,CaseSessions_M $caseSessions_M,$case_id)
     {
         try {
             DB::beginTransaction();
             $data = $caseSessions_M->save_case_session($request);
             $data2 = $caseSessions_M->save_case_session_agenda($request);

             $caseSession = $this->CaseSessionRepository->create($data);
             $agenda = $this->AgendaRepository->create($data2);
             DB::commit();
             $request->session()->flash('toastMessage', translate('added_successfully'));
             return redirect()->route('admin.case_sessions', $case_id);
         } catch (\Exception $e) {

             DB::rollBack();
             test($e->getMessage());
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }

     }*/

    /*****************************************************/
    public function sessions(Cases $cases, CaseSessions_M $caseSessions_M, $case_id)
    {
        $data = $this->caseSessionService->getSessions($cases, $caseSessions_M, $case_id);
        return view('dashbord.admin.cases.cases_sessions', $data);
    }

    /**********************************************************************/
    public function add_session(CaseSessions_R $request, CaseSessions_M $caseSessions_M, $case_id)
    {
        $success = $this->caseSessionService->addSession($request, $caseSessions_M, $case_id);
        if ($success) {
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.case_sessions', $case_id);
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to add session']);
        }
    }

    /**********************************************************************/
    public function edit_session(Cases $cases, CaseSessions_M $caseSessions_M, $session_id)
    {
        $data = $this->caseSessionService->editSessions($cases, $caseSessions_M, $session_id);
        return view('dashbord.admin.cases.sessions_edit', $data);
    }

    /*********************************************************************/
    public function update_session(CaseSessions_R $request, CaseSessions_M $caseSessions_M, $session_id)
    {
//        dd($request);
        $success = $this->caseSessionService->updateSession($request, $caseSessions_M, $session_id);
        $case_id = $this->CaseSessionRepository->getById($session_id)->case_id;
        if ($success) {
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.case_sessions', $case_id);
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to add session']);
        }
    }

    /*********************************************************************/
    public function delete_session(Request $request, $session_id)
    {
        // dd($session_id);
        $case_id = $this->CaseSessionRepository->getById($session_id)->case_id;
        $success = $this->caseSessionService->deletesession($session_id);
        if ($success) {
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.case_sessions', $case_id);
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to add session']);
        }
    }

    /*****************************************************************/
    public function session_results($session_id)
    {
        $data['session_data'] = $this->caseSessionService->session_results($session_id);
        return view('dashbord.admin.cases.sessions_results', $data);
    }

    /*****************************************************************/
    public function update_session_results(Request $request, CaseSessions_M $caseSessions_M, $session_id)
    {
        $success = $this->caseSessionService->updateSessionResults($request, $caseSessions_M, $session_id);
        $case_id = $this->CaseSessionRepository->getById($session_id)->case_id;
        if ($success) {
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.case_sessions', $case_id);
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to add session']);
        }
    }

    /****************************************************************/
    public function mo7dareen(Cases $cases, $case_id)
    {
        $data['all_data'] = $cases->get_data_table_data($case_id)[0];
        $data['emps'] = $this->EmployeeRepository->getAll();
        $data['mo7dareen_data'] = $this->CaseMo7dareen->getAll();
        return view('dashbord.admin.cases.mo7dareen.mo7dareen', $data);
    }

    /***************************************************************/
    public function add_mo7dareen(AddMo7dareenRequest $request, $id)
    {
        try {
            //dd($request);
            $validatedData = $request->validated();
            $validatedData['case_id'] = $id;
            $validatedData['created_by'] = auth()->user()->id;
            // dd($validatedData);
            $mo7dareen = $this->CaseMo7dareen->create($validatedData);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.case_mo7dareen', $id);


        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /***************************************************************/
    public function case_edit_mo7dareen($id)
    {
        $data['emps'] = $this->EmployeeRepository->getAll();
        $data['mo7dareen_data'] = $this->CaseMo7dareen->getById($id);
        return view('dashbord.admin.cases.mo7dareen.mohdareen_edit', $data);
    }
    /***************************************************************/
    public function update_mo7dareen(AddMo7dareenRequest $request, $id)
    {
        try {
            //dd($request);
            $validatedData = $request->validated();
            $validatedData['updated_by'] = auth()->user()->id;
            // dd($validatedData);
            $this->CaseMo7dareen->update($id,$validatedData);
            $mo7dareen=$this->CaseMo7dareen->getById($id);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.case_mo7dareen', $mo7dareen->case_id);


        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /***************************************************************/
    public function delete_mo7dareen(Request $request,$id)
    {
        try {
            $mo7dareen = $this->CaseMo7dareen->getById($id);
            $case_id = $mo7dareen->case_id_fk;
            $this->CaseMo7dareen->delete($id);

            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.case_mo7dareen', $case_id);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************************/
    public function kafalate(Cases $cases, $case_id)
    {
        $data['all_data'] = $cases->get_data_table_data($case_id)[0];
        $data['kafalate_data'] = $this->CaseKafalate->getAll();
        return view('dashbord.admin.cases.kafalate.index', $data);
    }
    /***************************************************************/
    public function add_kafalate(AddCasesKafalateRequest $request, $id)
    {
        try {
          //  dd($request);
            $validatedData = $request->validated();
            $validatedData['case_id'] = $id;
            $validatedData['created_by'] = auth()->user()->id;
            // dd($validatedData);
            $mo7dareen = $this->CaseKafalate->create($validatedData);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.case_kafalate', $id);


        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /***************************************************************/
    public function edit_kafalate($id)
    {
        $data['kafalate_data'] = $this->CaseKafalate->getById($id);
        return view('dashbord.admin.cases.kafalate.edit', $data);
    }
    /***************************************************************/
    public function update_kafalate(AddCasesKafalateRequest $request, $id)
    {
        try {
            //dd($request);
            $validatedData = $request->validated();
            $validatedData['updated_by'] = auth()->user()->id;
            // dd($validatedData);
            $this->CaseKafalate->update($id,$validatedData);
            $mo7dareen=$this->CaseKafalate->getById($id);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.case_kafalate', $mo7dareen->case_id);


        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /***************************************************************/
    public function delete_kafalate(Request $request,$id)
    {
        try {
            $mo7dareen = $this->CaseKafalate->getById($id);
            $case_id = $mo7dareen->case_id_fk;
            $this->CaseKafalate->delete($id);

            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.case_kafalate', $case_id);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
