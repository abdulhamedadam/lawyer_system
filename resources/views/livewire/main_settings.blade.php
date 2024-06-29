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

    </style>
    @livewireStyles
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title">{{ translate('case_settings') }}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalsettings" >
                                <i class="bi bi-plus fs-1"></i> {{ translate('add') }}
                            </a>
                        </div>
                    </div>
                </div>
{{--                 @livewire('case_settings')--}}

                {{--                <div class="card-body">--}}
                {{--                    <div class="table-responsive" >--}}
                {{--                        <table id="table1" class="table table-bordered">--}}
                {{--                            <thead>--}}
                {{--                            <tr class="fw-bold fs-6 text-gray-800">--}}
                {{--                                <th style="width: 5%"{{translate('m')}}<</th>--}}
                {{--                                <th style="text-align: center"><i class="fas fa-user"></i> {{translate('name')}}</th>--}}
                {{--                                <th style="text-align: center"><i class="fas fa-user"></i> {{translate('color')}}</th>--}}
                {{--                                <th style="width: 20%; text-align: center"><i class="fas fa-cogs"></i> {{translate('actions')}}</th>--}}
                {{--                            </tr>--}}
                {{--                            </thead>--}}
                {{--                            <tbody>--}}

                {{--                        </table>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>


    {{--    <div class="modal fade" tabindex="-1" id="modalsettings">--}}
    {{--        <div class="modal-dialog">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h3 class="modal-title"><?=translate('recieve_task')?></h3>--}}


    {{--                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">--}}
    {{--                        <i class="ki-duotone ki-cross fs-1">&times;</i>--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--                <form method="post" action="" enctype="multipart/form-data">--}}
    {{--                    <div class="row col-md-12" style="margin-top: 10px">--}}
    {{--                    <div class="col-md-6" >--}}
    {{--                        <label for="setting_name" class="form-label">{{translate('name')}}</label>--}}
    {{--                        <input class="form-control" name="setting_name" id="setting_name" value="" >--}}
    {{--                    </div>--}}
    {{--                        <div class="col-md-6" >--}}

    {{--                            <label for="color" class="form-label">{{translate('color')}}</label>--}}
    {{--                            <input class="form-control" name="color" id="takeemcolor_reason" value="" >--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                    <div class="modal-footer" style="margin-top: 10px">--}}
    {{--                        <button type="submit"  name="submit" value="add"  class="btn btn-primary">{{translate('save')}} </button>--}}
    {{--                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{translate('cancel')}}</button>--}}
    {{--                    </div>--}}
    {{--                </form>--}}


    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
@section('js')

    @livewireScripts
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
                        url: "{{ route('admin.get_ajax_clients') }}",
                    },
                    columns: [
                        { data: 'id', className: 'text-center' },
                        { data: 'client_name', className: 'text-center' },
                        { data: 'phone_number', className: 'text-center' },
                        { data: 'current_address', className: 'text-center' },
                        { data: 'job_title', className: 'text-center' },
                        { data: 'national_id', className: 'text-center' },
                        { data: 'related_lawsuits', className: 'text-center' },
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
                            "targets": [3],
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


@endsection
