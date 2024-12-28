@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{ translate('add_tawkel') }}</h3>
                    <div class="card-toolbar">
                        {!! create_button(route('admin.Tawkelate.index'), translate('back')) !!}

                    </div>
                </div>
                <form action="{{ route('admin.Tawkelate.store') }}" method="post" enctype="multipart/form-data" id="form_store">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12 row">

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('client') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="client_id" id="client_id" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach($clients as $item)
                                                <option value="{{ $item->id }}" {{ old('client_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('client_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('tawkel_type') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="tawkel_type" id="tawkel_type" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach($tawkel_type as $item)
                                                <option value="{{ $item->id }}" {{ old('tawkel_type') == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('tawkel_type')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('tawkel_number') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" name="tawkel_number" id="tawkel_number" value="{{old('tawkel_number')}}">

                                    </div>
                                </div>
                                @error('tawkel_number')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('client_phone') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" name="client_phone" id="client_phone" value="{{old('client_phone')}}">

                                    </div>
                                </div>
                                @error('client_phone')
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
                                        <input class="form-control rounded-start-0" name="email" id="email" value="{{old('email')}}">

                                    </div>
                                </div>
                                @error('email')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('tawkel_authority') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" name="tawkel_authority" id="tawkel_authority" value="{{old('tawkel_authority')}}">

                                    </div>
                                </div>
                                @error('tawkel_authority')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('documentation_date') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" type="date" name="documentation_date" id="documentation_date" value="{{old('documentation_date')}}">

                                    </div>
                                </div>
                                @error('documentation_date')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{ translate('tawkel_date') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" type="date" name="commercial_record" id="commercial_record" value="{{old('commercial_record')}}">

                                    </div>
                                </div>
                                @error('commercial_record')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('address') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" type="text" name="client_address" id="client_address" value="{{old('client_address')}}">

                                    </div>
                                </div>
                                @error('address')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('tawkel_image') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('image') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" type="file" name="tawkel_image" id="tawkel_image" value="{{old('tawkel_image')}}">

                                    </div>
                                </div>
                                @error('tawkel_image')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="mb-3">
                                <label for="notes" class="form-label">{{ translate('notes') }}</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" >{{ old('notes') }}</textarea>
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
