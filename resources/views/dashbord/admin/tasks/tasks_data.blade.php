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
                    <h3 class="card-title">{{ translate('all_tasks') }}</h3>
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
                                <th style="width: 8%;text-align: center"> {{ translate('evaluation_result') }}</th>
                            </tr>

                            </thead>
                            <tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>

        $(document).ready(function() {
            //datatables
            table = $('#table').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
                },
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "{{ route('admin.get_ajex_all_tasks') }}",
                },
                "columns": [
                    { data: 'id', className: 'text-center' },
                    { data: 'case_name', className: 'text-center' },
                    { data: 'ensha_date', className: 'text-center' },
                    { data: 'task_type', className: 'text-center' },
                    { data: 'task_name', className: 'text-center' },
                    { data: 'priority', className: 'text-center' },
                    { data: 'employee', className: 'text-center' },
                    { data: 'date', className: 'text-center' },
                    { data: 'peroid', className: 'text-center' },
                    { data: 'assigned_to', className: 'text-center' },
                    { data: 'action', className: 'text-center' },
                    { data: 'evaluation_result', className: 'text-center' },
                ],
                "columnDefs": [
                    {
                        "targets": [ 1,-1 ], //last column
                        "orderable": false, //set not orderable
                    },
                    {
                        "targets": [0,1],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('font-weight','600');
                            $(td).css('text-align','center');
                            $(td).css('color','black');

                        }
                    },
                    {
                        "targets": [2],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('font-weight','600');
                            $(td).css('text-align','center');
                            $(td).css('color','purple');

                        }
                    },

                    {
                        "targets": [4,3],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('font-weight','600');
                            $(td).css('text-align','center');
                            $(td).css('color','red');

                        }
                    },


                ],
                "order" : [],
                "dom": 'Bfrtip',
                "buttons": [
                    { "extend": 'excel', "text": ' شيت اكسيل' },
                    { "extend": 'copy', "text": 'نسخ' }
                ],
            });

            $("input").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("select").change(function(){
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
        });
    </script>
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
                        url: "{{ route('admin.get_ajex_all_tasks') }}",
                    },
                    columns: [
                        { data: 'id', className: 'text-center' },
                        { data: 'case_name', className: 'text-center' },
                        { data: 'ensha_date', className: 'text-center' },
                        { data: 'task_type', className: 'text-center' },
                        { data: 'task_name', className: 'text-center' },
                        { data: 'priority', className: 'text-center' },
                        { data: 'employee', className: 'text-center' },
                        { data: 'date', className: 'text-center' },
                        { data: 'peroid', className: 'text-center' },
                        { data: 'assigned_to', className: 'text-center' },
                        { data: 'action', className: 'text-center' },
                        { data: 'evaluation_result', className: 'text-center' },
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
                        {
                            "targets": [11],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'color': 'black',
                                    'vertical-align': 'middle',
                                });

                                if (cellData === 'do') {
                                    console.log('dooo::'+cellData)
                                    $(td).css({
                                        'background-color': 'lightblue',
                                    });
                                } else if (cellData === 'doing') {
                                    $(td).css({
                                        'background-color': 'lightyellow',
                                    });
                                } else if (cellData === 'done') {
                                    $(td).css({
                                        'background-color': 'lightgreen',
                                    });
                                } else if (cellData === 'canceled') {
                                    $(td).css({
                                        'background-color': 'indianred',
                                    });
                                } else {
                                    // Handle the default case (optional)
                                    $(td).css({
                                        'background-color': '', // Set to default background color or remove this line
                                    });
                                }
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













    {{--    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>--}}
    {{--    {!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\GeneralSettingsRequest', '#form') !!}--}}
@endsection
