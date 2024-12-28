@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h3 class="card-title">{{ translate('assets') }}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.Assets.create') }}">
                                <i class="bi bi-plus fs-1"></i> {{ translate('add') }}
                            </a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="">
                        <table id="table1" class="table table-bordered" style="table-layout: fixed;">
                            <thead style="background-color: #f8f9fa;">
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th style="width: 5%">{{ translate('hash') }}</th>
                                <th style="text-align: center"> {{ translate('asset_name') }}</th>
                                <th style="text-align: center">{{ translate('asset_type') }}</th>
                                <th style="text-align: center"> {{ translate('purchases_value') }}</th>
                                <th style="text-align: center"> {{ translate('purchases_date') }}</th>
                                <th style="text-align: center"> {{ translate('supplier') }}</th>
                                <th style="text-align: center"> {{ translate('received_by') }}</th>
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


    <div class="modal fade" id="modaldetails"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModal-pdf-label">{{translate('details')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="details">

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
                    url: "{{ route('admin.Assets.index') }}",
                },
                "columns": [
                    { data: 'id', className: 'text-center' },
                    { data: 'asset_name', className: 'text-center' },
                    { data: 'asset_type', className: 'text-center' },
                    { data: 'purchases_value', className: 'text-center' },
                    { data: 'purchases_date', className: 'text-center' },
                    { data: 'supplier', className: 'text-center' },
                    { data: 'received_by', className: 'text-center' },
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

                                'vertical-align': 'middle',
                            });
                        }
                    },
                    {
                        "targets": [3,],
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
                        url: "{{ route('admin.Assets.index') }}",
                    },
                    columns: [
                        { data: 'id', className: 'text-center' },
                        { data: 'asset_name', className: 'text-center' },
                        { data: 'asset_type', className: 'text-center' },
                        { data: 'purchases_value', className: 'text-center' },
                        { data: 'purchases_date', className: 'text-center' },
                        { data: 'supplier', className: 'text-center' },
                        { data: 'received_by', className: 'text-center' },
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
    <script>
        function get_details(id)
        {
            $.ajax({
                url: "{{ route('admin.get_details', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (data) {
                    $('#details').html(data);
                    $('#details1').prop('readonly', true); // Set the textarea as readonly
                    initializeClassicEditor();
                },
            });
        }

        function initializeClassicEditor() {
            ClassicEditor
                .create(document.querySelector('#details1'), {
                    language: 'ar', // Set the language to Arabic
                    // OR
                    // contentLanguageDirection: 'rtl', // Set content language direction to RTL
                })
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    </script>





    {{--    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>--}}
    {{--    {!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\GeneralSettingsRequest', '#form') !!}--}}
@endsection
