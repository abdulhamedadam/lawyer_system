@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title">{{ translate('archive_data') }}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.add_archive') }}">
                                <i class="bi bi-plus fs-3"></i>{{translate('add_archive')}}
                            </a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive" >
                        <table id="table1" class="table table-bordered">
                            <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th style="width: 5%"> {{translate('m')}} </th>
                                <th style="text-align: center"> {{translate('archive_type')}}</th>
                                <th style="text-align: center"> {{translate('related_entity')}}</th>
                                <th style="text-align: center"> {{translate('secret_degree')}}</th>
                                <th style="width: 20%;text-align: center"> {{translate('place')}}</th>
                                <th style="text-align: center"> {{translate('action')}}</th>
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
                    language: {
                        url: "{{ asset('assets/Arabic.json') }}" // Assuming the file is placed in the public directory
                    },
                    ajax: {
                        url: "{{ route('admin.get_ajax_archive') }}",
                    },
                    columns: [
                        { data: 'id', className: 'text-center' },
                        { data: 'archive_type', className: 'text-center' },
                        { data: 'related_entity', className: 'text-center' },
                        { data: 'secret_degree', className: 'text-center' },
                        { data: 'place'},
                        { data: 'action', className: 'text-center' },
                    ],

                    columnDefs: [

                        {
                            "targets": [1],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'color': 'black',
                                    'vertical-align': 'middle',
                                    'text-decoration': 'underline'
                                });
                            }
                        },
                        {
                            "targets": [3,4],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'vertical-align': 'middle',

                                });
                            }
                        },
                        {
                            "targets": [2],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'color': '#6610f2',
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'vertical-align': 'middle',
                                    'text-decoration': 'underline'
                                });
                            }
                        },
                    ],
                    "buttons": [
                        { "extend": 'excel', "text": ' شيت اكسيل' },
                        { "extend": 'copy', "text": 'نسخ' }
                    ],
                    "dom": 'Bfrtip',


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


    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Employee\RolesRequest', '#form') !!}
@endsection
