@extends('dashbord.layouts.master')
@section('css')
    <style>
        /* Add border to cards */
        .card {
            border: 1px solid #ccc; /* Adjust border properties as needed */
            border-radius: 5px; /* Add border radius for rounded corners */
            margin-bottom: 20px; /* Add margin between cards */
        }


    </style>
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title">{{ translate('users_permissions') }}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.roles_data') }}">
                                <i class="bi bi-arrow-clockwise fs-3"></i>{{translate('back')}}
                            </a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <form action="{{route('admin.add_role_permissions',$role->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3" style="margin-top: 15px;">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text">{{translate('role')}}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="user_role" id="user_role" data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($roles as $item)
                                                <option value="{{$item->id}}" {{ old('user_role',$role->id) == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('user_role')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6" style="margin-top: 25px; margin-right: 100px">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkAllPermissions">
                                    <label class="form-check-label" for="checkAllPermissions">
                                        <?=translate('check_all')?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr style="margin:20px 0px">
                        <div class="row" style="margin-top: 10px">
                            @foreach($all_data as $section => $permissions)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" style="font-size: 18px;color: blue;margin-top: 18px">{{ $section }}</div>
                                        <div class="card-body">
                                            @foreach($permissions as $permission)
                                                <div class="form-check">
                                                    <input class="form-check-input permission-checkbox" type="checkbox" name="permission[]" @php if(in_array($permission->id,$permissions_of_roles)){echo 'checked';} @endphp  value="{{ $permission->name }}" id="{{ $permission->name }}">
                                                    <label class="form-check-label" for="{{ $permission->name }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save fs-3"></i> {{ translate('SaveButton') }}
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>




@endsection
@section('js')
    <script>
        document.getElementById("checkAllPermissions").addEventListener("change", function() {
            var checkboxes = document.getElementsByClassName("permission-checkbox");
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = this.checked;
            }
        });
    </script>
@endsection
