@extends('dashbord.layouts.master')
@section('css')

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
                            @include('dashbord.admin.clients.attachment_form')

                            @include('dashbord.admin.clients.attachment_data')
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
    <script>
        function get_city(id) {
            $.ajax({
                url: "{{ route('admin.get_city', ['id' => '__id__']) }}".replace('__id__', id),
                type: "get",
                dataType: "html",
                success: function (html) {
                    $('#city_id').html(html);
                },
            });
        }
    </script>
    <script>
        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>
    <script>
        function numeric_only(event, input) {
            if ((event.which < 32) || (event.which > 126)) return true;
            return jQuery.isNumeric($(input).val() + String.fromCharCode(event.which));
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\Admin\Clients\ClientsStoreRequest', '#store_form') !!}
@endsection



