@extends('dashbord.layouts.master')
@section('css')
    <style>

        button,label, select,i {
            font-family:  'Noto Sans Arabic','Helvetica Neue','Arial', sans-serif;
            font-size: 16px;
            font-weight: bold !important;
        }

        input, select {
            border: 2px solid bold !important;
        }


        a,button{
            padding: 8px !important;
        }

        .custom-btn {
            width: 130px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
        }

        .custom-btn .badge {
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .custom-btn .bi {
            margin-bottom: 5px; /* Adjust as needed */
        }
        .custom-btn .fas {
            font-size: 2em; /* Adjust the size as needed */
        }



    </style>
    @notifyCss
@endsection
@section('content')

    @include('dashbord.admin.tasks.tasks_nav')

    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container" >
            <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{translate('edit_tasks')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">

                        </div>
                    </div>
                </div>

                <form  action="{{ route('admin.update_task',$all_task_data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12 row">

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{translate('creation_date')}}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-calendar-alt fs-2"></i></span>
                                    <input type="date" class="form-control" name="ensha_data" id="ensha_data" value="{{old('ensha_data', $all_task_data->ensha_data)}}" aria-describedby="basic-addon3">
                                </div>
                                @error('ensha_data')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{translate('task_name')}}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-user fs-2"></i></span>
                                    <input type="text" class="form-control" name="task_name" id="task_name" value="{{old('task_name',$all_task_data->task_name)}}" aria-describedby="basic-addon3">
                                </div>
                                @error('task_name')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{translate('case_name')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="case_id" id="case_id"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($cases as $item)
                                                <option value="{{$item->id}}" {{ old('case_id',$all_task_data->case_id_fk) == $item->id ? 'selected' : '' }}>{{$item->case_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('case_id')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>



                        </div>

                        <div class=" col-md-12 row" style="margin-top: 10px">
                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{translate('assign_to')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="esnad_to" id="esnad_to"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($emps as $item)
                                                <option value="{{$item->id}}" {{ old('esnad_to',$all_task_data->esnad_to) == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('esnad_to')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{translate('priority')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i class="fa-solid fa-caret-down fs-2"></i></span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select class="form-select rounded-start-0" name="priority" id="priority"    data-placeholder="{{translate('select')}}">
                                            <option value="">{{translate('select')}}</option>
                                            @foreach($priority as $item)
                                                <option value="{{$item->id}}" {{ old('priority',$all_task_data->priority_id_fk) == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('priority')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{translate('start_date')}}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-calendar-alt fs-2"></i></span>
                                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{old('ensha_data',$all_task_data->start_date)}}" aria-describedby="basic-addon3">
                                </div>
                                @error('start_date')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">{{translate('end_date')}}</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-calendar-alt fs-2"></i></span>
                                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{old('end_date',$all_task_data->end_date)}}" aria-describedby="basic-addon3">
                                </div>
                                @error('end_date')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 10px">
                            <div>
                                <label for="exampleTextarea" class="form-label">{{translate('details')}}</label>
                                <textarea class="form-control" name="details" id="exampleTextarea" rows="3">{{old('details',$all_task_data->task_notes)}}</textarea>
                                @error('details')
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



