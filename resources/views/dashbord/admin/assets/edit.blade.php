@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{ translate('add_report') }}</h3>
                    <div class="card-toolbar">
                        {!! create_button(route('admin.Assets.index'), translate('back')) !!}

                    </div>
                </div>
                <form action="{{ route('admin.Assets.update',$all_data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="col-md-12 row">

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('asset_name') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control rounded-start-0" name="asset_name" id="asset_name" value="{{old('asset_name',$all_data->name)}}">

                                    </div>
                                </div>
                                @error('name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('assets_type') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="assets_type" id="assets_type" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach($assets_types as $item)
                                                <option value="{{ $item->id }}" {{ $all_data->assets_type == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('to_emp_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('received_by') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="received_by" id="received_by" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach($employees as $item)
                                                <option value="{{ $item->id }}" {{ $all_data->received_by == $item->id ? 'selected' : '' }}>{{ $item->employee }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('received_by')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>



                        </div>

                        <div class="col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('purchases_value') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!!form_icon('number')!!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input type="number" class="form-control rounded-start-0" name="purchases_value" id="purchases_value" value="{{old('purchases_value',$all_data->purchase_value)}}">

                                    </div>
                                </div>
                                @error('name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('supplier') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!!form_icon('select')!!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="supplier" id="supplier" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach($suppliers as $item)
                                                <option value="{{ $item->id }}" {{ $all_data->supplier == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('supplier')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{ translate('purchases_date') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input type="date" class="form-control rounded-start-0" name="purchases_date" id="purchases_date" value="{{old('purchases_date',$all_data->purchase_date)}}">

                                    </div>
                                </div>
                                @error('purchase_date')
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
    @notifyJs
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
