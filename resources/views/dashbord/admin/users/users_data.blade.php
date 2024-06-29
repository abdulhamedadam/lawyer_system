@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title">{{ translate('all_users') }}</h3>
                    <div class="card-toolbar">

                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.add_user') }}">
                                <i class="bi bi-plus fs-3"></i>{{translate('add_user')}}
                            </a>
                        </div>


                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table1" class="table table-bordered">
                            <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th style="width: 5%"{{translate('m')}}<</th>
                                <th style="text-align: center"> {{translate('name')}}</th>
                                <th style="text-align: center"> {{translate('user_name')}}</th>
                                <th style="text-align: center"> {{translate('role_in_system')}}</th>
                                <th style="text-align: center"> {{translate('job_title')}}</th>
                                <th style="text-align: center"> {{translate('status')}}</th>
                                <th style="width: 30%; text-align: center"> {{translate('actions')}}</th>
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
                        url: "{{ route('admin.get_ajax_users') }}",
                    },
                    columns: [
                        { data: 'id', className: 'text-center' },
                        { data: 'name', className: 'text-center' },
                        { data: 'user_name', className: 'text-center' },
                        { data: 'role', className: 'text-center' },
                        { data: 'job_title', className: 'text-center' },
                        { data: 'status', className: 'text-center' },
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
                            "targets": [2,3,4,5,6],
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).css({
                                    'font-weight': '600',
                                    'text-align': 'center',
                                    'vertical-align': 'middle',

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
