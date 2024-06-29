<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cases\CasesStoreRequest;
use App\Http\Requests\Admin\Clients\ClientsStoreRequest;
use App\Http\Requests\Admin\FileRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Archive\Achive_m;
use App\Models\Admin\Archive\AchiveFiles_m;
use App\Models\Admin\Archive\ArchiveSettings;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\CasePayments;
use App\Models\Admin\Cases;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\Cleints;
use App\Models\Admin\CleintsFile;
use App\Models\Admin\ClientNotes;
use App\Models\Admin\GeneralSetting;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class Clients extends Controller
{

    use ImageProcessing;
    use ValidationMessage;

    /*---------------------------------------------------*/

    protected $GeneralSettingRepository;
    protected $CasesSettingRepository;
    protected $AreasSettingRepository;
    protected $ClientRepository;
    protected $ClientFileRepository;
    protected $ClientCasesRepository;
    protected $ClientNotesRepository;
    protected $ArchiveRepository;
    protected $ArchiveFilesRepository;
    protected $ArchiveStructureRepository;


    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->ArchiveRepository          = createRepository($basicRepository, new Achive_m());
        $this->ArchiveFilesRepository     = createRepository($basicRepository, new AchiveFiles_m());
        $this->ArchiveStructureRepository = createRepository($basicRepository, new ArchiveSettings());
        $this->CasesSettingRepository   = createRepository($basicRepository, new CaseSettings());
        $this->GeneralSettingRepository = createRepository($basicRepository, new GeneralSetting());
        $this->AreasSettingRepository   = createRepository($basicRepository, new AreaSetting());
        $this->ClientRepository         = createRepository($basicRepository, new Cleints());
        $this->ClientFileRepository     = createRepository($basicRepository, new CleintsFile());
        $this->CasesSettingRepository   = createRepository($basicRepository, new CaseSettings());
        $this->ClientCasesRepository    = createRepository($basicRepository, new Cases());
        $this->ClientNotesRepository    = createRepository($basicRepository, new ClientNotes());
        $this->CasesPaymentRepository   = createRepository($basicRepository, new CasePayments());

    }

    /***************************************************************************/
    public function index()
    {
        return view('dashbord.admin.clients.clients_data');
    }
    /***************************************************************************/
    public function get_ajax_clients(Request $request,Cleints $cleints)
    {
        if ($request->ajax()) {
            //$data = $this->ClientRepository->getAll();


            $data =$cleints->get_data_table();
            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('client_name', function ($row) {

                    return  $row->name;
                })
                ->addColumn('phone_number', function ($row) {
                    // Return the phone number with a green phone icon
                    return '<span><i class="bi bi-telephone fs-1x text-success"></i>'.$row->phone_number.'</span>  ' ;
                })

                ->addColumn('current_address', function ($row) {
                    return $row->current_address;;
                })
                ->addColumn('job_title', function ($row) {
                    return $row->job;;
                })
                ->addColumn('national_id', function ($row) {
                    return $row->national_id;;
                })
                ->addColumn('related_lawsuits', function ($row) {

                    return '<span style="background-color: lightblue ; " class="span_data_table">'.$row->case_count.'</span>';
                })
                ->addColumn('total_financial_dues', function ($row) {

                    return '<span style="background-color: lightgreen ; " class="span_data_table">'.get_all_fees($row->id).'</span>'.' '.get_currency();
                })
                ->addColumn('total_paid', function ($row) {

                    return '<span style="background-color:  lightgoldenrodyellow; " class="span_data_table">'.get_all_paid($row->id).'</span>'.' '.get_currency();
                })
                ->addColumn('remain', function ($row) {

                    return '<span style="background-color: lightcoral ; " class="span_data_table">'.(get_all_fees($row->id)-get_all_paid($row->id)).'</span>'.' '.get_currency();
                })
                ->addColumn('action', function ($row) {
                    return '
<div class="btn-group">
    <button style="font-size: 16px" type="button" class="btn btn-sm btn-secondary">'.translate('actions').'</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">

        <li><a  class="hover-effect dropdown-item" target="_blank" href="' . route('admin.show_edit_form', $row->id) . '"><i class="bi bi-info-circle-fill"></i> ' . translate('edit') . '</a></li>
        <li><a  class="hover-effect dropdown-item" target="_blank" href="' . route('admin.delete_client', $row->id) . '"><i class="bi bi-trash-fill"></i> ' . translate('delete') . '</a></li>
        <li><a  class="hover-effect dropdown-item" target="_blank" href="' . route('admin.morfqat', $row->id) . '" ><i class="bi bi-paperclip"></i> ' . translate('files') . '</a></li>
        <li><a  class="hover-effect dropdown-item" target="_blank" href="'.route('admin.payments',$row->id).'"><i class="bi bi-cash"></i> ' . translate('cases') . '</a></li>
        <li><a  class="hover-effect dropdown-item" target="_blank" href="'.route('admin.case_tasks',$row->id).'"><i class="bi bi-list-task"></i> ' . translate('money_paid') . '</a></li>
    </ul>
</div>';


                })->rawColumns(['image', 'action', 'client_name', 'related_lawsuits','phone_number','total_financial_dues','total_paid','remain'])
                ->make(true);

            return $dataTable->toJson();
        }
    }


    /***************************************************************************/
    public function add_client()
    {
        $data['gender'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'gender'));
        $data['material_status'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'material_status'));
        $data['religions'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'religion'));
        $data['nationalites'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'nationality'));
        $data['jobs'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'jobs'));
        $data['governates'] = $this->AreasSettingRepository->getBywhere(array('from_id' => 0));
        return view('dashbord.admin.clients.clients_form', $data);
    }

    /***************************************************************************/
    public function save_client(ClientsStoreRequest $request)
    {
        try {
           // dd($request);
            $insert_data['name'] = $request->client_name;
            $insert_data['nationality_id'] = $request->nationality_id;
            $insert_data['national_id'] = $request->national_id;
            $insert_data['gender'] = $request->gender;
            $insert_data['date_of_birth_st'] = $request->date_of_barth;
            $insert_data['date_of_birth_ar'] = $request->date_of_barth;
            $insert_data['place_of_birth'] = $request->place_of_barth;
            $insert_data['current_address'] = $request->current_address;
           // $insert_data['religion'] = $request->religion;
            $insert_data['material_status'] = $request->marital_status;
            $insert_data['job_title'] = $request->job_title;
            $insert_data['work_place'] = $request->work_place;
            $insert_data['phone_number'] = $request->phone_number;
            $insert_data['whats_number'] = $request->whats_number;
            $insert_data['governate_id'] = $request->governate_id;
            $insert_data['city_id'] = $request->city_id;
            $insert_data['region_id'] = $request->region;

            $client = $this->ClientRepository->create($insert_data);
            if ($client instanceof Model) {
                // drakify('success');
                notify()->success(translate('Client_added_successfully'), '');
                //emotify('success', translate('data_added_successfully'));
                return redirect()->route('admin.clients_data');
            }
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }


    /***************************************************************************/
    public function get_city_list($id)
    {
        $data['all_data'] = $this->AreasSettingRepository->getBywhere(array('from_id' => $id));
        return view('dashbord.admin.clients.load_city_select', $data);
    }

    /***************************************************************************/
    public function show_edit_form($id)
    {
        $data['gender'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'gender'));
        $data['material_status'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'material_status'));
        $data['religions'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'religion'));
        $data['nationalites'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'nationality'));
        $data['jobs'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'jobs'));
        $data['governates'] = $this->AreasSettingRepository->getBywhere(array('from_id' => 0));
        $data['all_data'] = $this->ClientRepository->getById($id);
        return view('dashbord.admin.clients.clients_edit', $data);
    }

    /****************************************************************************/
    public function update_client(ClientsStoreRequest $request, $id)
    {
        try {
            //dd($request);
            $insert_data['name'] = $request->client_name;
            $insert_data['nationality_id'] = $request->nationality_id;
            $insert_data['national_id'] = $request->national_id;
            $insert_data['gender'] = $request->gender;
            $insert_data['date_of_birth_st'] = $request->date_of_barth;
            $insert_data['date_of_birth_ar'] = $request->date_of_barth;
            $insert_data['place_of_birth'] = $request->place_of_barth;
            $insert_data['current_address'] = $request->current_address;
            $insert_data['religion'] = $request->religion;
            $insert_data['marital_status'] = $request->marital_status;
            $insert_data['job_title'] = $request->job_title;
            $insert_data['work_place'] = $request->work_place;
            $insert_data['phone_number'] = $request->phone_number;
            $insert_data['whats_number'] = $request->whats_number;
            $insert_data['governate_id'] = $request->governate_id;
            $insert_data['city_id'] = $request->city_id;
            $insert_data['region'] = $request->region;
            $client = $this->ClientRepository->update($id, $insert_data);

            if ($client) {
                notify()->success(translate('Client_updated_successfully'), '');
                return redirect()->route('admin.clients_data');
            } else {
                return redirect()->route('admin.clients_data');
            }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /****************************************************************************/
    public function delete_client(Request $request, $id)
    {

        dd($id);


        try {
            $this->ClientRepository->delete($id);
            $request->session()->flash('toastMessage', translate('File_deleted_successfully'));
            return redirect()->route('admin.clients_data');


        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************************************/
    public function morfqat(Cleints $cleints, $id)
    {
        $data['all_data']     = $cleints->get_client_data($id);
        $archive = $this->ArchiveRepository->getBywhere(array('related_folder' => 2, 'related_entity_id' => $id));
        //dd($archive);
        $data['archive'] = $archive;

        if ($archive->isNotEmpty()) {
            $data['files_data'] = $this->ArchiveFilesRepository->getBywhere(array('archive_id' => $archive[0]->id));
            $archive_model      = new Achive_m();
            $data['archive_data']    =$archive_model->get_archive_data($id,2)[0];

        } else {
            $data['files_data'] = [];
        }

        $data['types'] = $this->ArchiveStructureRepository->getBywhere(['ttype' => 'archive_type']);
        $data['desk'] = $this->ArchiveStructureRepository->getBywhere(['ttype' => 'desk']);
        $data['secret_degree'] = $this->ArchiveStructureRepository->getBywhere(['ttype' => 'secret_degree']);
        //dd($data);
        return view('dashbord.admin.clients.clients_attachments', $data);
    }

    /****************************************************************************/
    public function add_files(FileRequest $request, $id)
    {

        try {
            $client = $this->ClientRepository->getById($id);
            if ($request->hasFile('file')) {
                $files = $request->file('file');


                foreach ($files as $file){
                    $dataX = $this->saveFile($file, $client->id);

                    $data['file']         = $dataX;
                    $data['file_name']    = $request->file_name;
                    $data['client_id_fk'] = $client->id;
                    $data['publisher']    = auth('admin')->user()->id;
                    $data['publisher_n']  = auth('admin')->user()->name;

                    $file                 = $this->ClientFileRepository->create($data);
                    $data_file  = save_archive_file($dataX,$request);
                    //dd($data_file);
                    $this->ArchiveFilesRepository->create($data_file);

                }

            }
            $request->session()->flash('toastMessage', translate('file_added_successfully'));
                return redirect()->route('admin.morfqat',$id);




        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }
    /****************************************************************************/
    public function read_file($file_id)
    {

        try {
            $client_file=$this->ClientFileRepository->getById($file_id);
            $file_path = Storage::disk('files')->path($client_file->file);
            $fileContent = Storage::get($file_path);
            return response()->file($file_path);



        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /****************************************************************************/
    public function delete_file(Request $request,$file_id)
    {
        try {
             $client=$this->ClientFileRepository->getById($file_id);
             $client_id=$client->client_id_fk;
           //  dd($client_id);
             $this->ClientFileRepository->delete($file_id);

            $request->session()->flash('toastMessage', translate('File_deleted_successfully'));
            return redirect()->route('admin.morfqat',$client_id);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /****************************************************************************/
    public function download_file($file_id)
    {
        try {
        $client_file=$this->ClientFileRepository->getById($file_id);
        $file_path = Storage::disk('files')->path($client_file->file);
            $headers = [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $client_file->file . '"',
            ];
            return response()->download($file_path);



        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /****************************************************************************/
    /**************************************************************************/
    public function payments(Cleints $cleints, $id)
    {
        $data['all_data']            =  $cleints->get_client_data($id);
        $data['payment_data']         =   $this->CasesPaymentRepository->getBywhere(array('client_id_fk'=>$id))->toArray();
        return view('dashbord.admin.clients.client_payments_data', $data);
    }
    /****************************************************************************/
    public function relatedCases(Cleints $cleints, $id)
    {
        $case_model                  =  new Cases();
        $data['all_data']            =  $cleints->get_client_data($id);
        $data['files_data']          =  $this->ClientFileRepository->getBywhere(array('client_id_fk'=>$id));
        $data['clients']             =  $this->ClientRepository->getAll();
        $data['case_num']            =  $case_model->get_next_case_num();
        $data['case_type']           =  $this->CasesSettingRepository->getBywhere(array('ttype'=>'case_type'));
        $data['courts']              =  $this->CasesSettingRepository->getBywhere(array('ttype'=>'courts'));
        $data['case_status']         =  $this->CasesSettingRepository->getBywhere(array('ttype'=>'case_status'));
        $data['all_clients_cases']   =  $case_model->all_client_cases($id);
     //  dd($data['all_clients_cases']);

        return view('dashbord.admin.clients.clients_cases', $data);
    }
    /******************************************************************************/
    public function save_client_case(CasesStoreRequest $request,Cases $cases,$id)
    {
        try {
            // dd($request);

            $insert_data                 =  $cases->insert_data($request);
            $case = $this->ClientCasesRepository->create($insert_data);
            if ($case instanceof Model) {
                $request->session()->flash('toastMessage', translate('Case_added_successfully'));
                return redirect()->route('admin.relatedCases',$id);
            }
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

   /******************************************************************************/
    public function notes(Cleints $cleints,$id)
    {
        $data['all_data']     = $cleints->get_client_data($id);
        $data['notes_data']   = $this->ClientNotesRepository->getAll();
        return view('dashbord.admin.clients.clients_notes', $data);
    }
    /****************************************************************************/
    public function add_notes(Request $request,$id)
    {
        try {
            $client = $this->ClientRepository->getById($id);
            $request->validate([
                'notes' => 'required|string|max:255',

            ]);
            $notes  = new ClientNotes();
            $data   = $notes->add_notes($request,$id);
            $this->ClientNotesRepository->create($data);
            notify()->success(translate('notes_added_successfully'), '');
            return redirect()->route('admin.notes',$id);




        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


}
