<?php


namespace App\Services;


use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Models\Admin\Agenda_M;
use App\Models\Admin\Archive\Achive_m;
use App\Models\Admin\Archive\AchiveFiles_m;
use App\Models\Admin\Archive\ArchiveSettings;
use App\Models\Admin\CaseFiles;
use App\Models\Admin\CasePayments;
use App\Models\Admin\Cases;
use App\Models\Admin\CaseSessions_M;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\Cleints;
use App\Models\Admin\Employees;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Tasks;
use Illuminate\Support\Facades\DB;

class CaseSessionService
{
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

    public function __construct(BasicRepositoryInterface $basicRepository)
    {

        $this->ClientRepository         = createRepository($basicRepository, new Cleints());
        $this->ArchiveRepository        = createRepository($basicRepository, new Achive_m());
        $this->ArchiveFilesRepository  = createRepository($basicRepository, new AchiveFiles_m());
        $this->ArchiveStructureRepository = createRepository($basicRepository, new ArchiveSettings());
        $this->CasesSettingRepository   = createRepository($basicRepository, new CaseSettings());
        $this->ClientCasesRepository    = createRepository($basicRepository, new Cases());
        $this->CasesFilesRepository     = createRepository($basicRepository, new CaseFiles());
        $this->CasesPaymentRepository   = createRepository($basicRepository, new CasePayments());
        $this->CasesTasksRepository     =  createRepository($basicRepository, new Tasks());
        $this->GeneralSettingsRepository= createRepository($basicRepository, new GeneralSetting());
        $this->EmployeeRepository     = createRepository($basicRepository, new Employees());
        $this->CaseSessionRepository  = createRepository($basicRepository, new CaseSessions_M());
        $this->AgendaRepository  = createRepository($basicRepository, new Agenda_M());

    }
    /********************************************************************************/
    public function getSessions($cases, $caseSessions_M, $case_id=null)
    {
        if($case_id !=null)
        {
            $data['all_data'] = $cases->get_data_table_data($case_id)[0];
        }

        $data['emps'] = $this->EmployeeRepository->getAll();
        $data['cases'] = $this->ClientCasesRepository->getAll();
        $data['courts'] = $this->CasesSettingRepository->getBywhere(array('ttype' => 'courts'));
        $data['session_data'] = $caseSessions_M->get_sessions($case_id);
        return $data;
    }
    /********************************************************************************/
    public function addSession($request, $caseSessions_M)
    {
        try {
            DB::beginTransaction();
            $data = $caseSessions_M->save_case_session($request);
            $caseSession = $this->CaseSessionRepository->create($data);
            $data2 = $caseSessions_M->save_case_session_agenda($request,$caseSession->id);
            $agenda = $this->AgendaRepository->create($data2);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    /********************************************************************************/
    public function editSessions($cases, $caseSessions_M, $session_id)
    {
        $data['emps']         = $this->EmployeeRepository->getAll();
        $data['cases']        = $this->ClientCasesRepository->getAll();
        $data['courts']       = $this->CasesSettingRepository->getBywhere(array('ttype' => 'courts'));
        $data['session_data'] = $caseSessions_M->get_sessions_by_id($session_id);
        return $data;
    }

    /******************************************************************************/
    public function updateSession($request, $caseSessions_M, $session_id)
    {
        try {
            DB::beginTransaction();
            $data = $caseSessions_M->save_case_session($request);
            $data2 = $caseSessions_M->save_case_session_agenda($request,$session_id);

            $caseSession = $this->CaseSessionRepository->update($session_id,$data);
            $agenda=$this->AgendaRepository->updateWhere(array('category'=>'session','related_id'=>$session_id),$data2);
           // $agenda = $this->AgendaRepository->create($data2);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /****************************************************************************/
    public function deletesession($session_id)
    {
        try {
            DB::beginTransaction();
            $this->CaseSessionRepository->delete($session_id);
             $this->AgendaRepository->deleteWhere(array('category'=>'session','related_id'=>$session_id));
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /***********************************************************************/
    public function session_results($session_id)
    {
        $data=$this->CaseSessionRepository->getById($session_id);
        return $data;
    }
    /***********************************************************************/
    public function updateSessionResults($request, $caseSessions_M, $session_id)
    {
        try {
            $data['session_results']=$request->session_results;
            $caseSession = $this->CaseSessionRepository->update($session_id,$data);

            return true;
        } catch (\Exception $e) {

            return false;
        }
    }

}
