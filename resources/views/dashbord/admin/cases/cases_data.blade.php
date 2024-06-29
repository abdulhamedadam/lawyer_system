@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title">{{ translate('Cases_list') }}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.add_case') }}">
                                <i class="bi bi-plus fs-1"></i> {{ translate('add_case') }}
                            </a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="">
                        <table id="table1" class="table table-bordered">
                            <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th style="width: 5%">{{ translate('hash') }}</th>
                                <th style="text-align: center"> {{ translate('case_number') }}</th>
                                <th style="text-align: center"> {{ translate('client_name') }}</th>
                                <th style="text-align: center">{{ translate('case_title') }}</th>
                                <th style="text-align: center"> {{ translate('case_type') }}</th>
                                <th style="text-align: center"> {{ translate('court') }}</th>
                                <th style="text-align: center"> {{ translate('fees') }}</th>
                                <th style="text-align: center"> {{ translate('total_paid') }}</th>
                                <th style="text-align: center"> {{ translate('remain') }}</th>
                                <th style="text-align: center">{{ translate('status') }}</th>
                                <th style="width: 20%; text-align: center"> {{ translate('actions') }}</th>
                            </tr>
                            </thead>
                            <tbody> <!-- Adjust the height as per your requirement -->
                            <!-- Your table rows here -->
                            </tbody>
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
                    url: "{{ route('admin.get_ajex_notes') }}",
                },
                "columns": [
                    { data: 'id', className: 'text-center' },
                    { data: 'case_num', className: 'text-center' },
                    { data: 'client_name', className: 'text-center' },
                    { data: 'case_title', className: 'text-center' },
                    { data: 'case_type', className: 'text-center' },
                    { data: 'court', className: 'text-center' },
                    { data: 'fees', className: 'text-center' },
                    { data: 'total_paid', className: 'text-center' },
                    { data: 'remain', className: 'text-center' },
                    { data: 'case_status', className: 'text-center' },
                    { data: 'action', className: 'text-center' },
                ],
                "columnDefs": [
                    {
                        "targets": [ 1,-1 ], //last column
                        "orderable": false, //set not orderable
                    },
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
                        "targets": [2,5,7],
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
                        url: "{{ route('admin.get_ajex_notes') }}",
                    },
                    columns: [
                        { data: 'id', className: 'text-center' },
                        { data: 'case_num', className: 'text-center' },
                        { data: 'client_name', className: 'text-center' },
                        { data: 'case_title', className: 'text-center' },
                        { data: 'case_type', className: 'text-center' },
                        { data: 'court', className: 'text-center' },
                        { data: 'fees', className: 'text-center' },
                        { data: 'case_status', className: 'text-center' },
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
                            "targets": [2,5,7],
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
