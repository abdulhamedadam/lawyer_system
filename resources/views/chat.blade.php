<style>
    .chat-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        font-family: 'Arial', sans-serif;
    }

    .chat-header {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    #message {
        width: 100%;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 16px;
        resize: vertical;
    }

    #send {
        background-color: #2c3e50;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    #send:hover {
        background-color: #34495e;
    }

    #response {
        margin-top: 20px;
        padding: 20px;
        border-radius: 8px;
        background-color: #f8f9fa;
        min-height: 100px;
        white-space: pre-wrap;
        line-height: 1.5;
    }

    /* Loader Styles */
    .loader-container {
        display: none;
        text-align: center;
        margin: 20px 0;
    }

    .loader {
        display: inline-block;
        width: 50px;
        height: 50px;
        border: 3px solid #f3f3f3;
        border-radius: 50%;
        border-top: 3px solid #2c3e50;
        animation: spin 1s linear infinite;
    }

    .thinking-dots {
        color: #2c3e50;
        font-size: 16px;
        margin-top: 10px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="chat-container">
    <div class="chat-header">
        <h1>ChatGPT Assistant</h1>
    </div>

    <textarea id="message" rows="5" ></textarea>
    <button id="send">Send Message</button>

    <div class="loader-container">
        <div class="loader"></div>
        <div class="thinking-dots">Thinking...</div>
    </div>

    <div id="response"></div>
</div>

<script>
    $(document).ready(function () {
        function typeWriter(element, text, speed = 20) {
            let i = 0;
            element.text(''); // Clear existing text

            function type() {
                if (i < text.length) {
                    element.text(element.text() + text.charAt(i));
                    i++;
                    setTimeout(type, speed);
                }
            }

            type();
        }

        $('#send').on('click', function () {
            const message = $('#message').val();
            if (!message.trim()) return;
            $('#send').prop('disabled', true);
            $('.loader-container').fadeIn();
            $('#response').text('');

            $.ajax({
                url: '/admin/ask_ai',
                type: 'POST',
                data: {
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'text',
                success: function (response) {
                    $('#message').text('');
                    $('.loader-container').fadeOut();
                    $('#send').prop('disabled', false);
                    $('#message').text('   ').trigger('change');
                    const message = Array.isArray(response) ? response[0] : response;
                    typeWriter($('#response'), message);

                },
                error: function (xhr) {
                    $('.loader-container').fadeOut();
                    $('#send').prop('disabled', false);
                    $('#message').val(' ');
                    console.error('Error:', xhr.responseText);
                    $('#response').text('An error occurred. Please try again.');
                }
            });
        });
        $('#message').keydown(function (e) {
            if (e.keyCode === 13 && !e.shiftKey) {
                e.preventDefault();
                $('#send').click();
            }
        });
    });
</script>
