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

                            <div class="col-md-4" >
                                <label for="basic-url"class="form-label">{{translate('Client')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="client_id" id="client_id"    data-placeholder="{{translate('select')}}">
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

                            <div class="col-md-4" >
                                <label for="basic-url"class="form-label">{{translate('case_number')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-address-card fs-2"></i></span>
                                    <input type="text"  class="form-control " name="case_num"  id="case_num" value="{{$case_num}}"  aria-describedby="basic-addon3" readonly>
                                </div>
                                @error('case_num')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4" >
                                <label for="basic-url"class="form-label">{{translate('case_title')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-address-card fs-2"></i></span>
                                    <input type="text"  class="form-control " name="case_title"  id="case_title" value="{{old('case_title')}}"  aria-describedby="basic-addon3" >
                                </div>
                                @error('case_title')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class=" col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-4" >
                                <label for="basic-url"class="form-label">{{translate('case_type')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
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

                            <div class="col-md-4" >
                                <label for="basic-url"class="form-label">{{translate('courts')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
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

                            <div class="col-md-4" >
                                <label for="basic-url"class="form-label">{{translate('case_status')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="case_status" id="case_status"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($case_status as $item)
                                                <option value="{{$item->id}}" {{ old('case_status') == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('case_status')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class=" col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-4" >
                                <label for="basic-url"class="form-label">{{translate('case_fees')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-address-card fs-2"></i></span>
                                    <input type="number" step="0.01" class="form-control " name="fees"  id="fees" value="{{old('fees')}}"  aria-describedby="basic-addon3" >
                                </div>
                                @error('case_title')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4" style="">
                                <label for="basic-url"class="form-label">{{translate('start_date')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-address-card fs-2"></i></span>
                                    <input type="date"  class="form-control " name="start_date"  id="start_date" value="{{old('start_date')}}"  aria-describedby="basic-addon3" >
                                </div>
                                @error('start_date')
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
                                <button type="submit" name="add" value="add" id="add_ezn" class="btn btn-success btn-flat ">
                                    <i class="fa fa-save"></i> <?= translate('SaveButton') ?>
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



@endsection



