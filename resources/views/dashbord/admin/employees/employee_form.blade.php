@extends('dashbord.layouts.master')
@section('css')

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
                            <div class="col-md-3" >
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

                            <div class="col-md-3" >
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
                                    <button type="button" class="btn btn-primary" onclick="show_settings('gender','gender')" style="padding: 10px !important;" data-bs-toggle="modal" data-bs-target="#add_setting">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
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
                                    <button type="button" class="btn btn-primary" onclick="show_settings('religion','religion')" style="padding: 10px !important;" data-bs-toggle="modal" data-bs-target="#add_setting">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
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
                                    <button type="button" class="btn btn-primary" onclick="show_settings('material_status','marital_status')" style="padding: 10px !important;" data-bs-toggle="modal" data-bs-target="#add_setting">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
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
                                    <button type="button" class="btn btn-primary" onclick="show_settings('jobs','job_title')" style="padding: 10px !important;" data-bs-toggle="modal" data-bs-target="#add_setting">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
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
                                    <button type="button" class="btn btn-primary" onclick="show_settings('qualifications','qualifications')" style="padding: 10px !important;" data-bs-toggle="modal" data-bs-target="#add_setting">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
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
                                    <button type="button" class="btn btn-primary" onclick="show_settings('degrees','degrees')" style="padding: 10px !important;" data-bs-toggle="modal" data-bs-target="#add_setting">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
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

                            <div class="col-md-4" >
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
                                    <button type="button" class="btn btn-primary" onclick="show_settings('nationality','nationality_id')" style="padding: 10px !important;" data-bs-toggle="modal" data-bs-target="#add_setting">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                                @error('nationality_id')
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

    <div class="modal fade" id="add_setting" tabindex="-1" aria-labelledby="addNationalityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <span id="success_message" class="text-success d-none" style="width:100%;background-color: #98d298;text: white;padding: 10px; border-radius: 5px; margin-top: 10px; margin-bottom: 10px;"></span>

                    </div>
                    <br>
                    <div id="show_setting">



                    </div>
                </div>
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






    <script>
        function showSuccessMessage(message) {
            $('#success_message').text(message).removeClass('d-none').show();
            setTimeout(function() {
                $('#success_message').fadeOut().addClass('d-none');
            }, 8000);
        }
    </script>
    <script>
        function show_settings(type,input_id) {
            $('#title_modal').text('add '+ type);
            $.ajax({
                url: "{{ route('admin.show_setting') }}",
                type: "get",
                data: { type: type,input_id:input_id },
                dataType: "html",
                success: function (html) {
                    $('#show_setting').html(html);
                },
            });
        }
    </script>


    <script>
        function add_setting(type,input_id) {
            var title = $('#title_setting').val();

            if (title.trim() !== '') {
                $.ajax({
                    url: "{{ route('admin.add_popup_setting') }}",
                    type: "post",
                    data: { title: title, type: type },
                    dataType: "json",
                    success: function (response) {
                        show_settings(type);
                        var newOption = new Option(response.title, response.id, true, true);
                        $('#'+input_id).append(newOption).trigger('change');
                        showSuccessMessage('Setting added successfully!');
                    },
                });
            } else {
                $('#error_title').text('هذا الحق ضروري!');
            }
        }
    </script>

    <script>
        function edit_setting(id, input_id, title) {
            $('#title_setting').val(title); // Set the title in the input field
            $('#id').val(id); // Set the title in the input field
            $('#save-btn').hide(); // Hide the save button
            $('#update-btn').show(); // Show the update button
        }
    </script>
    <script>
        function update_setting(type,input_id) {
            var title = $('#title_setting').val();
            var id = $('#id').val();

            if (title.trim() !== '') {
                $.ajax({
                    url: "{{ route('admin.update_popup_setting') }}",
                    type: "post",
                    data: { title: title, type: type,id:id },
                    dataType: "json",
                    success: function (response) {
                        show_settings(type,input_id);
                        $('#' + input_id).empty();

                        // Append new options from the response
                        response.settings.forEach(function(setting) {
                            var newOption = new Option(setting.title, setting.id, false, false);
                            $('#' + input_id).append(newOption);
                        });

                        // Trigger change event
                        $('#' + input_id).trigger('change');
                        $('#success_message').text('Setting updated successfully!').removeClass('d-none').delay(3000).fadeOut();
                    },
                });
            } else {
                $('#error_title').text('هذا الحق ضروري!');
            }
        }
    </script>
    <script>
        function delete_setting(id,type,input_id) {
            if (confirm("Are you sure you want to delete this setting?")) {
                $.ajax({
                    url: "{{ route('admin.delete_popup_setting') }}",
                    type: "post",
                    data: { id: id,type:type },
                    dataType: "json",
                    success: function (response) {
                        showSuccessMessage('Setting deleted successfully!');
                        show_settings(type,input_id);
                        $('#' + input_id).empty();

                        // Append new options from the response
                        response.settings.forEach(function(setting) {
                            var newOption = new Option(setting.title, setting.id, false, false);
                            $('#' + input_id).append(newOption);
                        });

                        // Trigger change event
                        $('#' + input_id).trigger('change');
                    },
                    error: function (xhr, status, error) {
                        // Handle error if needed
                        console.error(xhr.responseText);
                    }
                });
            }
        }
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\Clients\ClientsStoreRequest', '#store_form') !!}
@endsection



