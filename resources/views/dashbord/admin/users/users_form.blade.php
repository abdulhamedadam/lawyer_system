@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container" >
            <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{translate('add_user')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.user_data') }}">
                                <i class="bi bi-arrow-clockwise fs-3"></i>{{translate('back')}}
                            </a>
                        </div>
                    </div>
                </div>

                <form  action="{{ route('admin.save_user') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12 row">
                            <div class="col-md-4" style="">
                                <label for="basic-url" class="form-label">{{ translate('isEmployee?') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-person fs-2"></i></span>
                                    <select class="form-select " name="is_employee" id="is_employee" data-placeholder="{{ translate('select') }}">
                                        <?php $type_arr = array(0 => translate('no'), 1 => translate('yes')) ?>
                                        @foreach($type_arr as $key=>$value)
                                            <option value="{{ $key }}" {{ old('user_role') == $key }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('is_employee')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4" id="input_div">
                                <label for="basic-url" class="form-label">{{ translate('full_name') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-person fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input autocomplete="off" type="text" class="form-control " name="full_name" id="full_name" value="{{ old('full_name') }}" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                @error('full_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-md-4" id="select_div" style="display: none">
                                <label for="basic-url" class="form-label">{{ translate('full_name') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-person fs-2"></i></span>
                                    <select  class="form-select "   name="emp_id" id="emp_id" data-placeholder="{{ translate('select') }}">
                                        <option value="">{{ translate('select') }}</option>
                                        @foreach($employees as $item)
                                            <option value="{{ $item->id }}" {{ old('emp_id') == $item->id ? 'selected' : '' }}>{{ $item->employee }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('emp_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('user_name') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-person fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input autocomplete="nope_{{ uniqid() }}"type="text" class="form-control" name="user_name" id="user_name" value="{{ old('user_name') }}" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                @error('user_name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class=" col-md-12 row" style="margin-top: 10px">

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('email') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-envelope fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input type="text" class="form-control " name="email" id="email" value="{{ old('email') }}" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                @error('email')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('phone') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-telephone fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input type="text" class="form-control " name="phone" id="phone" value="{{ old('phone') }}" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                @error('phone')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('password') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-lock fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input type="password" class="form-control " name="password" id="password" value="{{ old('password') }}" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class=" col-md-12 row" style="margin-top: 10px">

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('user_image') }}</label>
                                <input type="file" class="form-control " name="user_image" id="user_image" aria-describedby="basic-addon3">
                                @error('user_image')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4" style="">
                                <label for="basic-url"class="form-label">{{translate('role')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-key fs-2"></i></span>
                                    <select multiple class="form-select " data-control="select2" name="user_role" id="user_role" data-placeholder="{{translate('select')}}">
                                        <option value="">{{translate('select')}}</option>
                                        @foreach($roles as $item)
                                            <option value="{{$item->name}}" {{ old('user_role') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_role')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group text-end" style="margin-top: 27px;">
                                <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat ">
                                    <i class="bi bi-save"></i> {{ translate('SaveButton') }}
                                </button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>








@endsection

@section('js')


    @notifyJs
    <script>
        $(document).ready(function() {
            $('#is_employee').change(function() {
                var empIdValue = $(this).val();
                if (empIdValue != 0) {
                    $('#input_div').hide(); // Hide full_name input
                    $('#select_div').show(); // Show emp_id select
                } else {
                    $('#input_div').show(); // Show full_name input
                    $('#select_div').hide(); // Hide emp_id select
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#is_employee").trigger("change");
            }, 300);
        });
    </script>
@endsection



