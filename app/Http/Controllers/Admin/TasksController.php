<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\Cases;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\Cleints;
use App\Models\Admin\CleintsFile;
use App\Models\Admin\ClientNotes;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Tasks;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /*---------------------------------------------------*/

    protected $GeneralSettingRepository;
    protected $ClientRepository;
    protected $ClientCasesRepository;
    protected $AdminUsersRepository;
    protected $CasesTasksRepository;


    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->GeneralSettingRepository = createRepository($basicRepository, new GeneralSetting());
        $this->ClientRepository         = createRepository($basicRepository, new Cleints());
        $this->ClientCasesRepository    = createRepository($basicRepository, new Cases());
        $this->AdminUsersRepository     = createRepository($basicRepository, new Admin());
        $this->CasesTasksRepository     = createRepository($basicRepository, new Tasks());
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
    public function add_task(Request $request)
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
            $this->CasesTasksRepository->create($data);
            notify()->success(translate('tasks_added_successfully'), '');
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
    public function get_ajex_all_tasks(Request $request)
    {
        dd($request);
        if ($request->ajax()) {
             $tasks  =new Tasks();
            $user_id = auth()->user()->id;
            $data    = $tasks->data_table('','','do','','',$user_id,'');
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
                    return '<div class="btn-group">
    <button type="button" class="btn btn-sm btn-secondary">الإجراءات</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
        <li><a class="hover-effect dropdown-item" target="_blank" href=""><i class="fas fa-info-circle"></i> ' . translate('edit') . '</a></li>
        <li><a class="hover-effect dropdown-item" target="_blank" href=""><i class="fas fa-info-circle"></i> ' . translate('delete') . '</a></li>
        <li><a class="hover-effect dropdown-item" target="_blank" href=""><i class="fas fa-info-circle"></i> ' . translate('details') . '</a></li>
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
    /***********************************************************/
    public function wared_tasks($type=null)
    {
        $data['type']    = 'wared';
        return view('dashbord.admin.tasks.tasks_wared_data',$data);
    }
    /**********************************************************/
    public function get_ajex_wared_tasks(Request $request)
    {
        dd($request);
        if ($request->ajax()) {
            $tasks   = new Tasks();
            $user_id = auth()->user()->id;
            $data    = $tasks->data_table('',$user_id,'do','','','','');
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
                    return '<div class="btn-group btn-group-sm">
                                <a title="' . translate('edit') . '" href="' . route('admin.edit_case', $row->id) . '" class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a>
                                <a title="' . translate('delete') . '" href="' . route('admin.delete_client', $row->id) . '" onclick="return confirm(\'Are You Sure To Delete?\')" class="btn btn-sm btn-danger text-white"><i class="fas fa-trash-alt"></i></a>

                            </div>';

                })
                ->rawColumns(['action','employee','task_type','priority','date','peroid','assigned_to'])
                ->make(true);

            return $dataTable->toJson();
        }
    }



}
