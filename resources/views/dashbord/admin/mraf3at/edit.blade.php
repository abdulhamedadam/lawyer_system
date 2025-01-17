@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{ translate('edit_mraf3a') }}</h3>
                    <div class="card-toolbar">
                        {!! create_button(route('admin.Mraf3at.index'), translate('back')) !!}

                    </div>
                </div>
                <form action="{{ route('admin.Mraf3at.update',$mraf3a) }}" method="post" enctype="multipart/form-data" id="form_store">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="col-md-12 row">
                            <div class="col-md-3">
                                <label for="case_id" class="form-label">{{ translate('case') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="case_id" id="case_id" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('Select') }}</option>
                                            @foreach ($cases as $item)
                                                <option value="{{ $item->id }}" {{ old('case_id', $mraf3a->case_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->case_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('case_id')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="source" class="form-label">{{ translate('source') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" class="form-control" name="source" id="source" value="{{ old('source', $mraf3a->source) }}" aria-describedby="basic-addon3">
                                </div>
                                @error('source')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="mraf3a_name" class="form-label">{{ translate('mraf3a_name') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" class="form-control" name="mraf3a_name" id="mraf3a_name" value="{{ old('mraf3a_name', $mraf3a->mraf3a_name) }}" aria-describedby="basic-addon3">
                                </div>
                                @error('mraf3a_name')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="addition_date" class="form-label">{{ translate('addition_date') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                    <input type="date" class="form-control" name="addition_date" id="addition_date" value="{{ old('addition_date', $mraf3a->addition_date) }}" aria-describedby="basic-addon3">
                                </div>
                                @error('addition_date')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>


                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="mb-3">
                                <label for="mraf3a_text" class="form-label">{{ translate('mraf3a_text') }}</label>
                                <textarea class="form-control" id="mraf3a_text" name="mraf3a_text" rows="3">{{ old('mraf3a_text', $mraf3a->mraf3a_text) }}</textarea>
                                @error('mraf3a_text')
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
    <script>
        function showImagePopup(imageUrl) {
            const popup = document.createElement('div');
            popup.style.position = 'fixed';
            popup.style.top = '50%';
            popup.style.left = '50%';
            popup.style.transform = 'translate(-50%, -50%)';
            popup.style.backgroundColor = '#fff';
            popup.style.padding = '10px';
            popup.style.border = '1px solid #ccc';
            popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
            popup.style.zIndex = 1000;

            const img = document.createElement('img');
            img.src = imageUrl;
            img.style.maxWidth = '90vw';
            img.style.maxHeight = '90vh';

            const closeBtn = document.createElement('button');
            closeBtn.textContent = 'Close';
            closeBtn.style.marginTop = '10px';
            closeBtn.style.cursor = 'pointer';
            closeBtn.onclick = () => {
                document.body.removeChild(popup);
            };

            popup.appendChild(img);
            popup.appendChild(closeBtn);
            document.body.appendChild(popup);
        }
    </script>

@endsection
