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
    @notifyCss
@endsection
@section('content')
    @include('dashbord.admin.tasks.tasks_nav')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title">{{ translate('outcomming_tasks') }}</h3>
                    <div class="card-toolbar">

                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive" >
                        <table id="table1" class="table table-bordered">
                            <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th style="width: 3%">{{ translate('hash') }}</th>
                                <th style="width: 8%;text-align: center"> {{ translate('case_name') }}</th>
                                <th style="width: 8%;text-align: center"> {{ translate('ensha_date') }}</th>
                                <th style="width: 5%;text-align: center"> {{ translate('task_type') }}</th>
                                <th style="width: 8%;text-align: center"> {{ translate('task_name') }}</th>
                                <th style="width: 8%;text-align: center"> {{ translate('priority') }}</th>
                                <th style="width: 18%;text-align: center"> {{ translate('employee') }}</th>
                                <th style="width: 12%;text-align: center"> {{ translate('date') }}</th>
                                <th style="width: 8%;text-align: center">{{ translate('peroid') }}</th>
                                <th style="width: 8%;text-align: center"> {{ translate('assigned_to') }}</th>
                                <th style="width: 8%;text-align: center"> {{ translate('actions') }}</th>

                            </tr>

                            </thead>
                            <tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="modaltakeem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?=translate('recieve_task')?></h3>


                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1">&times;</i>
                    </div>

                </div>

                <div id="result_info">

                </div>

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
                        url: "{{ route('admin.get_ajex_evaluate_tasks') }}",
                    },
                    columns: [
                        { data: 'id', className: 'text-center' },
                        { data: 'case_name', className: 'text-center' },
                        { data: 'ensha_date',className: 'text-center' },
                        { data: 'task_type', className: 'text-center' },
                        { data: 'task_name', className: 'text-center' },
                        { data: 'priority',  className: 'text-center' },
                        { data: 'employee',  className: 'text-center' },
                        { data: 'date',      className: 'text-center' },
                        { data: 'peroid',    className: 'text-center' },
                        { data: 'assigned_to', className: 'text-center' },
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
                            "targets": [3,4,6,5,8,9,10],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'vertical-align': 'middle',
                                });
                            }
                        },
                        {
                            "targets": [2,7],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'color': 'green',
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
        function takeem_pop_form(id)
        {
            $.ajax({
                url: "{{ route('admin.takeem_task', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {

                    $('#result_info').html(html);
                },
            });
        }
    </script>










    {{--    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>--}}
    {{--    {!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\GeneralSettingsRequest', '#form') !!}--}}
@endsection
