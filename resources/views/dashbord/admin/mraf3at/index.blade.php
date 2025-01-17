@extends('dashbord.layouts.master')
@section('css')
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div id="kt_app_content_container" class="t_container"  >
            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">

                @php
                    generateCardHeader('Mraf3at', 'admin.Mraf3at.create', 'add');
                    $headers = [
                        'hash',
                        'case_num',
                        'client_name',
                        'case_title',
                        'case_type',
                        'source',
                        'mraf3a_name',
                        'addition_date',
                        'mraf3a_text',
                        'actions'
                    ];
                    generateTable($headers);
                @endphp

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
                    url: "{{ route('admin.Mraf3at.index') }}",
                },
                "columns": [
                    { data: 'id', className: 'text-center' },
                    { data: 'case_num', className: 'text-center' },
                    { data: 'client_name', className: 'text-center' },
                    { data: 'case_name', className: 'text-center' },
                    { data: 'case_type', className: 'text-center' },
                    { data: 'source', className: 'text-center' },
                    { data: 'mraf3a_name', className: 'text-center' },
                    { data: 'addition_date', className: 'text-center' },
                    { data: 'mraf3a_text', className: 'text-center' },
                    { data: 'action', className: 'text-center' },
                ],
                "columnDefs": [
                    {
                        "targets": [ 1,-1 ], //last column
                        "orderable": false, //set not orderable
                    },
                    {
                        "targets": [1, 3, 2],
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

@endsection
