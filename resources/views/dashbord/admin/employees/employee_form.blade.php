@extends('dashbord.layouts.master')
@section('css')
    <style>

        button,label, select,i {
            font-family:'Helvetica Neue','Arial', sans-serif;
            font-size: 18px;
            font-weight: bold !important;
        }

        input, select {
            border: 2px solid bold !important;
        }


        a,button{
            padding: 8px !important;
        }

    </style>
    @notifyCss
@endsection
@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container" >
            <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{translate('add_employee')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.employee_data') }}">
                                <i class="bi bi-arrow-clockwise fs-3"></i>{{translate('back')}}
                            </a>
                        </div>
                    </div>
                </div>

                <form  action="{{ route('admin.save_employee') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12 row">
                            <div class="col-md-2" >
                                <label for="basic-url"class="form-label">{{translate('employee_code')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <input type="text"  class="form-control " name="employee_code"  id="employee_code" value="{{$employee_code}}"  readonly>
                                </div>
                            </div>
                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('employee_name')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-person fs-2"></i></span>
                                    <input type="text"  class="form-control " name="employee_name"  id="employee_name" value="{{old('employee_name')}}"  aria-describedby="basic-addon3">
                                </div>
                                @error('employee_name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2" >
                                <label for="basic-url"class="form-label">{{translate('Nationality')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="nationality_id" id="nationality_id"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($nationalites as $item)
                                                <option value="{{$item->id}}" {{ old('nationality_id') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('nationality_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2" >
                                <label for="basic-url"class="form-label">{{translate('gender')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="gender" id="gender"   data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($gender as $item)
                                                <option value="{{$item->id}}"{{ old('gender') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @error('gender')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('National_id')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <input type="number"  class="form-control " name="national_id" maxlength="14" id="national_id" value="{{old('national_id')}}" aria-describedby="basic-addon3">
                                </div>
                                @error('national_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class=" col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('date_of_barth')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar fs-2"></i></span>
                                    <input type="date"  class="form-control"  name="date_of_barth"  id="date_of_barth" value="{{old('date_of_barth')}}"  aria-describedby="basic-addon3">
                                </div>
                                @error('date_of_barth')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('address')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-geo-alt fs-2"></i></span>
                                    <input type="text"  class="form-control " name="address"  id="address" value="{{old('address')}}"  aria-describedby="basic-addon3">
                                </div>
                                @error('address')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('religion')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="religion" id="religion"   data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($religions as $item)
                                                <option value="{{$item->id}}" {{ old('religion') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('religion')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('material_status')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="marital_status" id="marital_status"   data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($material_status as $item)
                                                <option value="{{$item->id}}" {{ old('marital_status') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('material_status')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class=" col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('job')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="job_title" id="job_title"   data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($jobs as $item)
                                                <option value="{{$item->id}}" {{ old('job_title') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('job_title')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('phone_number')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-geo-alt fs-2"></i></span>
                                    <input type="text"  class="form-control " name="phone_number"  id="phone_number" value="{{old('phone_number')}}"  aria-describedby="basic-addon3">
                                </div>
                                @error('phone_number')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('whats_number')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-whatsapp fs-2"></i></span>
                                    <input type="text"  class="form-control " name="whats_number"  id="whats_number" value="{{old('whats_number')}}"  aria-describedby="basic-addon3">
                                </div>
                                @error('whats_number')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('governate')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="governate_id" id="governate_id" onchange="get_city(this.value)" data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($governates as $item)
                                                <option value="{{$item->id}}" {{ old('governate_id') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('governate_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{translate('city')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="city_id" id="city_id" value="{{old('city_id')}}" data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                        </select>
                                    </div>
                                </div>
                                @error('city_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('start_work_date')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar fs-2"></i></span>
                                    <input type="date"  class="form-control"  name="start_work_date"  id="start_work_date" value="{{old('start_work_date')}}"  aria-describedby="basic-addon3">
                                </div>
                                @error('start_work_date')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="basic-url"class="form-label">{{translate('end_contract_date')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar fs-2"></i></span>
                                    <input type="date"  class="form-control"  name="end_contract_date"  id="end_contract_date" value="{{old('start_work_date')}}"  aria-describedby="basic-addon3">
                                </div>
                                @error('end_contract_date')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="basic-url"class="form-label">{{translate('test_num_month')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar fs-2"></i></span>
                                    <input type="number"  class="form-control"  name="test_num_month"  id="test_num_month" value="{{old('test_num_month')}}"  aria-describedby="basic-addon3">
                                </div>
                                @error('test_num_month')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="basic-url"class="form-label">{{translate('end_test_date')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar fs-2"></i></span>
                                    <input type="date"  class="form-control"  name="end_test_date"  id="end_test_date" value="{{old('end_test_date')}}"  aria-describedby="basic-addon3">
                                </div>
                                @error('end_test_date')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('direct_manager')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="manager" id="manager"   data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($emolyees as $item)
                                                <option value="{{$item->id}}" {{ old('manager') == $item->id ? 'selected' : '' }}>{{$item->employee}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('manager')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('qualifications')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="qualifications" id="qualifications"   data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($qualifications as $item)
                                                <option value="{{$item->id}}" {{ old('qualifications') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('qualifications')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('degrees')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="degrees" id="degrees"   data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($degrees as $item)
                                                <option value="{{$item->id}}" {{ old('degrees') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('degrees')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>




                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('personal_photo')}}</label>
                                <input   class="form-control " type="file" name="file" id="file" aria-describedby="basic-addon3">
                            </div>


                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{translate('email')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-envelope fs-2"></i></span>
                                    <input type="text"  class="form-control"  name="email"  id="email" value="{{old('email')}}"  aria-describedby="basic-addon3">
                                </div>
                                @error('email')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>





                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save fs-2"></i> {{ translate('SaveButton') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>








@endsection

@section('js')


    @notifyJs
    <script>
        function get_city(id)
        {
            $.ajax({
                url: "{{ route('admin.get_city', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#city_id').html(html);
                },
            });
        }
    </script>
    <script>
        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>
    <script>
        function numeric_only (event, input) {
            if ((event.which < 32) || (event.which > 126)) return true;
            return jQuery.isNumeric ($(input).val () + String.fromCharCode (event.which));
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\Clients\ClientsStoreRequest', '#store_form') !!}
@endsection



