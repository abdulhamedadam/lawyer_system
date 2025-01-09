@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">


            <div class="card shadow-sm" style="border-top: 3px solid #007bff;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h3 class="card-title"></i> ChatGPT</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                        </div>
                    </div>
                </div>

                <div class="card-body" style="padding-left: 0px !important;">


                    <div class="col-md-12" style="margin-top: 10px">
                        <div class="mb-3">
                            <label for="notes" class="form-label">{{translate('notes')}}</label>
                            <textarea class="form-control" id="message" rows="5" cols="40" name="message"
                                      placeholder="Type your message here..."></textarea>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-end" style="margin-top: 27px;">
                            <button type="submit" name="send" value="add" id="send" class="btn btn-success btn-flat ">
                                <i class="fa fa-save"></i> Send
                            </button>
                        </div>
                    </div>


                    <div id="response"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')


    <script>
        $(document).ready(function () {
            $('#send').on('click', function () {
                const message = $('#message').val();
                console.log('Message:', message); // Debugging output

                $.ajax({
                    url: '{{ route('admin.ask_ai') }}', // Ensure this is a valid route
                    type: 'POST',
                    data: {
                        message: message,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        console.log('Success:', response); // Debugging output
                        $('#response').text(JSON.stringify(response, null, 2));
                    },
                    error: function (xhr) {
                        console.error('Error:', xhr.responseText); // Debugging output
                        $('#response').text('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>



@endsection


