@extends('dashbord.layouts.master')
@section('css')
    <style>

        button, label, option, select, i {
            font-family: 'Noto Sans Arabic', 'Helvetica Neue', sans-serif;
            font-size: 16px;
            font-weight: bold !important;
        }

        input, select {
            border: 2px solid bold !important;
        }


        a, button {
            padding: 8px !important;
        }

    </style>
    @notifyCss
@endsection
@section('content')

    @include('dashbord.admin.clients.clients_nav')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">

            <div class="col-md-12 row">
                <div class="col-md-9">
                    <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                        <div class="card-header" style="background-color: #f8f9fa;">
                            <h3 class="card-title"></i> {{translate('clients_attachments')}}</h3>
                            <div class="card-toolbar">
                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('dashbord.admin.clients.clients_notes_form')

                            @include('dashbord.admin.clients.clients_notes_data')
                        </div>

                    </div>
                </div>


                <div class="col-md-3">
                    @include('dashbord.admin.load_v.client_data')

                </div>



            </div>

        </div>

    </div>









@endsection

@section('js')


    @notifyJs


@endsection



