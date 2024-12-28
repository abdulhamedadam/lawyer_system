<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Employee\RolesRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DataTables;
class RoleController extends Controller
{
    /*
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store','roles_data']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }*/

    public function roles_data(Role $role)
    {
        $role          = new User();
        $data['roles'] = $role->get_roles();
        return view('dashbord.admin.roles.roles_data',$data);
    }
    /**************************************************/
    public function get_ajex_roles(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('roles')
                ->select('roles.*')
                ->get();

           // dd($data);
            $counter        = 0;
            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('name', function ($row) {

                    return  $row->name;
                })
                ->addColumn('action', function ($row) {
                    return '<a data-bs-toggle="modal" data-bs-target="#modalsettings" onclick="edit_role('.$row->id.')" class="btn btn-sm btn-warning" title="">
                          <i class="bi bi-pencil"></i> '.translate('edit').'
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="'.route('admin.delete_role',$row->id).'"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>'.translate('delete').'
                        </a>
                        <a  href="'.route('admin.role_permissions',$row->id).'"  class="btn btn-sm btn-success">
                            <i class="bi bi-key"></i>'.translate('permissions').'
                        </a>';

                })->rawColumns(['action'])
                ->make(true);

            return $dataTable->toJson();
        }
    }

    /***************************************************/
    public function role_permissions($id)
    {
        $role_data = Role::find($id);
        if ($role_data) {
            $permissions = $role_data->permissions()->pluck('id')->toArray(); // Retrieve only permission IDs
            //dd($permissions);

            $role_model = new Role();
            $permission_model = new Permission();

            $data['all_data'] = $permission_model->get_all_permission();
            $data['roles'] = $role_model->get_data();
            $data['role'] = $role_data;
            $data['permissions_of_roles'] = $permissions;

            return view('dashbord.admin.roles.permissions_form', $data);
        } else {
            return redirect()->route('admin.roles_data');
        }
    }



    /*************************************************/
    public function add_role(RolesRequest $request)
    {
        try {
            $data['name']=$request->role_name;
            if(empty($request->row_id))
            {
              Role::create($data);
            }else
            {
                $role = Role::find($request->row_id);
                $role->update($data);
            }

            notify()->success(translate('role_addded_successfully'), '');
            return redirect()->route('admin.roles_data');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*************************************************/
    public function edit_role($id)
    {
        $data['all_data']=Role::findOrFail($id);
        //dd($data['all_data']);
        return response()->json($data);
    }
    /*************************************************/
    public function delete_role($id)
    {
        try {
            $role = Role::find($id);
            $role->delete();
            notify()->success(translate('deleted_successfully'), '');
            return redirect()->route('admin.roles_data');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /*************************************************/
    public function add_role_permissions(Request $request,$role_id)
    {
        //dd($request);
        try {
            if ($role_id !== null) {
                $role = Role::findOrFail($role_id);
            } else {
                $role = new Role();
            }

            $permissionIds = $request->input('permission', []);
            $role->syncPermissions($permissionIds);

            notify()->success(translate('permissions_successfully'), '');
            return redirect()->route('admin.roles_data');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
//$2y$10$ooL/GNe1upqO5b5uKBLUjOYK1rabgM1G8UBP1HC/RhWEBS3n1ZPlW
}
