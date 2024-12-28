<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Models\Admin\Employees;
use App\Models\User;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    use ImageProcessing;
    use ValidationMessage;
    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->AdminUsersRepository     = createRepository($basicRepository, new Admin());
        $this->EmployeeRepository       = createRepository($basicRepository,new Employees());
    }


    /***********************************************************/
    public function user_data()
    {
        //dd('ss');
        return view('dashbord.admin.users.users_data');
    }
    /***********************************************************/
    public function get_ajax_users(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('admins')
                ->select('admins.*','t1.mosma_wazefy_n as job_title')
                ->leftJoin('employees as t1','t1.id','=','admins.emp_id')
                ->orderBy('admins.id', 'desc')
                ->get();


            $counter = 0;
            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('name', function ($row) {

                    return '<div class="d-flex align-items-center">

            <a class="px-3">
                <img class="w-50px h-50px rounded-1 ms-2" src="' .asset(Storage::disk('files')->url($row->image)) . '" alt=""/>
            </a>
             <span style="color:green">' . $row->name . '</span>
        </div>';

                })
                ->addColumn('user_name', function ($row) {
                    return $row->user_name;
                })
                ->addColumn('role', function ($row) {
                    $user = Admin::find($row->id);
                    $label = '';
                    foreach ($user->getRoleNames() as $role) {
                        $label .= '<label class="btn btn-info btn-sm">' . $role . '</label>';
                    }
                    return $label; // Return the concatenated label string
                })

                ->addColumn('job_title', function ($row) {
                    if($row->job_title != null || !empty($row->job_title))
                    {
                        $title=$row->job_title;
                    }else{
                        $title=translate('not_exist');
                    }
                    return $title;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $title_approved = translate('active');
                        $class_approved = 'success';
                        $icon_approved = '<i class="bi bi-check-circle-fill"></i>';
                    } else {
                        $title_approved = translate('not_active');
                        $class_approved = 'danger';
                        $icon_approved = '<i class="bi bi-x-circle-fill"></i>';
                    }

                    return '<a onclick="return confirm(\''.translate('change_type_msg').'\');" href="'.route('admin.change_status', [$row->id, $row->status]).'" class="btn btn-'.$class_approved.' btn-sm">'.$icon_approved.' ' . $title_approved . '</a>';

                })
                ->addColumn('action', function ($row) {

                    if (auth()->user()->can('تعديل المستخدم')) {

                        $EditButtons = '<a href="'.route('admin.edit_user', $row->id).'" class="btn btn-sm btn-warning" title="">
                                          <i class="bi bi-pencil"></i> '.translate('edit').'</a>';
                    }else{
                        $EditButtons='';
                    }

                    if (auth()->user()->can('حذف المستخدم')) {

                        $DeleteButtons = ' <a onclick="return confirm(\'Are You Sure To Delete?\')" href="'.route('admin.delete_user',$row->id).'"  class="btn btn-sm btn-danger">
                                              <i class="bi bi-trash"></i>'.translate('delete').'
                                               </a>';
                    }else{
                        $DeleteButtons='';
                    }




                    return ' '.$EditButtons.'
                    '.$DeleteButtons.'

                   ';
                })->rawColumns(['name', 'action','status','role'])
                ->make(true);

            return $dataTable->toJson();
        }
    }

    /*********************************************************/
    public function add_user()
    {
        $role          = new User();
        $data['roles'] = $role->get_roles();
        $data['employees']=$this->EmployeeRepository->getAll();
        return view('dashbord.admin.users.users_form',$data);
    }
    /***********************************************************/
    public function save_user(StoreUserRequest $request)
    {
        try {
            //dd($request->user_role);
            //$admin_user = Admin::find(15);
            //dd($admin_user);
            $admin  = new Admin();
            if ($request->hasFile('user_image')) {
                $file = $request->file('user_image');
                $dataX = $this->saveFile($file, 'users');
            }else{
                $dataX  =null;
            }

             $data       = $admin->save_user($request,$dataX);
             $user       = $this->AdminUsersRepository->create($data);


            if($user)
            {
                $user->syncRoles($request->user_role);

            }

            notify()->success(translate('Case_added_successfully'), '');
            return redirect()->route('admin.user_data');
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*******************************************************************/
    public function delete_user(Request $request,$id)
    {
        $admin = $this->AdminUsersRepository->delete($id);
        if ($admin) {
            notify()->error(translate('user_deleted_successfully'), '');
            return redirect()->route('admin.user_data');
        } else {
            return redirect()->route('admin.user_data');
        }

    }
    /*******************************************************************/
    public function change_status($id,$status)
    {
        try {

            $admin_uset =$this->AdminUsersRepository->getById($id);
            if($admin_uset)
            {
                if($status=='active')
                {
                    $data['status']='not-active';
                }elseif($status=='not-active'){
                    $data['status']='active';
                }
                $this->AdminUsersRepository->update($id,$data);



                notify()->success(translate('status_changed_successfully'), '');
                return redirect()->route('admin.user_data');
            }
                return redirect()->route('admin.user_data');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /*******************************************************/
    public function edit_user($id)
    {
        $role          = new Role();
        $data['roles'] = $role->get_data();
        $data['employees']=$this->EmployeeRepository->getAll();
        $data['all_data']=$this->AdminUsersRepository->getById($id);
        return view('dashbord.admin.users.users_edit',$data);
    }
    /*****************************************************/
    public function update_user(UpdateUserRequest $request,$id)
    {
        try {
            //dd($request->user_role);
            //$admin_user = Admin::find(15);
            //dd($admin_user);
            $admin  = new Admin();
            if ($request->hasFile('user_image')) {
                $file = $request->file('user_image');
                $dataX = $this->saveFile($file, 'users');
            }else{
                $dataX  =null;
            }

            $data       = $admin->save_user($request,$dataX);
             $user      =$this->AdminUsersRepository->getById($id);
             $this->AdminUsersRepository->update($id,$data);

            $user->syncRoles($request->user_role);



            notify()->success(translate('Case_added_successfully'), '');
            return redirect()->route('admin.user_data');
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
