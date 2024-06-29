
@extends('dashbord.layouts.master')
@section('css')

@endsection
@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header">
                    <h3 class="card-title">{{ translate('legal_services') }}</h3>
                    <div class="card-toolbar">
                        <a class="btn btn-primary" href="{{ route('admin.create_legal_services') }}">
                            <i class="bi bi-plus fs-3"></i>{{translate('add_legal_services')}}
                        </a>
                    </div>
                </div>


                <div class="card-body">
                    <div class="" >
                        <table id="table1" class="table table-bordered">
                            <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th style="width: 5%"{{translate('m')}}></th>
                                <th style="text-align: center"> {{translate('client_name')}}</th>
                                <th style="text-align: center"> {{translate('type_of_service')}}</th>
                                <th style="text-align: center"> {{translate('esnad_to')}}</th>
                                <th style="text-align: center"> {{translate('cost_of_service')}}</th>
                                <th style="text-align: center"> {{translate('notes')}}</th>
                                <th style="width: 10%; text-align: center">{{translate('actions')}}</th>

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
        var save_method;
        var table;
        var dt;

    </script>


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
                    url: "{{ route('admin.data_legal_services') }}",
                },
                "columns": [
                    { data: 'id', className: 'text-center' },
                    { data: 'client_name', className: 'text-center' },
                    { data: 'type_of_service', className: 'text-center' },
                    { data: 'esnad_to', className: 'text-center' },
                    { data: 'cost_of_service', className: 'text-center' },
                    { data: 'notes', className: 'text-center' },
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







    {{--    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>--}}
    {{--    {!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\GeneralSettingsRequest', '#form') !!}--}}
@endsection
