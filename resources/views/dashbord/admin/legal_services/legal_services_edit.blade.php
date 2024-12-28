@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection

@section('content')


        <div id="kt_app_content" class="app-content flex-column-fluid" >
            <div id="kt_app_content_container" class="t_container" >
                <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
                    <div class="card-header">
                        <h3 class="card-title"></i> {{translate('edit_legal_services')}}</h3>
                        <div class="card-toolbar">
                            <div class="text-center">
                                <a class="btn btn-primary" href="{{ route('admin.index_legal_services') }}">
                                    <i class="bi bi-arrow-clockwise fs-3"></i>{{translate('back')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <form  action="{{ route('admin.update_legal_services',$all_data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <div class="col-md-12 row">

                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('client_name')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <select class="form-select rounded-start-0" name="client_name" id="client_name"   data-placeholder="{{translate('select')}}">
                                        <option value="">{{translate('select')}}</option>
                                        @foreach($clients_names as $name)
                                            <option value="{{$name->id}}" {{ old('client_name',$all_data->id) == $name->id ? 'selected' : '' }}>{{$name->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('client_name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('type_of_service')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="type_of_service" id="type_of_service"   data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($types_of_services as $type)
                                                <option value="{{$type->id}}"{{ old('type_of_service',$all_data->type_of_service) == $type->id ? 'selected' : '' }}>{{$type->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @error('type_of_service')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('esnad_to')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="bi bi-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="esnad_to" id="esnad_to"   data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($all_employees as $employee)
                                                <option value="{{$employee->id}}"  {{ old('esnad_to',$all_data->esnad_to) == $employee->id ? 'selected' : '' }}>{{$employee->employee}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @error('esnad_to')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url"class="form-label">{{translate('cost_of_service')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">#</span>
                                    <input type="text"  class="form-control " name="cost_of_service"  id="cost_of_service" value="{{old('cost_of_service',$all_data->cost_of_service)}}"  aria-describedby="basic-addon3">
                                </div>
                                @error('cost_of_service')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>

                        <div class=" col-md-12 row" style="margin-top: 10px">

                            <div class="col-md-12" style="margin-top: 10px">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">{{translate('notes')}}</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3">{{old('notes',$all_data->notes)}}</textarea>
                                    @error('notes')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>

                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save fs-2"></i> {{ translate('SaveButton') }}
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



