@extends('dashbord.layouts.master')
@section('css')

    @notifyCss
@endsection
@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="t_container">


            <div class="card shadow-sm" style=" padding:20px;border-top: 3px solid #007bff;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h3 class="card-title">Ask Ai</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                        </div>
                    </div>
                </div>

                <div class="card-body" style="padding-left: 0px !important;">

                    <div class="col-md-12" style="margin-top: 10px">
                        <div class="mb-3">
                            <label for="notes" class="form-label">{{translate('notes')}}</label>
                            <textarea class="form-control" id="message" rows="5" cols="40" name="message" placeholder="Type your message here..."></textarea>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-end" style="margin-top: 27px;">
                            <button type="submit" name="send" value="add" id="send" class="btn btn-success btn-flat ">
                                <i class="fa fa-save"></i> Send
                            </button>
                        </div>
                    </div>

                    <div class="card" style="margin-top: 20px; border: 1px solid #ddd; border-radius: 8px; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <div class="card-body" style="font-size: 1.2rem; color: #333;">
                            <div id="chat-container">
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
        $(document).ready(function () {
            $('#send').on('click', function () {
                const message = $('#message').val();

                if (message.trim() === '') {
                    alert('Please type a message before sending.');
                    return;
                }

                const userMessageHtml = `<div class="user-message" style="margin-bottom: 10px; color: blue">
            <strong>You:</strong> ${message}
        </div>`;
                $('#chat-container').append(userMessageHtml);
                $('#message').val('');

                $.ajax({
                    url: '{{ route('admin.ask_ai') }}',
                    type: 'POST',
                    data: {
                        message: message,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        const responseText = typeof response === 'string' ? response : JSON.stringify(response);
                        typeResponse(responseText);
                    },
                    error: function (xhr) {
                        console.error('Error:', xhr.responseText);
                        $('#chat-container').append('<div class="error-message" style="color: red;">An error occurred. Please try again.</div>');
                    }
                });
            });

            function typeResponse(responseText) {
                const responseContainer = $('<div class="ai-response" style="margin-bottom: 10px;"><strong>AI:</strong> <span></span></div>');
                $('#chat-container').append(responseContainer);

                // Check if the response is HTML
                if (responseText.includes('<table')) {
                    // Directly append the HTML response if it's a table
                    responseContainer.find('span').html(responseText);
                } else {
                    // Type the response letter by letter if it's plain text
                    let index = 0;
                    const typingInterval = setInterval(() => {
                        if (index < responseText.length) {
                            responseContainer.find('span').append(responseText.charAt(index));
                            index++;
                        } else {
                            clearInterval(typingInterval);
                        }
                    }, 50);
                }
            }
        });


    </script>

@endsection
