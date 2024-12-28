@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{ translate('add_supplier') }}</h3>
                    <div class="card-toolbar">
                        {!! create_button(route('admin.Suppliers.index'), translate('back')) !!}

                    </div>
                </div>
                <form action="{{ route('admin.Suppliers.update',$all_data->id) }}" method="post" enctype="multipart/form-data" id="form_store">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="col-md-12 row">
                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('name') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" name="name" id="name" value="{{old('name',$all_data->name)}}">

                                    </div>
                                </div>
                                @error('name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('company_name') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" name="company_name" id="company_name" value="{{old('company_name',$all_data->company_name)}}">

                                    </div>
                                </div>
                                @error('company_name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('address') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" name="address" id="address" value="{{old('address',$all_data->address)}}">

                                    </div>
                                </div>
                                @error('address')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 row" style="margin-top: 10px">

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('email') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" name="email" id="email" value="{{old('email',$all_data->email)}}">

                                    </div>
                                </div>
                                @error('email')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('phone_number') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" name="phone_number" id="phone_number" value="{{old('phone_number',$all_data->phone_number)}}">

                                    </div>
                                </div>
                                @error('phone_number')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('tax_record') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" name="tax_record" id="tax_record" value="{{old('tax_record',$all_data->tax_record)}}">

                                    </div>
                                </div>
                                @error('tax_record')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('commercial_record') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" name="commercial_record" id="commercial_record" value="{{old('commercial_record',$all_data->commercial_record)}}">

                                    </div>
                                </div>
                                @error('commercial_record')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>


                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="mb-3">
                                <label for="notes" class="form-label">{{ translate('notes') }}</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" >{{ old('notes',$all_data->notes) }}</textarea>
                                @error('notes')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>





                    </div>

                    <div class="card-footer">
                        <div class="col-md-12">
                            <div class="form-group text-end" style="margin-top: 27px;">
                                <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat">
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


    <script>
        $(document).ready(function(){
            $('#related_to_case').on('change', function(){
                var value = $(this).val();
                if(value == 'yes') {
                    $('#case_id').prop('disabled', false);
                } else {
                    $('#case_id').prop('disabled', true);
                }
            });
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#details'), {
                language: 'ar', // Set the language to Arabic
                // OR
                // contentLanguageDirection: 'rtl', // Set content language direction to RTL
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
