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
        <div id="kt_app_content" class="app-content flex-column-fluid" >
            <div id="kt_app_content_container" class="t_container"  >
                <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                    <div class="card-header">
                        <h3 class="card-title">{{ translate('clients_data') }}</h3>
                        <div class="card-toolbar">
                            <div class="text-center">
                                <a class="btn btn-primary" href="{{ route('admin.add_client_form') }}">
                                    <i class="bi bi-plus fs-1"></i> {{ translate('add_client') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="">
                            <table id="table1" class="table table-bordered">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th style="width: 5%"{{translate('m')}}<</th>
                                    <th style="text-align: center"> {{translate('client_name')}}</th>
                                    <th style="text-align: center">{{translate('phone_number')}}</th>
                                    <th style="text-align: center"> {{translate('current_address')}}</th>
                                    <th style="text-align: center">{{translate('job_title')}}</th>
                                    <th style="text-align: center">{{translate('national_id')}}</th>
                                    <th style="text-align: center"> {{translate('related_lawsuits')}}</th>
                                    <th style="text-align: center"> {{translate('total_financial_dues')}}</th>
                                     <th style="text-align: center"> {{translate('total_paid')}}</th>
                                     <th style="text-align: center"> {{translate('remain')}}</th>
                                    <th style=" text-align: center"> {{translate('actions')}}</th>

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
            table = $('#table1').DataTable({
                "language": {
                    url: "{{ asset('assets/Arabic.json') }}"
                },
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "{{ route('admin.get_ajax_clients') }}",
                },
                "columns": [
                    { data: 'id', className: 'text-center' },
                    { data: 'client_name', className: 'text-center' },
                    { data: 'phone_number', className: 'text-center' },
                    { data: 'current_address', className: 'text-center' },
                    { data: 'job_title', className: 'text-center' },
                    { data: 'national_id', className: 'text-center' },
                    { data: 'related_lawsuits', className: 'text-center' },
                    { data: 'total_financial_dues', className: 'text-center' },
                    { data: 'total_paid', className: 'text-center' },
                    { data: 'remain', className: 'text-center' },
                    { data: 'action', className: 'text-center' },
                ],
                "columnDefs": [
                    {
                        "targets": [ 1,-1 ], //last column
                        "orderable": false, //set not orderable
                    },
                    {
                        "targets": [0,1,5],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('font-weight','600');
                            $(td).css('text-align','center');
                            $(td).css('color','blue');
                            $(td).css('font-size','16');
                            $(td).css('text-decoration','underline');
                            $(td).css('vertical-align','vertical-align');



                        }
                    },
                    {
                        "targets": [2],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('font-weight','600');
                            $(td).css('text-align','center');
                            $(td).css('color','purple');
                            $(td).css('vertical-align','vertical-align');

                        }
                    },

                    {
                        "targets": [3],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('font-weight','600');
                            $(td).css('text-align','center');
                            $(td).css('text-decoration','underline');
                            $(td).css('color','green');
                            $(td).css('vertical-align','vertical-align');
                        }
                    },

                    {
                        "targets": [4],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('font-weight','600');
                            $(td).css('text-align','center');
                            $(td).css('text-decoration','underline');
                            $(td).css('color','red');
                            $(td).css('vertical-align','vertical-align');

                        }
                    },
                    {
                        "targets": [5,6,7,8],
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('font-weight','600');
                            $(td).css('text-align','center');
                            $(td).css('color','black');
                            $(td).css('vertical-align','vertical-align');

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
                table = $("#table").DataTable({
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
                            "targets": [3,4,6],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'vertical-align': 'middle',
                                });
                            }
                        },
                        {
                            "targets": [2,5],
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













    {{--    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>--}}
    {{--    {!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\GeneralSettingsRequest', '#form') !!}--}}
@endsection
