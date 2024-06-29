@extends('dashbord.layouts.master')
@section('css')
    <style>

        th,button,label, option, select,i {
            font-family:  'Arial','Noto Sans Arabic','Helvetica Neue', sans-serif;
            font-size: 16px;
            font-weight: bold !important;
            /*padding-left: 0 !important;*/
        }

        input, select {
            border: 2px solid bold !important;
        }


        a, button{
            padding: 8px !important;
        }

        .nav-separator {
            margin: 0.5rem 0; /* Adjust the margin as needed */
            border: none;
            border-bottom: 1px solid #ddd; /* Change the color and style as needed */
        }

    </style>
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div class="row col-md-12">
            <div class="col-md-3">
                @include('dashbord.admin.Hr.hr_settings.sidebar')
            </div>
            <div class="col-md-9">
                <div id="kt_app_content" class="app-content flex-column-fluid" >
                    <div id="kt_app_content_container" class="" style="padding-top: 20px" >
                        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                            <div class="card-header">
                                <h3 class="card-title">{{ translate('hr_settings') }}</h3>
                                <div class="card-toolbar">
                                    <div class="text-center">
                                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalsettings" >
                                            <i class="bi bi-plus fs-1"></i> {{ translate('add') }}
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive" >
                                    <table id="table1" class="table table-bordered">
                                        <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th style="width: 5%"{{translate('m')}}<</th>
                                            <th style="text-align: center"> {{translate('mokalfa_name')}}</th>
                                            <th style="text-align: center"> {{translate('details')}}</th>
                                            <th style="width: 20%; text-align: center"> {{translate('actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" id="modalsettings">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?=translate('hr_settings')?></h3>


                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1">&times;</i>
                    </div>

                </div>
                <form method="post" action="{{route('admin.add_hr_settings',$type)}}" enctype="multipart/form-data" id="form">
                    @csrf
                    <input type="hidden" name="row_id" id="row_id" value="">
                    <div class="row col-md-11" style="margin: 10px">
                            <label for="setting_name" class="form-label">{{translate('mokalfa_name')}}</label>
                            <input type="text" class="form-control" name="setting_name" id="setting_name" value="">
                    </div>
                    <div class="col-md-11" style="margin-top:10px;margin-right: 10px">
                            <label for="exampleTextarea" class="form-label">{{translate('details')}}</label>
                            <textarea class="form-control" name="details" id="details" rows="3">{{old('details')}}</textarea>
                    </div>

                    <div class="modal-footer" style="margin-top: 10px">
                        <button type="submit"  name="submit" value="add"  class="btn btn-primary">{{translate('save')}} </button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{translate('cancel')}}</button>
                    </div>
                </form>


            </div>
        </div>
    </div>


@endsection
@section('js')


    "use strict";
    <script type="text/javascript">
        var save_method; // For the save method string
        var table;
        var dt;

    </script>


    <script>
        "use strict";
        var KTDatatablesServerSide = function () {

            var initDatatable = function () {
                table = $("#table1").DataTable({
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    order: [[1, 'desc']],
                    stateSave: true,
                    ajax: {
                        url: "{{ route('admin.get_ajax_hr_settings',$type) }}",
                    },
                    columns: [
                        { data: 'id', className: 'text-center' },
                        { data: 'name', className: 'text-center' },
                        { data: 'details', className: 'text-center' },
                        { data: 'action', className: 'text-center' },
                    ],

                    columnDefs: [

                        {
                            "targets": [1],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'color': '#6610f2',
                                    'font-family':  'Arial',
                                    'vertical-align': 'middle',
                                });
                            }
                        },
                        {
                            "targets": [3,2],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'vertical-align': 'middle',
                                });
                            }
                        },



                    ],

                });
            };

            return {
                init: function () {
                    initDatatable();
                }
            };
        }();

        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesServerSide.init();
        });
    </script>


    <script>
        function edit_setting(id)
        {
            $.ajax({
                url: "{{ route('admin.edit_hr_settings', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "json",
                success: function (data) {
                    var allData = data.all_data;
                    console.log(allData);
                    $('#row_id').val(allData.id);
                    $('#setting_name').val(allData.title);
                    $('#details').val(allData.details);

                },
            });
        }
    </script>













    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Hr\StoreSettingsRequests', '#form') !!}
@endsection
