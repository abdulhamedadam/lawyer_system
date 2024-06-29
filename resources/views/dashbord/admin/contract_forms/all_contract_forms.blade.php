@extends('dashbord.layouts.master')
@section('css')
    <style>
        /* Apply the custom font to the body */
        body {
            font-family: 'Montserrat', sans-serif; /* Use Montserrat font */
        }

        /* Style the textarea */
        #contract_body {
            width: 100vw; /* Set width relative to viewport width */
            max-width: 210mm; /* Set maximum width to A4 paper width */
            margin: 0 auto; /* Center the textarea */
            padding: 0; /* Remove padding */
            box-sizing: border-box; /* Ensure padding and border are included in the width */
        }
    </style>
    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid" >
        <div class="row col-md-12">
            <div class="col-md-3">
                @include('dashbord.admin.contract_forms.sidebar')
            </div>
            <div class="col-md-9">
                <div id="kt_app_content" class="app-content flex-column-fluid" >
                    <div id="kt_app_content_container" class="" style="padding-top: 20px" >
                        <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                            <div class="card-header">
                                <h3 class="card-title" id="contract_title">{{ translate('Contract_forms') }}</h3>
                                <div class="card-toolbar">
                                    <div class="text-center">
                                            <a class="btn btn-primary" href="{{ route('admin.add_contract_form') }}">
                                                <i class="bi bi-plus fs-1"></i> {{ translate('add_new_contract_form') }}
                                            </a>


                                    </div>
                                </div>
                            </div>


                            <div class="card-body">

                                <div class="col-md-12">
                                    <textarea name="contract_body"  rows="5" id="contract_body" cols="100" class="form-control editor_1" >{{$contract_body}}</textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="form-group text-end" style="margin-top: 27px;">
                                    <button name="printButton" onclick="print_contract()" id="printButton" value="print" class="btn btn-success btn-flat">
                                        <i class="bi bi-printer fs-2"></i> Print
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')


    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize CKEditor
            ClassicEditor
                .create(document.querySelector('.editor_1'), {
                    // The language code is defined in the https://en.wikipedia.org/wiki/ISO_639-1 standard.
                    language: 'ar'
                } )
                .then(editor => {
                    // Access the CKEditor instance and get its content
                    function print_contract() {
                        var contractBody = editor.getData();
                        // Proceed with your AJAX request
                        var request = $.ajax({
                            url: "{{ route('admin.generate_pdf') }}",
                            method: 'POST',
                            data: {contract_body: contractBody},
                        });
                        request.done(function (msg) {
                            var WinPrint = window.open('', '_blank');
                            WinPrint.document.write(msg);
                            WinPrint.document.close();
                            WinPrint.focus();
                            WinPrint.onafterprint = function () {
                                WinPrint.close();
                                console.log("Printing completed...");
                            }
                        });
                        request.fail(function (jqXHR, textStatus) {
                            console.log("Request failed: " + textStatus);
                        });
                    }
                    // Call the print_contract function when needed
                    document.getElementById("printButton").addEventListener("click", print_contract);
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>









    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Cases\CaseSettings', '#form') !!}
@endsection
