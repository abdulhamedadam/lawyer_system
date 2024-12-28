@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h3 class="card-title">{{ translate('suppliers') }}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.Suppliers.create') }}">
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
                                <th style="text-align: center"> {{ translate('name') }}</th>
                                <th style="text-align: center">{{ translate('company_name') }}</th>
                                <th style="text-align: center"> {{ translate('address') }}</th>
                                <th style="text-align: center"> {{ translate('phone_number') }}</th>
                                <th style="text-align: center"> {{ translate('tax_record') }}</th>
                                <th style="text-align: center"> {{ translate('commercial_record') }}</th>
                                <th style="text-align: center"> {{ translate('email') }}</th>
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
                    url: "{{ route('admin.Suppliers.index') }}",
                },
                "columns": [
                    { data: 'id', className: 'text-center' },
                    { data: 'name', className: 'text-center' },
                    { data: 'company_name', className: 'text-center' },
                    { data: 'address', className: 'text-center' },
                    { data: 'phone_number', className: 'text-center' },
                    { data: 'tax_record', className: 'text-center' },
                    { data: 'commercial_record', className: 'text-center' },
                    { data: 'email', className: 'text-center' },
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
        var save_method;
        var table;
        var dt;

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
