<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\task\EstlamTaskRequest;
use App\Http\Requests\Admin\task\ExtendDateRequest;
use App\Http\Requests\Admin\task\TakeemTaskRequest;
use App\Http\Requests\Admin\task\TaskCommentsRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\Cases;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\Cleints;
use App\Models\Admin\Agenda_M;
use App\Models\Admin\CleintsFile;
use App\Models\Admin\ClientNotes;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Tasks;
use App\Models\Admin\TaskComments;
use App\Models\Admin\TaskFiles;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Carbon\Carbon;
use DataTables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /*---------------------------------------------------*/

    protected $GeneralSettingRepository;
    protected $ClientRepository;
    protected $ClientCasesRepository;
    protected $AdminUsersRepository;
    protected $CasesTasksRepository;
    protected $TasksCommentsRepository;
    protected $TasksFilesRepository;
    protected $AgendaRepository;


    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->GeneralSettingRepository = createRepository($basicRepository, new GeneralSetting());
        $this->ClientRepository         = createRepository($basicRepository, new Cleints());
        $this->ClientCasesRepository    = createRepository($basicRepository, new Cases());
        $this->AdminUsersRepository     = createRepository($basicRepository, new Admin());
        $this->CasesTasksRepository     = createRepository($basicRepository, new Tasks());
        $this->TasksCommentsRepository  = createRepository($basicRepository, new TaskComments());
        $this->TasksFilesRepository     = createRepository($basicRepository, new TaskFiles());
        $this->AgendaRepository     = createRepository($basicRepository, new Agenda_M());
    }

    /*************************************************************/
    public function index()
    {

        $data['priority']     =  $this->GeneralSettingRepository->getBywhere(array('ttype'=>'priority'));
        $data['emps']         =  $this->AdminUsersRepository->getAll();
        $data['cases']        =  $this->ClientCasesRepository->getAll();
        $case_model                  =  new Cases();
        $data['clients']             =  $this->ClientRepository->getAll();
        $data['case_num']            =  $case_model->get_next_case_num();
        $data['case_type']           =  $this->GeneralSettingRepository->getBywhere(array('ttype'=>'priority'));
        $data['courts']              =  $this->GeneralSettingRepository->getBywhere(array('ttype'=>'priority'));
        $data['case_status']         =  $this->GeneralSettingRepository->getBywhere(array('ttype'=>'priority'));
        $data['type']                = 'create';
        //dd($data['emps']);
        return view('dashbord.admin.tasks.tasks_form',$data);
    }

    /***********************************************************/
    public function add_task(Request $request ,Tasks $tasks)
    {
        try {
            $request->validate([
                'ensha_data' => 'required',
                'esnad_to'   => 'required',
                'priority'   => 'required',
                'start_date' => 'required',
                'end_date'   => 'required',
                'details'    => 'required',
                // 'case_id'    => 'required',

            ]);
            $data     = $tasks->save_task_data($request);
            $task=$this->CasesTasksRepository->create($data);
            $data2 = $tasks->save_task_agenda($request,$task->id);
            $this->AgendaRepository->create($data2);
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.all_task_data');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /***********************************************************/
    public function all_tasks($type=null)
    {
        $data['type']    = 'all';
        return view('dashbord.admin.tasks.tasks_data',$data);
    }
    /**********************************************************/
    public function doing_tasks()
    {
        $data['type']    = 'doing';
        return view('dashbord.admin.tasks.tasks_doing',$data);
    }
    /*********************************************************/
    public function done_tasks()
    {
        $data['type']    = 'done';
        return view('dashbord.admin.tasks.tasks_done',$data);
    }
    /***********************************************************/
    public function wared_tasks($type=null)
    {
        $data['type']    = 'wared';
        return view('dashbord.admin.tasks.tasks_wared_data',$data);
    }
    /*****************************************************************************/
    public function sader_tasks($type=null)
    {
        $data['type']    = 'sader';
        return view('dashbord.admin.tasks.tasks_sader_data',$data);
    }
    /*****************************************************************************/
    public function delayed_tasks($type=null)
    {
        $data['type']    = 'delayed';
        return view('dashbord.admin.tasks.tasks_delayed_data',$data);
    }
    /****************************************************************************/
    public function cancelled_tasks($type=null)
    {
        $data['type']    = 'cancelled';
        return view('dashbord.admin.tasks.tasks_cancelled_data',$data);
    }
    /***************************************************************************/
    public function evaluate_tasks($type=null)
    {
        $data['type']    = 'evaluate';
        return view('dashbord.admin.tasks.tasks_evaluate_data',$data);
    }
    /***************************************************************************/
    public function needReply_tasks($type=null)
    {
        $data['type']    = 'needReply';
        return view('dashbord.admin.tasks.tasks_needReply_data',$data);
    }
    /***************************************************************************/
    public function get_ajex_all_tasks(Request $request)
    {
        //dd($request);
        if ($request->ajax()) {
            $tasks  =new Tasks();
            $user_id = auth()->user()->id;
            if(auth('admin')->user()->role_id_fk == 1)
            {
                $data    = $tasks->data_table('','','','','','','');
            }else
            {

            $data    = $tasks->data_table('','','','','',$user_id,'');
            }
            //test($data);
            $counter = 0;

            return DataTables::of($data)

                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('case_name', function ($row) {

                    return $row->case_name;
                })
                ->addColumn('ensha_date', function ($row) {
                    $icon = '<i class="fas fa-user"></i>';
                    return $row->ensha_date;
                })
                ->addColumn('task_type', function ($row) {
                    $task_type = [
                        $row->from_user_id => '<span style="background-color: lightgreen ; " class="span_data_table">' . translate('outcomming') . '</span>',
                        $row->to_user_id => '<span style="background-color: lightcoral ; " class="span_data_table">' . translate('incomming') . '</span>',
                    ];
                    return $task_type[auth()->user()->id];
                })
                ->addColumn('task_name', function ($row) {
                    return $row->task_name;;
                })
                ->addColumn('priority', function ($row) {
                    return '<span style="background-color: ' . $row->priority_color . ' ; " class="span_data_table">' . $row->priority . '</span>';
                })

                ->addColumn('employee', function ($row) {

                    return '<span style="color:green"> من / ' . $row->from_emp_name . '</span><br/><span style="color:blue">إلي / ' . $row->to_emp_name . '<span>';
                })
                ->addColumn('date', function ($row) {
                    return  '<span style="color:green"> من / ' . $row->start_date . '</span><br/><span style="color:red">إلي / ' . $row->end_date . '<span>';
                })
                ->addColumn('peroid', function ($row) {

                    return Diff_Days($row->start_date, $row->end_date) . '<br>' .
                        ($row->end_date) . '</span>';

                })
                ->addColumn('assigned_to', function ($row) {
                    return '<div class="user-block">
                                 <img class="img-thumbnail rounded-circle" src="" alt="user image">
                                 <span class="username" style="color:green">' . $row->to_emp_name . '</span>
                                 <span class="text-danger">at ' . Carbon::parse($row->created_at)->format('H:i:s') . '</span>
                            </div>';

                })
                ->addColumn('action', function ($row) {
                    if(auth()->user()->id == $row->from_user_id and $row->action_ended == 'do')
                    {
                        $action_delete_update='<li><a style="font-size: 16px" class="hover-effect dropdown-item" target="'.route('admin.edit_task',$row->id).'" href=""><i class="fas fa-info-circle"></i> ' . translate('edit') . '</a></li>
                                               <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="'.route('admin.delete_task',$row->id).'" href=""><i class="fas fa-info-circle"></i> ' . translate('delete') . '</a></li>';
                    }else{
                        $action_delete_update='';
                    }

                    return '<div class="btn-group">
    <button style="font-size: 16px" type="button" class="btn btn-sm btn-secondary">'.translate('actions').'</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
         '.$action_delete_update.'
        <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="_blank" href="'.route('admin.task_details',$row->id).'"><i class="fas fa-info-circle"></i> ' . translate('details') . '</a></li>
    </ul>
</div>
';

                })->addColumn('evaluation_result', function ($row) {
                    return $row->action_ended;;
                })->rawColumns(['action','employee','task_type','priority','date','peroid','assigned_to'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /**********************************************************/
    public function get_ajex_wared_tasks(Request $request)
    {
        if ($request->ajax()) {
            $tasks  =new Tasks();
            $user_id = auth()->user()->id;
            if(auth('admin')->user()->role_id_fk == 1)
            {
                $data    = $tasks->data_table('','','do','','','','');
            }else
            {

                $data    = $tasks->data_table('',$user_id,'do','','','','');
            }

            //test($data);
            $counter = 0;

            return DataTables::of($data)

                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('case_name', function ($row) {

                    return $row->case_name;
                })
                ->addColumn('ensha_date', function ($row) {
                    $icon = '<i class="fas fa-user"></i>';
                    return $row->ensha_date;
                })
                ->addColumn('task_type', function ($row) {
                    $task_type = [
                        $row->from_user_id => '<span style="background-color: lightgreen ; " class="span_data_table">' . translate('outcomming') . '</span>',
                        $row->to_user_id => '<span style="background-color: lightcoral ; " class="span_data_table">' . translate('incomming') . '</span>',
                    ];
                    return $task_type[$row->to_user_id];
                })
                ->addColumn('task_name', function ($row) {
                    return $row->task_name;;
                })
                ->addColumn('priority', function ($row) {
                    return '<span style="background-color: ' . $row->priority_color . ' ; " class="span_data_table">' . $row->priority . '</span>';
                })

                ->addColumn('employee', function ($row) {

                    return '<span style="color:green"> من / ' . $row->from_emp_name . '</span><br/><span style="color:blue">إلي / ' . $row->to_emp_name . '<span>';
                })
                ->addColumn('date', function ($row) {
                    return  '<span style="color:green"> من / ' . $row->start_date . '</span><br/><span style="color:red">إلي / ' . $row->end_date . '<span>';
                })
                ->addColumn('peroid', function ($row) {

                    return Diff_Days($row->start_date, $row->end_date) . '<br>' .
                        ($row->end_date) . '</span>';

                })
                ->addColumn('assigned_to', function ($row) {
                    return '<div class="user-block">
                                 <img class="img-thumbnail rounded-circle" src="" alt="user image">
                                 <span class="username" style="color:green">' . $row->to_emp_name . '</span>
                                 <span class="text-danger">at ' . Carbon::parse($row->created_at)->format('H:i:s') . '</span>
                            </div>';

                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
    <button type="button" style="font-size: 16px" class="btn btn-sm btn-secondary">'.translate('actions').'</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
        <li><a style="font-size: 16px" class="hover-effect dropdown-item" data-bs-toggle="modal" data-bs-target="#modalestlam" onclick="estlam_pop_forms(' . $row->id . ')" ><i class="fas fa-info-circle"></i> ' . translate('receive_task') . '</a></li>
       <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="_blank" href="'.route('admin.task_details',$row->id).'"><i class="fas fa-info-circle"></i> ' . translate('details') . '</a></li>
    </ul>
</div>
';


                })->rawColumns(['action','employee','task_type','priority','date','peroid','assigned_to'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /****************************************************************************/
    public function get_ajex_sader_tasks(Request $request)
    {
        if ($request->ajax()) {
            $tasks  =new Tasks();
            $user_id = auth()->user()->id;
            if(auth('admin')->user()->role_id_fk == 1)
            {
                $data    = $tasks->data_table('','','do','','','','');
            }else
            {

                $data    = $tasks->data_table('','','do',$user_id,'','','');
            }

            //test($data);
            $counter = 0;

            return DataTables::of($data)

                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('case_name', function ($row) {

                    return $row->case_name;
                })
                ->addColumn('ensha_date', function ($row) {
                    $icon = '<i class="fas fa-user"></i>';
                    return $row->ensha_date;
                })
                ->addColumn('task_type', function ($row) {
                    $task_type = [
                        $row->from_user_id => '<span style="background-color: lightgreen ; " class="span_data_table">' . translate('outcomming') . '</span>',
                      //  $row->to_user_id => '<span style="background-color: lightcoral ; " class="span_data_table">' . translate('incomming') . '</span>',
                    ];
                    return $task_type[$row->from_user_id];
                })
                ->addColumn('task_name', function ($row) {
                    return $row->task_name;;
                })
                ->addColumn('priority', function ($row) {
                    return '<span style="background-color: ' . $row->priority_color . ' ; " class="span_data_table">' . $row->priority . '</span>';
                })

                ->addColumn('employee', function ($row) {

                    return '<span style="color:green"> من / ' . $row->from_emp_name . '</span><br/><span style="color:blue">إلي / ' . $row->to_emp_name . '<span>';
                })
                ->addColumn('date', function ($row) {
                    return  '<span style="color:green"> من / ' . $row->start_date . '</span><br/><span style="color:red">إلي / ' . $row->end_date . '<span>';
                })
                ->addColumn('peroid', function ($row) {

                    return Diff_Days($row->start_date, $row->end_date) . '<br>' .
                        ($row->end_date) . '</span>';

                })
                ->addColumn('assigned_to', function ($row) {
                    return '<div class="user-block">
                                 <img class="img-thumbnail rounded-circle" src="" alt="user image">
                                 <span class="username" style="color:green">' . $row->to_emp_name . '</span>
                                 <span class="text-danger">at ' . Carbon::parse($row->created_at)->format('H:i:s') . '</span>
                            </div>';

                })
                ->addColumn('action', function ($row) {
                    if(auth()->user()->id == $row->from_user_id and $row->action_ended == 'do')
                    {
                        $action_delete_update='<li><a style="font-size: 16px" class="hover-effect dropdown-item" target="'.route('admin.edit_task',$row->id).'" href=""><i class="fas fa-info-circle"></i> ' . translate('edit') . '</a></li>
                                               <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="'.route('admin.delete_task',$row->id).'" href=""><i class="fas fa-info-circle"></i> ' . translate('delete') . '</a></li>';
                    }else{
                        $action_delete_update='';
                    }

                    return '<div class="btn-group">
    <button style="font-size: 16px" type="button" class="btn btn-sm btn-secondary">'.translate('actions').'</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
         '.$action_delete_update.'
        <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="_blank" href="'.route('admin.task_details',$row->id).'"><i class="fas fa-info-circle"></i> ' . translate('details') . '</a></li>
    </ul>
</div>
';


                })->rawColumns(['action','employee','task_type','priority','date','peroid','assigned_to'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /*****************************************************************************/
    public function get_ajex_doing_tasks(Request $request)
    {
        if ($request->ajax()) {
            $tasks  =new Tasks();
            $user_id = auth()->user()->id;
            if(auth('admin')->user()->role_id_fk == 1)
            {
                $data    = $tasks->data_table('','','doing','','','','');
            }else
            {

                $data    = $tasks->data_table('',$user_id,'doing','','','','');
            }

            //test($data);
            $counter = 0;

            return DataTables::of($data)

                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('case_name', function ($row) {

                    return $row->case_name;
                })
                ->addColumn('ensha_date', function ($row) {
                    $icon = '<i class="fas fa-user"></i>';
                    return $row->ensha_date;
                })
                ->addColumn('task_type', function ($row) {
                    $task_type = [
                       // $row->from_user_id => '<span style="background-color: lightgreen ; " class="span_data_table">' . translate('outcomming') . '</span>',
                          $row->to_user_id => '<span style="background-color: lightcoral ; " class="span_data_table">' . translate('incomming') . '</span>',
                    ];
                    return $task_type[$row->to_user_id];
                })
                ->addColumn('task_name', function ($row) {
                    return $row->task_name;;
                })
                ->addColumn('priority', function ($row) {
                    return '<span style="background-color: ' . $row->priority_color . ' ; " class="span_data_table">' . $row->priority . '</span>';
                })

                ->addColumn('employee', function ($row) {

                    return '<span style="color:green"> من / ' . $row->from_emp_name . '</span><br/><span style="color:blue">إلي / ' . $row->to_emp_name . '<span>';
                })
                ->addColumn('date', function ($row) {
                    return  '<span style="color:green"> من / ' . $row->start_date . '</span><br/><span style="color:red">إلي / ' . $row->end_date . '<span>';
                })
                ->addColumn('peroid', function ($row) {

                    return Diff_Days($row->start_date, $row->end_date) . '<br>' .
                        ($row->end_date) . '</span>';

                })
                ->addColumn('assigned_to', function ($row) {
                    return '<div class="user-block">
                                 <img class="img-thumbnail rounded-circle" src="" alt="user image">
                                 <span class="username" style="color:green">' . $row->to_emp_name . '</span>
                                 <span class="text-danger">at ' . Carbon::parse($row->created_at)->format('H:i:s') . '</span>
                            </div>';

                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
    <button type="button" style="font-size: 16px" class="btn btn-sm btn-secondary">'.translate('actions').'</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
         <li><a style="font-size: 16px" class="hover-effect dropdown-item" href="'.route('admin.end_task',$row->id).'" onclick="return confirm('. translate('end_task_alert_msg') .');"><i class="fas fa-info-circle"></i> ' . translate('end_task') . '</a></li>
        <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="_blank" href=""><i class="fas fa-info-circle"></i> ' . translate('details') . '</a></li>
    </ul>
</div>
';


                })->rawColumns(['action','employee','task_type','priority','date','peroid','assigned_to'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /*****************************************************************************/
    public function get_ajex_done_tasks(Request $request)
    {
        if ($request->ajax()) {
            $tasks  =new Tasks();
            $user_id = auth()->user()->id;
            if(auth('admin')->user()->role_id_fk == 1)
            {
                $data    = $tasks->data_table('','','done','','','','');
            }else
            {

                $data    = $tasks->data_table('',$user_id,'done','','','','');
            }

            //test($data);
            $counter = 0;

            return DataTables::of($data)

                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('case_name', function ($row) {

                    return $row->case_name;
                })
                ->addColumn('ensha_date', function ($row) {
                    $icon = '<i class="fas fa-user"></i>';
                    return $row->ensha_date;
                })
                ->addColumn('task_type', function ($row) {
                    $task_type = [
                       /// $row->from_user_id => '<span style="background-color: lightgreen ; " class="span_data_table">' . translate('outcomming') . '</span>',
                          $row->to_user_id => '<span style="background-color: lightcoral ; " class="span_data_table">' . translate('incomming') . '</span>',
                    ];
                    return $task_type[$row->to_user_id];
                })
                ->addColumn('task_name', function ($row) {
                    return $row->task_name;;
                })
                ->addColumn('priority', function ($row) {
                    return '<span style="background-color: ' . $row->priority_color . ' ; " class="span_data_table">' . $row->priority . '</span>';
                })

                ->addColumn('employee', function ($row) {

                    return '<span style="color:green"> من / ' . $row->from_emp_name . '</span><br/><span style="color:blue">إلي / ' . $row->to_emp_name . '<span>';
                })
                ->addColumn('date', function ($row) {
                    return  '<span style="color:green"> من / ' . $row->start_date . '</span><br/><span style="color:red">إلي / ' . $row->end_date . '<span>';
                })
                ->addColumn('peroid', function ($row) {

                    return Diff_Days($row->start_date, $row->end_date) . '<br>' .
                        ($row->end_date) . '</span>';

                })
                ->addColumn('assigned_to', function ($row) {
                    return '<div class="user-block">
                                 <img class="img-thumbnail rounded-circle" src="" alt="user image">
                                 <span class="username" style="color:green">' . $row->to_emp_name . '</span>
                                 <span class="text-danger">at ' . Carbon::parse($row->created_at)->format('H:i:s') . '</span>
                            </div>';

                })
                ->addColumn('action', function ($row) {
                    if(auth()->user()->id == $row->from_user_id and $row->action_ended == 'do')
                    {
                        $action_delete_update='<li><a style="font-size: 16px" class="hover-effect dropdown-item" target="'.route('admin.edit_task',$row->id).'" href=""><i class="fas fa-info-circle"></i> ' . translate('edit') . '</a></li>
                                               <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="'.route('admin.delete_task',$row->id).'" href=""><i class="fas fa-info-circle"></i> ' . translate('delete') . '</a></li>';
                    }else{
                        $action_delete_update='';
                    }

                    return '<div class="btn-group">
    <button style="font-size: 16px" type="button" class="btn btn-sm btn-secondary">'.translate('actions').'</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
         '.$action_delete_update.'
        <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="_blank" href="'.route('admin.task_details',$row->id).'"><i class="fas fa-info-circle"></i> ' . translate('details') . '</a></li>
    </ul>
</div>
';


                })->rawColumns(['action','employee','task_type','priority','date','peroid','assigned_to'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /*****************************************************************************/
    public function get_ajex_delayed_tasks(Request $request)
    {
        if ($request->ajax()) {
            $tasks  =new Tasks();
            $today    = Carbon::now()->toDateString();
            $user_id = auth()->user()->id;

            $data    = $tasks->data_table($today,'','','','','','');
            //test($data);
            $counter = 0;

            return DataTables::of($data)

                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('case_name', function ($row) {

                    return $row->case_name;
                })
                ->addColumn('ensha_date', function ($row) {
                    $icon = '<i class="fas fa-user"></i>';
                    return $row->ensha_date;
                })
                ->addColumn('task_type', function ($row) {
                    $task_type = [
                         $row->from_user_id => '<span style="background-color: lightgreen ; " class="span_data_table">' . translate('outcomming') . '</span>',
                      //  $row->to_user_id => '<span style="background-color: lightcoral ; " class="span_data_table">' . translate('incomming') . '</span>',
                    ];
                    return $task_type[$row->from_user_id];
                })
                ->addColumn('task_name', function ($row) {
                    return $row->task_name;;
                })
                ->addColumn('priority', function ($row) {
                    return '<span style="background-color: ' . $row->priority_color . ' ; " class="span_data_table">' . $row->priority . '</span>';
                })

                ->addColumn('employee', function ($row) {

                    return '<span style="color:green"> من / ' . $row->from_emp_name . '</span><br/><span style="color:blue">إلي / ' . $row->to_emp_name . '<span>';
                })
                ->addColumn('date', function ($row) {
                    return  '<span style="color:green"> من / ' . $row->start_date . '</span><br/><span style="color:red">إلي / ' . $row->end_date . '<span>';
                })
                ->addColumn('peroid', function ($row) {

                    return Diff_Days($row->start_date, $row->end_date) . '<br>' .
                        ($row->end_date) . '</span>';

                })
                ->addColumn('assigned_to', function ($row) {
                    return '<div class="user-block">
                                 <img class="img-thumbnail rounded-circle" src="" alt="user image">
                                 <span class="username" style="color:green">' . $row->to_emp_name . '</span>
                                 <span class="text-danger">at ' . Carbon::parse($row->created_at)->format('H:i:s') . '</span>
                            </div>';

                })
                ->addColumn('action', function ($row) {
                    if(auth()->user()->id == $row->from_user_id and $row->action_ended == 'do')
                    {
                        $action_delete_update='<li><a style="font-size: 16px" class="hover-effect dropdown-item" target="'.route('admin.edit_task',$row->id).'" href=""><i class="fas fa-info-circle"></i> ' . translate('edit') . '</a></li>
                                               <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="'.route('admin.delete_task',$row->id).'" href=""><i class="fas fa-info-circle"></i> ' . translate('delete') . '</a></li>';
                    }else{
                        $action_delete_update='';
                    }

                    return '<div class="btn-group">
    <button style="font-size: 16px" type="button" class="btn btn-sm btn-secondary">'.translate('actions').'</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
         '.$action_delete_update.'
        <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="_blank" href="'.route('admin.task_details',$row->id).'"><i class="fas fa-info-circle"></i> ' . translate('details') . '</a></li>
    </ul>
</div>
';


                })->rawColumns(['action','employee','task_type','priority','date','peroid','assigned_to'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /*****************************************************************************/
    public function get_ajex_cancelled_tasks(Request $request)
    {
        if ($request->ajax()) {
            $tasks  =new Tasks();
            $today    = Carbon::now()->toDateString();
            $user_id = auth()->user()->id;

            $data    = $tasks->data_table('','','done','','','','no');
            //test($data);
            $counter = 0;

            return DataTables::of($data)

                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('case_name', function ($row) {

                    return $row->case_name;
                })
                ->addColumn('ensha_date', function ($row) {
                    $icon = '<i class="fas fa-user"></i>';
                    return $row->ensha_date;
                })
                ->addColumn('task_type', function ($row) {
                    $task_type = [
                        $row->from_user_id => '<span style="background-color: lightgreen ; " class="span_data_table">' . translate('outcomming') . '</span>',
                        //  $row->to_user_id => '<span style="background-color: lightcoral ; " class="span_data_table">' . translate('incomming') . '</span>',
                    ];
                    return $task_type[$row->from_user_id];
                })
                ->addColumn('task_name', function ($row) {
                    return $row->task_name;;
                })
                ->addColumn('priority', function ($row) {
                    return '<span style="background-color: ' . $row->priority_color . ' ; " class="span_data_table">' . $row->priority . '</span>';
                })

                ->addColumn('employee', function ($row) {

                    return '<span style="color:green"> من / ' . $row->from_emp_name . '</span><br/><span style="color:blue">إلي / ' . $row->to_emp_name . '<span>';
                })
                ->addColumn('date', function ($row) {
                    return  '<span style="color:green"> من / ' . $row->start_date . '</span><br/><span style="color:red">إلي / ' . $row->end_date . '<span>';
                })
                ->addColumn('peroid', function ($row) {

                    return Diff_Days($row->start_date, $row->end_date) . '<br>' .
                        ($row->end_date) . '</span>';

                })
                ->addColumn('refused_reason', function ($row) {
                    return $row->action_ended_reason;

                })
                ->addColumn('refused_date', function ($row) {
                    return '<span style="color:green"> تاريخ الرفض : ' . $row->action_ended_date . '</span><br/><span style="color:blue">
                                       الــــتوقيـــت : ' . $row->action_ended_time . '<span>';


                })->rawColumns(['action','employee','task_type','priority','date','peroid','refused_date'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /*****************************************************************************/
    public function get_ajex_evaluate_tasks(Request $request)
    {
        if ($request->ajax()) {
            $tasks  =new Tasks();
            $today    = Carbon::now()->toDateString();
            $user_id = auth()->user()->id;
            if(auth('admin')->user()->role_id_fk == 1)
            {
                $data    = $tasks->data_table('','','do','','','','');
            }else
            {

                $data    = $tasks->data_table('',$user_id,'do','','','','');
            }

            //test($data);
            $counter = 0;

            return DataTables::of($data)

                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('case_name', function ($row) {

                    return $row->case_name;
                })
                ->addColumn('ensha_date', function ($row) {
                    $icon = '<i class="fas fa-user"></i>';
                    return $row->ensha_date;
                })
                ->addColumn('task_type', function ($row) {
                    $task_type = [
                        $row->from_user_id => '<span style="background-color: lightgreen ; " class="span_data_table">' . translate('outcomming') . '</span>',
                        //  $row->to_user_id => '<span style="background-color: lightcoral ; " class="span_data_table">' . translate('incomming') . '</span>',
                    ];
                    return $task_type[$row->from_user_id];
                })
                ->addColumn('task_name', function ($row) {
                    return $row->task_name;;
                })
                ->addColumn('priority', function ($row) {
                    return '<span style="background-color: ' . $row->priority_color . ' ; " class="span_data_table">' . $row->priority . '</span>';
                })

                ->addColumn('employee', function ($row) {

                    return '<span style="color:green"> من / ' . $row->from_emp_name . '</span><br/><span style="color:blue">إلي / ' . $row->to_emp_name . '<span>';
                })
                ->addColumn('date', function ($row) {
                    return  '<span style="color:green"> من / ' . $row->start_date . '</span><br/><span style="color:red">إلي / ' . $row->end_date . '<span>';
                })
                ->addColumn('peroid', function ($row) {

                    return Diff_Days($row->start_date, $row->end_date) . '<br>' .
                        ($row->end_date) . '</span>';

                })
                ->addColumn('assigned_to', function ($row) {
                    return '<div class="user-block">
                                 <img class="img-thumbnail rounded-circle" src="" alt="user image">
                                 <span class="username" style="color:green">' . $row->to_emp_name . '</span>
                                 <span class="text-danger">at ' . Carbon::parse($row->created_at)->format('H:i:s') . '</span>
                            </div>';

                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
    <button type="button" style="font-size: 16px" class="btn btn-sm btn-secondary">'.translate('actions').'</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
         <li><a style="font-size: 16px" class="hover-effect dropdown-item" data-bs-toggle="modal" data-bs-target="#modaltakeem" onclick="takeem_pop_form(' . $row->id . ')" ><i class="fas fa-star"></i> ' . translate('takeem_task') . '</a></li>
         <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="_blank" href="'.route('admin.task_details',$row->id).'"><i class="fas fa-info-circle"></i> ' . translate('details') . '</a></li>
    </ul>
</div>
';


                })->rawColumns(['action','employee','task_type','priority','date','peroid','assigned_to'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /*****************************************************************************/
    public function get_ajex_needReply_tasks(Request $request)
    {
        if ($request->ajax()) {
            $tasks  =new Tasks();
            $today    = Carbon::now()->toDateString();
            $user_id = auth()->user()->id;
            if(auth('admin')->user()->role_id_fk == 1)
            {
                $data    = $tasks->data_table('','','do','','','','no');
            }else
            {

                $data    = $tasks->data_table('','','do','',$user_id,'','no');
            }

            //test($data);
            $counter = 0;

            return DataTables::of($data)

                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('case_name', function ($row) {

                    return $row->case_name;
                })
                ->addColumn('ensha_date', function ($row) {
                    $icon = '<i class="fas fa-user"></i>';
                    return $row->ensha_date;
                })
                ->addColumn('task_type', function ($row) {
                    $task_type = [
                        $row->from_user_id => '<span style="background-color: lightgreen ; " class="span_data_table">' . translate('outcomming') . '</span>',
                        //  $row->to_user_id => '<span style="background-color: lightcoral ; " class="span_data_table">' . translate('incomming') . '</span>',
                    ];
                    return $task_type[$row->from_user_id];
                })
                ->addColumn('task_name', function ($row) {
                    return $row->task_name;;
                })
                ->addColumn('priority', function ($row) {
                    return '<span style="background-color: ' . $row->priority_color . ' ; " class="span_data_table">' . $row->priority . '</span>';
                })

                ->addColumn('employee', function ($row) {

                    return '<span style="color:green"> من / ' . $row->from_emp_name . '</span><br/><span style="color:blue">إلي / ' . $row->to_emp_name . '<span>';
                })
                ->addColumn('date', function ($row) {
                    return  '<span style="color:green"> من / ' . $row->start_date . '</span><br/><span style="color:red">إلي / ' . $row->end_date . '<span>';
                })
                ->addColumn('peroid', function ($row) {

                    return Diff_Days($row->start_date, $row->end_date) . '<br>' .
                        ($row->end_date) . '</span>';

                })
                ->addColumn('assigned_to', function ($row) {
                    return '<div class="user-block">
                                 <img class="img-thumbnail rounded-circle" src="" alt="user image">
                                 <span class="username" style="color:green">' . $row->to_emp_name . '</span>
                                 <span class="text-danger">at ' . Carbon::parse($row->created_at)->format('H:i:s') . '</span>
                            </div>';

                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
    <button type="button" style="font-size: 16px" class="btn btn-sm btn-secondary">'.translate('actions').'</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
      <li><a style="font-size: 16px" class="hover-effect dropdown-item" target="_blank" href="'.route('admin.task_details',$row->id).'"><i class="fas fa-info-circle"></i> ' . translate('details') . '</a></li>
    </ul>
</div>
';


                })->rawColumns(['action','employee','task_type','priority','date','peroid','assigned_to'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /*****************************************************************************/
    public function estlam_task($id)
    {
        $data['task_id'] = $id;
        return view('dashbord.admin.tasks.get_estlam_task_form',$data);
    }
    /*****************************************************************************/
    public function save_estlam_task(EstlamTaskRequest $request,$task_id)
    {
        try {
            $task_model           = new Tasks();
            $data                 = $task_model->estlam_task($request);
            //dd($data);
            $this->CasesTasksRepository->update($task_id,$data);
            notify()->success(translate('task_recieved_successfully'), '');
            return redirect()->route('admin.wared_data');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*****************************************************************************/
    public function details($id)
    {
        $task             = new Tasks();
        $commentModel     = new TaskComments();
        $update_seen['comment_seen'] = 1;
       // $this->CasesTasksRepository->updateWhere(array('current_to_user_id'=>auth()->user()->id,'id'=>$id),$update_seen);
        $comment_seen['to_user_seen'] = 1;
        //dd($comment_seen['to_user_seen']);
       // $this->TasksCommentsRepository->updateWhere(array('to_user_id'=>auth()->user()->id,'to_user_seen'=>0,'task_id_fk'=>$id),$comment_seen);
        $data['details']  = $task->get_task_by_id($id)[0];

       // $data['all_comments']  = $this->TasksCommentsRepository->getBywhere(array('task_id_fk'=>$id));
        $data['all_task_comments']  = $commentModel->get_task_details_comments($id);

        return view('dashbord.admin.tasks.tasks_details',$data);
    }
    /****************************************************************************/
    public function add_task_comment(TaskCommentsRequest $request,$id)
    {
        try {
             $comments           = new TaskComments();
             $task               = $this->CasesTasksRepository->getById($id);
             $data               = $comments->get_insert_data($request,$task);
            $client = $this->TasksCommentsRepository->create($data);
            if ($client instanceof Model) {
                notify()->success(translate('Client_added_successfully'), '');
                return redirect()->route('admin.task_details',$id);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*************************************************************************/
    public function delete_task_comment(Request $request,$comment_id,$task_id)
    {
        try {
            $client = $this->TasksCommentsRepository->delete($comment_id);
                notify()->success(translate('comment_deleted_successfully'), '');
                return redirect()->route('admin.task_details',$task_id);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /***********************************************************************/
   public function update_task_comment(TaskCommentsRequest $request,$comment_id,$task_id)
   {
       try {
           $comments           = new TaskComments();
           $task               = $this->CasesTasksRepository->getById($task_id);
           $data               = $comments->get_update_data($request,$task);
           $client = $this->TasksCommentsRepository->update($comment_id,$data);

               notify()->success(translate('comment_edit_successfully'), '');
               return redirect()->route('admin.task_details',$task_id);

       } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
   }
   /*************************************************************************/
    public function extend_task_date(ExtendDateRequest $request,$task_id)
    {
        try {
            $taskModel  = new Tasks();
            $task       =$this->CasesTasksRepository->getById($task_id);

            $data  = $taskModel->update_task_date($request,$task);
            $this->CasesTasksRepository->update($task_id,$data);
            notify()->success(translate('comment_deleted_successfully'), '');
            return redirect()->route('admin.task_details',$task_id);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**********************************************************************/
    public function delete_task($task_id)
    {
        try {
            $task = $this->CasesTasksRepository->delete($task_id);
            notify()->success(translate('task_deleted_successfully'), '');
            return redirect()->route('admin.all_task_data');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**********************************************************************/
    public function edit_task($task_id)
    {

        $data['priority']     =  $this->GeneralSettingRepository->getBywhere(array('ttype'=>'priority'));
        $data['emps']         =  $this->AdminUsersRepository->getAll();
        $data['cases']        =  $this->ClientCasesRepository->getAll();
        $case_model                  =  new Cases();
        $data['clients']             =  $this->ClientRepository->getAll();
        $data['case_num']            =  $case_model->get_next_case_num();
        $data['case_type']           =  $this->GeneralSettingRepository->getBywhere(array('ttype'=>'priority'));
        $data['courts']              =  $this->GeneralSettingRepository->getBywhere(array('ttype'=>'priority'));
        $data['case_status']         =  $this->GeneralSettingRepository->getBywhere(array('ttype'=>'priority'));
        $data['type']                = 'create';
        $data['all_task_data']       = $this->CasesTasksRepository->getById($task_id);
        //dd($data['emps']);
        return view('dashbord.admin.tasks.tasks_edit',$data);
    }
    /*******************************************************************/
    public function update_task(Request $request,$task_id)
    {
        try {
            $request->validate([
                'ensha_data' => 'required',
                'esnad_to'   => 'required',
                'priority'   => 'required',
                'start_date' => 'required',
                'end_date'   => 'required',
                'details'    => 'required',
                // 'case_id'    => 'required',

            ]);
            $case  = new Tasks();
            $data  = $case->save_task_data($request);
            $this->CasesTasksRepository->update($task_id,$data);
            notify()->success(translate('tasks_update_successfully'), '');
            return redirect()->route('admin.all_task_data');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*******************************************************************/
    public function takeem_task($id)
    {
        $data['task_id'] = $id;
        $data['all_task_data'] =$this->CasesTasksRepository->getById($id);
        return view('dashbord.admin.tasks.get_takeem_task_form',$data);
    }

    /*********************************************************************/
    public function save_takeem_task(TakeemTaskRequest $request,$id)
    {

        try {
            $task_model         = new Tasks();
            $task               = $this->CasesTasksRepository->getById($id);
            $data               = $task_model->get_takeem_data($request,$task);
            //dd($data);
             $this->CasesTasksRepository->update($id,$data);
            notify()->success(translate('Client_added_successfully'), '');
            return redirect()->route('admin.all_task_data');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*********************************************************************/
    public function end_task($id)
    {
        $task_model       = new Tasks();
        $data['details']  = $task_model->get_task_by_id($id)[0];

        return view('dashbord.admin.tasks.tasks_end',$data);
    }
    /*******************************************************************/
    public function save_end_task(Request $request,$id)
    {
        try {
            $request->validate([
                'act_ended_reason' => 'required',
                'act_ended_result' => 'required',
            ]);
            $task_model  = new Tasks();
            $task        = $this->CasesTasksRepository->getById($id);
            $data        = $task_model->end_task($request,$task);
            $this->CasesTasksRepository->update($id,$data);
            if ($request->hasFile('file')) {
                $files = $request->file('file');
                foreach ($files as $file){
                    $dataX = $this->saveFile($file, 'task'.$id);

                    $data2['file']         = $dataX;
                    $data2['task_id_fk']   = $id;
                    $file                 = $this->TasksFilesRepository->create($data2);

                }

            }

            notify()->success(translate('task_ended_successfully'), '');
            return redirect()->route('admin.all_task_data',$id);


        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


}
