@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container" >
            <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{translate('add_client')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.clients_data') }}">
                                <i class="bi bi-arrow-clockwise fs-3"></i>{{translate('back')}}
                            </a>
                        </div>
                    </div>
                </div>

                <form  action="{{ route('admin.save_case') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="col-md-12 row">

                            <div class="col-md-1" >
                                <label for="basic-url"class="form-label">{{translate('case_num')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('number') !!}</span>
                                    <input type="text"  class="form-control " name="case_num"  id="case_num" value="{{$case_num}}"  aria-describedby="basic-addon3" >
                                </div>
                                @error('case_num')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            @php
                                $years = getYears(2000, date('Y'));
                            @endphp
                            <div class="col-md-2" >
                                <label for="basic-url"class="form-label">{{translate('for_year')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="year" id="year"   data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($years as $item)
                                                <option value="{{$item}}" {{ old('year',date('Y')) == $item ? 'selected' : '' }}>{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('year')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('Client')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" onchange="get_tawkel(this.value)" name="client_id" id="client_id"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($clients as $item)
                                                <option value="{{$item->id}}" {{ old('client_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('client_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3" >
                                <label for="basic-url" class="form-label">{{translate('case_title')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text"  class="form-control " name="case_title"  id="case_title" value="{{old('case_title')}}"  aria-describedby="basic-addon3" >
                                </div>
                                @error('case_title')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('case_receiving_date')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('date') !!}</span>
                                    <input type="date"  class="form-control " name="receiving_date"  id="receiving_date" value="{{old('receiving_date')}}"  aria-describedby="basic-addon3" >
                                </div>
                                @error('receiving_date')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class=" col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('case_type')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="case_type" id="case_type"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($case_type as $item)
                                                <option value="{{$item->id}}" {{ old('case_type') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('case_type')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('litigation_degree')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="litigation_degree" id="litigation_degree"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($litigation_degree as $item)
                                                <option value="{{$item->id}}" {{ old('litigation_degree') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('litigation_degree')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('tawkelate')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="tawkel_id" id="tawkel_id"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                        </select>
                                    </div>
                                </div>
                                @error('tawkel_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('tawkel_type')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text"  class="form-control " name="tawkel_type"  id="tawkel_type" value=""  aria-describedby="basic-addon3" readonly>
                                </div>
                            </div>
                        </div>

                        <div class=" col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('khesm_name')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text"  class="form-control " name="khesm_name"  id="khesm_name" value=""  aria-describedby="basic-addon3" >
                                    @error('khesm_name')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3" >
                                <label for="basic-url" class="form-label">{{translate('khesm_type')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="khesm_type" id="khesm_type"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($khesm_type as $item)
                                                <option value="{{$item->id}}" {{ old('khesm_type') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('khesm_type')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('khesm_phone')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text"  class="form-control " name="khesm_phone"  id="khesm_phone" value=""  aria-describedby="basic-addon3" >
                                    @error('khesm_phone')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('khesm_email')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('email') !!}</span>
                                    <input type="text"  class="form-control " name="khesm_email"  id="khesm_email" value=""  aria-describedby="basic-addon3" >
                                    @error('khesm_email')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>



                        <div class=" col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('courts')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="court_id" id="court_id"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($courts as $item)
                                                <option value="{{$item->id}}" {{ old('court_id') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('court_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('circle_name')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('text') !!}</span>
                                    <input type="text"  class="form-control " name="circle_name"  id="circle_name" value="{{old('circle_name')}}"  aria-describedby="basic-addon3" >
                                    @error('circle_name')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('lawyer')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3">{!! form_icon('select') !!}</span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="lawyer" id="lawyer"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($emps as $item)
                                                <option value="{{$item->id}}" {{ old('lawyer') == $item->id ? 'selected' : '' }}>{{$item->employee}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('lawyer')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3" >
                                <label for="basic-url"class="form-label">{{translate('case_fees')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-address-card fs-2"></i></span>
                                    <input type="number" step="0.01" class="form-control " name="fees"  id="fees" value="{{old('fees')}}"  aria-describedby="basic-addon3" >
                                </div>
                                @error('case_title')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>




                        </div>

                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="mb-3">
                                <label for="notes" class="form-label">{{translate('notes')}}</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{old('notes')}}</textarea>
                                @error('notes')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group text-end" style="margin-top: 27px;">
                                <button type="submit" name="add"  class="btn btn-success btn-flat ">
                                    <i class="bi bi-save fs-3"></i> <?= translate('SaveButton') ?>
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
        function get_tawkel(id) {
            $.ajax({
                url: "{{ route('admin.get_client_tawkel', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "json",
                success: function (response) {
                    $('#tawkel_id').empty();
                    $('#tawkel_id').append('<option value="">{{ translate('select') }}</option>');
                    if (response.tawkelate && response.tawkelate.length > 0) {
                        response.tawkelate.forEach(function (tawkel) {
                            $('#tawkel_id').append(
                                '<option value="' + tawkel.id + '" data-tawkel-type="' + (tawkel.tawkel_type ? tawkel.tawkel_type.title : '') + '">' +
                                '{{translate('tawkel_number')}} : ' + tawkel.tawkel_number +
                                '  ــــــــــــــــ ' + tawkel.client_name +
                                '</option>'
                            );
                        });
                    }
                },

                error: function () {
                    alert('{{ translate('Failed to fetch data') }}');
                }
            });
        }


        $(document).on('change', '#tawkel_id', function () {
            var selectedOption = $(this).find('option:selected');
            var tawkelType = selectedOption.data('tawkel-type') || '';
            console.log('000000==='+selectedOption)
            $('#tawkel_type').val(tawkelType);
        });
    </script>


@endsection



