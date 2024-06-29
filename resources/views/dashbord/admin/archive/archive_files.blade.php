@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">


            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h3 class="card-title"></i> {{translate('archive_files')}}</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                        </div>
                    </div>
                </div>

                <div class="card-body" style="padding-left: 0px !important;">
                    <div class="col-md-12 row">
                        <div class="col-md-8">
                            @include('dashbord.admin.archive.archive_files_form')

                            @include('dashbord.admin.archive.archive_files_data')
                        </div>
                        <div class="col-md-4">
                            @include('dashbord.admin.load_v.archive_data')

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
        function get_shelf(id)
        {
            $.ajax({
                url: "{{ route('admin.get_shelf', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#shelf_id').html(html);
                },
            });
        }
    </script>

    @notifyJs

@endsection



