@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h3 class="card-title">{{ translate('Tawkelate') }}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.Tawkelate.create') }}">
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
                                <th style="text-align: center"> {{ translate('tawkel_type') }}</th>
                                <th style="text-align: center">{{ translate('client') }}</th>
                                <th style="text-align: center"> {{ translate('tawkel_number') }}</th>
                                <th style="text-align: center"> {{ translate('tawkel_authority') }}</th>
                                <th style="text-align: center"> {{ translate('client_phone') }}</th>
                                <th style="text-align: center"> {{ translate('tawkel_date') }}</th>
                                <th style="text-align: center"> {{ translate('tawkel_image') }}</th>
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
                    url: "{{ route('admin.Tawkelate.index') }}",
                },
                "columns": [
                    { data: 'id', className: 'text-center' },
                    { data: 'tawkel_type', className: 'text-center' },
                    { data: 'client', className: 'text-center' },
                    { data: 'tawkel_number', className: 'text-center' },
                    { data: 'tawkel_authority', className: 'text-center' },
                    { data: 'client_phone', className: 'text-center' },
                    { data: 'tawkel_date', className: 'text-center' },
                    { data: 'tawkel_image', className: 'text-center' },
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

    <script>
        function showImagePopup(imageUrl) {
            const popup = document.createElement('div');
            popup.style.position = 'fixed';
            popup.style.top = '50%';
            popup.style.left = '50%';
            popup.style.transform = 'translate(-50%, -50%)';
            popup.style.backgroundColor = '#fff';
            popup.style.padding = '10px';
            popup.style.border = '1px solid #ccc';
            popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
            popup.style.zIndex = 1000;

            const img = document.createElement('img');
            img.src = imageUrl;
            img.style.maxWidth = '90vw';
            img.style.maxHeight = '90vh';

            const closeBtn = document.createElement('button');
            closeBtn.textContent = 'Close';
            closeBtn.style.marginTop = '10px';
            closeBtn.style.cursor = 'pointer';
            closeBtn.onclick = () => {
                document.body.removeChild(popup);
            };

            popup.appendChild(img);
            popup.appendChild(closeBtn);
            document.body.appendChild(popup);
        }
    </script>




    {{--    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>--}}
    {{--    {!! JsValidator::formRequest('App\Http\Requests\Admin\Setting\GeneralSettingsRequest', '#form') !!}--}}
@endsection
