@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">
            <div class="card shadow-sm " style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title"></i> {{translate('employees_attendace')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.attendance') }}">
                                <i class="bi bi-plus fs-1"></i> {{ translate('back') }}
                            </a>
                        </div>
                    </div>
                </div>
                <form id="attendance_form" action="{{ route('admin.save_attendance') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">{{translate('attendance_date')}}</label>
                                <div class="input-group flex-nowrap ">
                                    <span class="input-group-text" id="basic-addon3"><i
                                            class="bi bi-calendar fs-2 text-success"></i></span>
                                    <input type="date" class="form-control " name="attendance_date" id="attendance_date"
                                           value="{{date('Y-m-d')}}" aria-describedby="basic-addon3">
                                </div>
                                @error('case_num')
                                <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="" id="attend_table" style="margin-top: 30px">
                            @if(!empty($employees) && $employees->isNotEmpty())
                                <table id="table" class="example table table-bordered responsive nowrap text-center"
                                       cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr class="greentd" style="background-color: lightgrey">
                                        <th><i class="bi bi-hash fs-2 text-success"></i> {{ translate('hash') }}</th>
                                        <th><i class="bi bi-person fs-2 text-success"></i> {{ translate('employee') }}
                                        </th>
                                        <th>
                                            <i class="bi bi-check-square fs-2 text-success"></i> {{ translate('attendance') }}
                                        </th>
                                        <th>
                                            <i class="bi bi-clock fs-2 text-success"></i> {{ translate('attendance_time') }}
                                        </th>
                                        <th><i class="bi bi-clock fs-2 text-success"></i> {{ translate('leave_time') }}
                                        </th>
                                        <th><i class="bi bi-clipboard fs-2 text-success"></i> {{ translate('notes') }}
                                        </th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @php


                                    @endphp

                                    @foreach ($employees as $key1 => $row)
                                        <tr>
                                            <input type="hidden" name="row_id[]" value="{{ $row->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="fnt_center_blue">
                                                <input type="hidden" name="emp_id_{{ $row->id }}" id="emp_id_{{ $row->id }}" value="{{ $row->id }}">
                                                <span>{{ $row->employee }}</span>
                                            </td>
                                            <td style="color:black">
                                                @php
                                                    $attend_data = ['present' => translate('present'), 'absent' => translate('absent'), 'holiday' => translate('holiday'), 'late' => translate('late')];
                                                    $old_attendance = old('attendance_' . $row->id, isset($all_data[$key1]) ? $all_data[$key1]->attendance_status : null);
                                                @endphp
                                                @foreach ($attend_data as $key => $value)
                                                    <input style="margin: 5px" type="radio"
                                                           id="attendance_{{ $row->id }}"
                                                           name="attendance_{{ $row->id }}"
                                                           value="{{ $key }}" {{ $old_attendance == $key || ($loop->first && $key == 'present') ? 'checked' : '' }}> {{ $value }}
                                                @endforeach
                                            </td>
                                            <td style="color: green">
                                                <input type="time"
                                                       name="attendance_time_{{ $row->id }}"
                                                       id="attendance_time_{{ $row->id }}"
                                                       value="{{ old('attendance_time_' . $row->id, isset($all_data[$key1]) ? $all_data[$key1]->attendance_time : null) }}">
                                            </td>
                                            <td style="color: darkred">
                                                <input type="time"
                                                       name="leave_time_{{ $row->id }}"
                                                       id="leave_time_{{ $row->id }}"
                                                       value="{{ old('leave_time_' . $row->id, isset($all_data[$key1]) ? $all_data[$key1]->leave_time : null) }}">
                                            </td>
                                            <td class="fnt_center_blue">
                                                <input class="form-control" type="text"
                                                       name="notes_{{ $row->id }}"
                                                       id="notes_{{ $row->id }}"
                                                       value="{{ old('notes_' . $row->id, isset($all_data[$key1]) ? $all_data[$key1]->notes : null) }}">
                                            </td>
                                        </tr>
                                    @endforeach



                                    </tbody>

                                </table>


                            @endif
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save fs-2"></i> {{ translate('SaveButton') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>








@endsection

@section('js')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\Clients\ClientsStoreRequest', '#store_form') !!}
@endsection



