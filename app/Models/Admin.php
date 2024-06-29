<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guard = 'admin';

    protected $table = 'admins';

/**********************************************************************/

    protected $fillable = [
        'name',
        'emp_id',
        'email',
        'password',
        'real_password',
        'group_name',
        'status',
        'image',
        'address',
        'phone',
        'role_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles_name' => 'array',
    ];

    /**************************************************/
    public function employee_data_to_insert($request,$employee)
    {
        $params['name']         =$employee->emp_code;
        $params['emp_id']       =$employee->id;
        $params['email']        =$employee->email;
        $params['image']        =$employee->personal_photo;
        $params['phone ']       =$employee->phone;
        $params['role_id_fk ']  =2;

        return $params;
    }

    /************************************************************/
    public function save_user($request,$file=null)
    {
        if($request->emp_id !=null || !empty($request->emp_id))
        {
            $data['emp_id']    = $request->emp_id;
            $data['name'] = get_emp_name($request->emp_id);
        }else{
            $data['emp_id']=0;
            $data['name'] = $request->full_name;
        }
        $data['user_name'] = $request->user_name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['password'] = Hash::make($request->password);
        $data['real_password'] = ($request->password);
        $data['image'] = $file;
        //dd($data);
        return $data;
    }

    /*********************************************************/




}
