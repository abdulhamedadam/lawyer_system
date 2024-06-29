<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Traits\ImageProcessing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;

class UsersController extends Controller
{
    use ImageProcessing;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->AdminUsersRepository     = createRepository($basicRepository, new Admin());
    }

    public function index()
    {
        return view('dashbord.admin.users.users_data');
    }
    /************************************************************/
    public function get_ajax_users(Request $request)
    {
        dd('dd');
        if ($request->ajax()) {

            $data = $this->AdminUsersRepository->getAll();

            $counter=0;
            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('name', function ($row) {
                    return'<a class="px-3" >
                    <img class="w-50px h-50px rounded-1 ms-2" src="' . $row->image . '" alt=""/>
                </a>';
                })
                ->addColumn('user_name', function ($row) {
                    return $row->user_name;
                })
                ->addColumn('role', function ($row) {
                    return $row->role_id_fk;
                })
                ->addColumn('job_title', function ($row) {
                    return $row->phone;
                })
                ->addColumn('status', function ($row) {
                    return $row->status;
                })
                ->addColumn('action', function ($row) {
                    return '<a data-bs-toggle="modal" data-bs-target="#modalsettings" onclick="edit_role('.$row->id.')" class="btn btn-sm btn-warning" title="">
                          <i class="bi bi-pencil"></i> '.translate('edit').'
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="'.route('admin.delete_role',$row->id).'"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>'.translate('delete').'
                        </a>
                      ';

                })
                ->rawColumns(['name', 'action'])
                ->make(true);

            return $dataTable->toJson();
        }


    }
    /************************************************************/


    public function store(AdminStoreRequest $request)
    {
        try {
            $insert_data = $request->all();
            $insert_data['name'] = $request->user_name;
            $insert_data['address'] = $request->address;
            $insert_data['phone'] = $request->phone;
            $insert_data['email'] = $request->email;
            $insert_data['password'] = $request->password;
            $insert_data['status'] = $request->status;
            if ($request->hasFile('user_image')) {
                $file = $request->file('user_image');

                $dataX = $this->upload_image($file, 'web/admin/users');
                $insert_data['image'] = $dataX;
            }
            $this->basicRepository->create($insert_data);
//            Admin::create($insert_data);

            return redirect()->route('admin.add_users_form');



        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }




    /*---------------------------------------------------------------------------------------*/

    public function edit($id)
    {
        $user_data = $this->basicRepository->getById($id);

//        $user_data = Admin::find($id);
        return view('dashbord.users.edit_user', compact('user_data'));
    }


    /*------------------------------------------------------------------------------------*/
    public function update(AdminUpdateRequest $request, $id)
    {
        //dd($request);
        try {
//            $data =$this->basicRepository->getById($request->id);

//            $data = Admin::find($request->id);
            $insert_data = $request->all();
            $insert_data['user'] = $request->user_name;
            $insert_data['address'] = $request->address;
            $insert_data['phone'] = $request->phone;
            $insert_data['email'] = $request->email;
            // $insert_data['password'] = $request->password;
            $insert_data['status'] = $request->status;
            if ($request->hasFile('user_image')) {
                $file = $request->file('user_image');

                $dataX = $this->upload_image($file, 'admin/users');
                $insert_data['image'] = $dataX;
            }
            $this->basicRepository->update($request->id, $insert_data);
//            $data->update($insert_data);

            return redirect()->route('admin.all_users');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /*------------------------------------------------------------------------------*/
    public function destroy(Request $request)
    {
        try {

//            $delete_data = Admin::find($id)->delete();
            $this->basicRepository->delete($request['id']);
            return redirect()->route('admin.all_users');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /************************************************/
    public function show($id)
    {

    }

}
