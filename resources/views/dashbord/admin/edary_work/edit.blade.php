@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{ translate('edit_edary_work') }}</h3>
                    <div class="card-toolbar">
                        {!! create_button(route('admin.edary_work.index'), translate('back')) !!}
                    </div>
                </div>
                <form action="{{ route('admin.edary_work.update', $edaryWork->id) }}" method="post"
                    enctype="multipart/form-data" id="form_store">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="col-md-12 row">
                            <div class="col-md-3">
                                <label for="estlam_date" class="form-label">{{ translate('estlam_date') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                    <input type="date" class="form-control" name="estlam_date" id="estlam_date"
                                        value="{{ old('estlam_date', $edaryWork->estlam_date) }}"
                                        aria-describedby="basic-addon3">
                                </div>
                                @error('estlam_date')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="date_authority" class="form-label">{{ translate('date_authority') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                    <input type="date" class="form-control" name="date_authority" id="date_authority"
                                        value="{{ old('date_authority', $edaryWork->date_authority) }}"
                                        aria-describedby="basic-addon3">
                                </div>
                                @error('date_authority')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="client_id" class="form-label">{{ translate('Client') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" onchange="get_tawkel(this.value)"
                                            name="client_id" id="client_id" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach ($clients as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('client_id', $edaryWork->client_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('client_id')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="phone" class="form-label">{{ translate('phone') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        value="{{ old('phone', $edaryWork->phone) }}" aria-describedby="basic-addon3"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="tawkel_id" class="form-label">{{ translate('tawkelate') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="tawkel_id" id="tawkel_id"
                                            data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach ($tawkelate as $tawkel)
                                                <option value="{{ $tawkel->id }}" {{ old('tawkel_id', $edaryWork->tawkel_id) == $tawkel->id ? 'selected' : '' }} data-tawkel-type="{{ $tawkel->TawkelType->title }}">
                                                    {{ translate('tawkel_number') }}: {{ $tawkel->tawkel_number }}  ــــــــــــــــ {{ $tawkel->client_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('tawkel_id')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="tawkel_type" class="form-label">{{ translate('tawkel_type') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" class="form-control" name="tawkel_type" id="tawkel_type"
                                        value="{{ old('tawkel_type', $edaryWork->tawkelat->TawkelType->title ?? '') }}"
                                        aria-describedby="basic-addon3" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="edary_work_type"
                                    class="form-label">{{ translate('edary_work_type') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="edary_work_type"
                                            id="edary_work_type" data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('select') }}</option>
                                            @foreach ($edary_types as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('edary_work_type', $edaryWork->edary_work_type) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('edary_work_type')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="esnad_to_id" class="form-label">{{ translate('esnad_to') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="esnad_to_id" id="esnad_to_id"
                                            data-placeholder="{{ translate('select') }}">
                                            <option value="">{{ translate('Select') }}</option>
                                            @foreach ($emps as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('esnad_to_id', $edaryWork->esnad_to_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->employee }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('esnad_to_id')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="subject_entity" class="form-label">{{ translate('subject_entity') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" class="form-control" name="subject_entity" id="subject_entity"
                                        value="{{ old('subject_entity', $edaryWork->subject_entity) }}"
                                        aria-describedby="basic-addon3">
                                </div>
                                @error('subject_entity')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="authority_entity"
                                    class="form-label">{{ translate('authority_entity') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" class="form-control" name="authority_entity"
                                        id="authority_entity"
                                        value="{{ old('authority_entity', $edaryWork->authority_entity) }}"
                                        aria-describedby="basic-addon3">
                                </div>
                                @error('authority_entity')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="subject_entity_address"
                                    class="form-label">{{ translate('subject_entity_address') }}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text" class="form-control" name="subject_entity_address"
                                        id="subject_entity_address"
                                        value="{{ old('subject_entity_address', $edaryWork->subject_entity_address) }}"
                                        aria-describedby="basic-addon3">
                                </div>
                                @error('subject_entity_address')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="total_fees"class="form-label">{{ translate('total_fees') }}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="number" class="form-control " name="total_fees" id="total_fees"
                                        value="{{ old('total_fees', $edaryWork->total_fees) }}"
                                        aria-describedby="basic-addon3">
                                </div>
                                @error('total_fees')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="mb-3">
                                <label for="subject" class="form-label">{{ translate('subject') }}</label>
                                <textarea class="form-control" id="subject" name="subject" rows="3">{{ old('subject', $edaryWork->subject) }}</textarea>
                                @error('subject')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-12">
                                <div class="form-group text-end" style="margin-top: 27px;">
                                    <button type="submit" name="add" value="add" id="add_ezn"
                                        class="btn btn-success btn-flat">
                                        <i class="bi bi-save"></i> {{ translate('SaveButton') }}
                                    </button>
                                </div>
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
        //     function get_tawkel(id) {
        //     if (!id) {
        //         $('#tawkel_id').empty();
        //         $('#tawkel_id').append('<option value="">{{ translate('select') }}</option>');
        //         $('#phone').val('');
        //         return;
        //     }
        //     $.ajax({
        //         url: "{{ route('admin.get_client_tawkel', ['id' => '__id__']) }}".replace('__id__', id),
        //         type: "get",
        //         dataType: "json",
        //         success: function (response) {
        //             $('#tawkel_id').empty();
        //             $('#tawkel_id').append('<option value="">{{ translate('select') }}</option>');
        //             if (response.tawkelate && response.tawkelate.length > 0) {
        //                 response.tawkelate.forEach(function (tawkel) {
        //                     $('#tawkel_id').append(
        //                         '<option value="' + tawkel.id + '" data-tawkel-type="' + (tawkel.tawkel_type ? tawkel.tawkel_type.title : '') + '">' +
        //                         '{{ translate('tawkel_number') }} : ' + tawkel.tawkel_number +
        //                         '  ــــــــــــــــ ' + tawkel.client_name +
        //                         '</option>'
        //                     );
        //                 });
        //             }

        //             $('#phone').val(response.phone || '');
        //         },

        //         error: function () {
        //             alert('{{ translate('Failed to fetch data') }}');
        //         }
        //     });
        // }


        // $(document).on('change', '#tawkel_id', function () {
        //     var selectedOption = $(this).find('option:selected');
        //     var tawkelType = selectedOption.data('tawkel-type') || '';
        //     console.log('000000==='+selectedOption)
        //     $('#tawkel_type').val(tawkelType);
        // });
        function get_tawkel(id) {
            if (!id) {
                $('#tawkel_id').empty();
                $('#tawkel_id').append('<option value="">{{ translate('select') }}</option>');
                $('#phone').val('');
                $('#tawkel_type').val('');
                return;
            }

            $.ajax({
                url: "{{ route('admin.get_client_tawkel', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "json",
                success: function(response) {
                    $('#tawkel_id').empty();
                    $('#tawkel_id').append('<option value="">{{ translate('select') }}</option>');
                    if (response.tawkelate && response.tawkelate.length > 0) {
                        response.tawkelate.forEach(function(tawkel) {
                            $('#tawkel_id').append(
                                '<option value="' + tawkel.id + '" data-tawkel-type="' + (tawkel.tawkel_type ? tawkel.tawkel_type.title : '') + '"' +
                                (tawkel.id == "{{ old('tawkel_id', $edaryWork->tawkel_id) }}" ?
                                    ' selected' : '') + '>' +
                                '{{ translate('tawkel_number') }} : ' + tawkel.tawkel_number +
                                '  ــــــــــــــــ ' + tawkel.client_name +
                                '</option>'
                            );
                        });
                    }

                    $('#phone').val(response.phone || '');
                },

                error: function() {
                    alert('{{ translate('Failed to fetch data') }}');
                }
            });
        }

        $(document).ready(function() {
            var clientId = $('#client_id').val();
            if (clientId) {
                get_tawkel(clientId);
            }

            $(document).on('change', '#tawkel_id', function() {
                var selectedOption = $(this).find('option:selected');
                var tawkelType = selectedOption.data('tawkel-type') || '';
                $('#tawkel_type').val(tawkelType);
            });
        });
    </script>
@endsection
