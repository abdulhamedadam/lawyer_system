<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Archive\Achive_m;
use App\Services\DuesService;
use Illuminate\Http\Request;
use App\Interfaces\BasicRepositoryInterface;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use App\Http\Requests\Admin\Clients\ClientsStoreRequest;
use App\Http\Requests\Admin\FileRequest;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\Cases;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\Cleints;
use App\Models\Admin\CleintsFile;
use App\Models\Admin\ClientNotes;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Employees;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\LegalServices\LegalServicesRquest;
use App\Models\Admin\LegalServices;
//C:\laragon\www\lawyer\app\Models\Admin\LegalServices.php


class LegalServicesController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;


    protected $GeneralSettingRepository;
    protected $CasesSettingRepository;
    protected $AreasSettingRepository;
    protected $ClientRepository;
    protected $ClientFileRepository;
    protected $ClientCasesRepository;
    protected $ClientNotesRepository;
    protected $CaseSettingsRepository;
    protected $EmployessRepository;
    protected $LegalServicesRepository;


    public function __construct(BasicRepositoryInterface $basicRepository ,DuesService $duesService)
    {
        $this->GeneralSettingRepository = createRepository($basicRepository, new GeneralSetting());
        $this->AreasSettingRepository   = createRepository($basicRepository, new AreaSetting());
        $this->ClientRepository         = createRepository($basicRepository, new Cleints());
        $this->ClientFileRepository     = createRepository($basicRepository, new CleintsFile());
        $this->CasesSettingRepository   = createRepository($basicRepository, new CaseSettings());
        $this->ClientCasesRepository    = createRepository($basicRepository, new Cases());
        $this->ClientNotesRepository    = createRepository($basicRepository, new ClientNotes());
        $this->CaseSettingsRepository   = createRepository($basicRepository, new CaseSettings());
        $this->EmployessRepository      = createRepository($basicRepository, new Employees());
        $this->LegalServicesRepository  = createRepository($basicRepository, new LegalServices());
        $this->duesService              = $duesService;
    }
    /************************************************************************/
    public function index(){
        return view('dashbord.admin.legal_services.legal_services_data');
    }
    /************************************************************************/
    public function get_ajax_lagal_services(Request $request){

        if ($request->ajax()) {
            $data = DB::table('tbl_legal_services')
                ->select('tbl_legal_services.*', 't2.name', 't3.title', 't4.employee as employee_name')
                ->join('tbl_clients as t2', 'tbl_legal_services.client_name', '=', 't2.id')
                ->join('tbl_cases_settings as t3', 'tbl_legal_services.type_of_service', '=', 't3.id')
                ->join('employees as t4', 'tbl_legal_services.esnad_to', '=', 't4.id')
                ->orderBy('tbl_legal_services.id', 'desc') // Order by the primary key (id) in descending order
                ->get();


            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('client_name', function ($row) {

                    return  $row->name;
                })
                ->addColumn('type_of_service', function ($row) {
                    return $row->title;
                })
                ->addColumn('esnad_to', function ($row) {
                    return $row->employee_name;;
                })
                ->addColumn('cost_of_service', function ($row) {
                    return $row->cost_of_service;;
                })
                ->addColumn('notes', function ($row) {
                    return $row->notes;;
                })
                ->addColumn('action', function ($row) {
                    return '
<div class="btn-group">
    <button style="font-size: 16px" type="button" class="btn btn-sm btn-secondary">'.translate('actions').'</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
        <li><a class="hover-effect dropdown-item" target="_blank" href="'.route('admin.edit_legal_services', $row->id).'"><i class="bi bi-info-circle-fill"></i> ' . translate('edit') . '</a></li>
        <li>
            <form action="'.route('admin.delete_legal_services', $row->id).'" method="POST">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" onclick="return confirm(\''.__('Are You Sure To Delete?').'\')" class="hover-effect dropdown-item"><i class="bi bi-trash-fill"></i> '.translate('delete').'</button>
            </form>
        </li>
        <li><a class="hover-effect dropdown-item" target="_blank" href="'.route('admin.legal_service_morfqat', $row->id).'"><i class="bi bi-paperclip"></i> '.translate('files').'</a></li>
        <li><a class="hover-effect dropdown-item" target="_blank" href="'.route('admin.legal_service_payments', $row->id).'"><i class="bi bi-cash"></i> '.translate('case_payments').'</a></li>

    </ul>
</div>';



                })->rawColumns(['image', 'action', 'client_name', 'related_lawsuits'])
                ->make(true);

            return $dataTable->toJson();
        }

    }
    /************************************************************************/
    public function create(){
        $data['clients_names'] = $this->ClientRepository->getAll();
        $data['types_of_services'] = $this->CaseSettingsRepository->getBywhere(array('ttype' => 'legal_service'));
        $data['all_employees'] = $this->EmployessRepository->getAll();
        return view('dashbord.admin.legal_services.legal_services_form', $data);
    }

    /************************************************************************/
    public function store(LegalServicesRquest $request,LegalServices $legalServices){

        try{
         $insert_data=$legalServices->add_service_data($request);
        $legal_services = $this->LegalServicesRepository->create($insert_data);
        $this->duesService->SaveDues('legal_service',$request->cost_of_service,$legal_services->id,$request->client_name);
        $request->session()->flash('toastMessage', translate('added_successfully'));
        return redirect()->route('admin.index_legal_services');
        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /************************************************************************/
    public function edit($id){
        $data['clients_names'] = $this->ClientRepository->getAll();
        $data['types_of_services'] = $this->CaseSettingsRepository->getBywhere(array('ttype' => 'legal_service'));
        $data['all_employees'] = $this->EmployessRepository->getAll();
        $data['all_data'] = $this->LegalServicesRepository->getById($id);
        return view('dashbord.admin.legal_services.legal_services_edit', $data);
    }
    /************************************************************************/
    public function update(LegalServicesRquest $request,LegalServices $legalServices,$id){

        try{
            $insert_data     = $legalServices->add_service_data($request);
            $legal_services  = $this->LegalServicesRepository->update($id,$insert_data);
            $this->duesService->updateDues('legal_service',$request->cost_of_service,$id,$request->client_name);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.index_legal_services');
        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /************************************************************************/
    public function delete(Request $request,$id)
    {
        try{
            $this->LegalServicesRepository->delete($id);
            $this->duesService->DeleteDues('legal_service',$id);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.index_legal_services');
        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /***********************************************************************/

    public function morfqat(Request $request, Cases $cases, $id)
    {
        $data['all_data'] = $cases->get_data_table_data($id)[0];
        $archive = $this->ArchiveRepository->getBywhere(array('related_folder' => 1, 'related_entity_id' => $id));
        $data['archive'] = $archive;

        if ($archive->isNotEmpty()) {
            $data['files_data'] = $this->ArchiveFilesRepository->getBywhere(array('archive_id' => $archive[0]->id));
            $archive_model      = new Achive_m();
            $data['archive_data']    =$archive_model->get_archive_data($id,1)[0];

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


}
