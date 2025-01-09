



<h1>ChatGPT</h1>
<textarea id="message" rows="5" cols="40" placeholder="Type your message here..."></textarea>
<button id="send">Send</button>
<div id="response"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#send').on('click', function () {
            const message = $('#message').val();

            $.ajax({
                url: '/admin/ask_ai',
                type: 'POST',
                data: {
                    message: message,
                    _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                },
                success: function (response) {
                    $('#response').text(JSON.stringify(response, null, 2));
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                    $('#response').text('An error occurred. Please try again.');
                }
            });
        });
    });
</script>


