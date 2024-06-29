<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\EmployeeStoreRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\Employees;
use App\Models\Admin\EmployeeFiles;
use App\Models\Admin\GeneralSetting;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DataTables;
class EmployeesController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /*---------------------------------------------------*/

    protected $GeneralSettingRepository;
    protected $EmployeeRepository;
    protected $EmployeeFilesRepository;
    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->GeneralSettingRepository = createRepository($basicRepository, new GeneralSetting());
        $this->AreasSettingRepository   = createRepository($basicRepository, new AreaSetting());
        $this->EmployeeRepository       = createRepository($basicRepository,new Employees());
        $this->AdminRepository       = createRepository($basicRepository,new Admin());
        $this->EmployeeFilesRepository       = createRepository($basicRepository,new EmployeeFiles());
    }

    /************************************************************/
    public function index()
    {
        //dd('ss');
        return view('dashbord.admin.employees.employee_data');
    }
    /***********************************************************/
    public function get_ajax_employee(Request $request)
    {
        if ($request->ajax()) {
            $employee_model   = new Employees();
            $data             = $employee_model->get_employee_data();
            $counter = 0;
            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('employee_name', function ($row) {

                    return  $row->employee;
                })
                ->addColumn('phone_number', function ($row) {
                    return $row->phone;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;;
                })
                ->addColumn('job_title', function ($row) {
                    return $row->mosma_wazefy;;
                })
                ->addColumn('national_id', function ($row) {
                    return $row->card_num;;
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
    <button type="button" style="font-size: 16px" class="btn btn-sm btn-secondary">'.translate('actions').'</button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
        <li><a style="font-size: 14px" class="hover-effect dropdown-item" target="_blank" href="'.route('admin.edit_employee',$row->id).'"><i class=" bi bi-pencil"></i> ' . translate('edit_data') . '</a></li>
        <li><a style="font-size: 14px" class="hover-effect dropdown-item" target="_blank" href="'.route('admin.employee_files',$row->id).'"><i class="bi bi-files"></i> ' . translate('employee_file') . '</a></li>

    </ul>
</div>
';


                })->rawColumns(['image', 'action', 'client_name', 'related_lawsuits'])
                ->make(true);

            return $dataTable->toJson();
        }

    }
    /***********************************************************/
    public function add_employee()
    {
        $data['employee_code']   = $this->EmployeeRepository->getLastFieldValue('emp_code');
        $data['gender']          = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'gender'));
        $data['material_status'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'material_status'));
        $data['religions']       = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'religion'));
        $data['nationalites']    = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'nationality'));
        $data['qualifications']  = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'qualifications'));
        $data['degrees']         = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'degrees'));
        $data['jobs']            = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'jobs'));
        $data['governates']      = $this->AreasSettingRepository->getBywhere(array('from_id' => 0));
        $data['emolyees']        = $this->EmployeeRepository->getAll();
        return view('dashbord.admin.employees.employee_form',$data);
    }
    /*********************************************************/
    public function save_employee(EmployeeStoreRequest $request)
    {
        try {
            //dd('sss');
            $emplyee_model   = new Employees();
            $admin_model     = new Admin();
            $insert_data     = $emplyee_model->data_to_insert($request);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $dataX = $this->saveFile($file, 'employee'.$request->employee_code);
                $insert_data['personal_photo'] = $dataX;
            }


            $employee = $this->EmployeeRepository->create($insert_data);
//            $data     = $admin_model->employee_data_to_insert($request,$employee);
//            $this->AdminRepository->create($data);

            $request->session()->flash('toastMessage', translate('added_successfully'));
                return redirect()->route('admin.employee_data');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /*********************************************************/
    public function edit_employee($id)
    {
        $data['employee_code']   = $this->EmployeeRepository->getLastFieldValue('emp_code');
        $data['gender']          = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'gender'));
        $data['material_status'] = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'material_status'));
        $data['religions']       = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'religion'));
        $data['nationalites']    = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'nationality'));
        $data['qualifications']  = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'qualifications'));
        $data['degrees']         = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'degrees'));
        $data['jobs']            = $this->GeneralSettingRepository->getBywhere(array('ttype' => 'jobs'));
        $data['governates']      = $this->AreasSettingRepository->getBywhere(array('from_id' => 0));
        $data['emolyees']        = $this->EmployeeRepository->getAll();
        $data['all_data']        = $this->EmployeeRepository->getById($id);
        //dd($data['all_data']);
        return view('dashbord.admin.employees.employee_edit',$data);
    }
    /***********************************************************/
    public function update_employee(Request $request,$id)
    {
        try {
            //dd('sss');
            $emplyee_model   = new Employees();
            $admin_model     = new Admin();
            $insert_data     = $emplyee_model->data_to_insert($request);

            $employee = $this->EmployeeRepository->update($id,$insert_data);
         /* $data     = $admin_model->employee_data_to_insert($request,$employee);
              $this->AdminRepository->create($data); */

            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.employee_data');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /***********************************************************/
    public function delete_employee($id)
    {

    }

    /***********************************************************/
    public function employee_files(Employees $employees,$id)
    {
        $data['all_data']     =  $employees->get_employee_data($id)[0];
        $data['files_data']   =  $this->EmployeeFilesRepository->getBywhere(array('emp_id_fk'=>$id));
        ///dd($data['files_data']);
        return view('dashbord.admin.employees.employee_files', $data);
    }

    /***********************************************************/
    public function employee_add_files(Request $request,$emp_id)
    {
        try {
            $emp = $this->EmployeeRepository->getById($emp_id);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                    $dataX = $this->saveFile($file, 'employee'.$emp->id);

                    $data['file']         = $dataX;
                    $data['file_name']    = $request->file_name;
                    $data['emp_id_fk']    = $emp->id;
                    $data['publisher']    = auth('admin')->user()->id;
                    $data['publisher_n']  = auth('admin')->user()->name;
                    $file                 = $this->EmployeeFilesRepository->create($data);

            }
            notify()->success(translate('File_added_successfully'), '');
            return redirect()->route('admin.employee_files',$emp_id);


        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**********************************************************/
    public function employee_details(Employees $employees,$id)
    {
        $data['all_data']     =  $employees->get_employee_data($id)[0];
        return view('dashbord.admin.employees.employee_details', $data);
    }

}
