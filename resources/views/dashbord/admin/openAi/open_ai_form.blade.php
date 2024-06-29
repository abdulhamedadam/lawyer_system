@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container" >
            <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{translate('ask_ai')}}</h3>
                    <div class="card-toolbar">
                    </div>
                </div>

                <form action="{{ route('admin.generateText') }}" method="post" enctype="multipart/form-data">

                @csrf
                    <div class="card-body">

                    <div class="col-md-12" style="margin-top: 10px">
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ translate('ask!') }}</label>
                            <textarea class="form-control" id="prompt" name="prompt" rows="3">{{ old('description') }}</textarea>
                            @error('description')
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

                @if(session('generated_text'))
                    <h2>Generated Text:</h2>
                    <p>{{ session('generated_text') }}</p>
                @endif

            </div>
        </div>
    </div>








@endsection

@section('js')


    @notifyJs



@endsection



