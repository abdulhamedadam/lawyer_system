
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

        .class_label {
            font-size: 14px;
            font-weight: bold;
            color: black;
            background: #fffbdc;
            border: 1px solid #ccc;
        }

        .class_result {
            color: blue;
            font-weight: 600;
            border: 1px solid #ccc;
        }

    </style>
    @notifyCss
@endsection
@section('content')

    @include('dashbord.admin.tasks.task_details_nav')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">


            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h3 class="card-title"></i> {{translate('task_details')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                        </div>
                    </div>
                </div>

                <div class="card-body" style="padding-left: 0px !important;">
                    <div class="col-md-12 row">
                        <div class="col-md-8">
                            @include('dashbord.admin.tasks.task_comments')
                        </div>
                        <div class="col-md-4">
                            @include('dashbord.admin.load_v.task_data')

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    </div>









@endsection

@section('js')


    @notifyJs

@endsection




