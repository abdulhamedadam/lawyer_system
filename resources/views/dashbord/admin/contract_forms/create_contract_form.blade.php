@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{ translate('add_contract_form') }}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.contract_forms_data') }}">
                                <i class="bi bi-arrow-clockwise fs-3"></i>{{ translate('back') }}
                            </a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.save_contract') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <label for="description" class="form-label">{{ translate('contract_name') }}</label>
                                <input class="form-control" id="contract_name" name="contract_name">
                                @error('contract_name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="mb-3">
                                <label for="description" class="form-label">{{ translate('contract_body') }}</label>
                                <textarea class="form-control" id="contract_body" name="contract_body" rows="3" >{{ old('details') }}</textarea>
                                @error('contract_name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
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
            .create(document.querySelector('#contract_body1'), {
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
