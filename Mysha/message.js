$(document).ready(function() {
    // Send a chat message to the server
    $("#send-button").click(function() {
        var message = $("#message-input").val();
        $.post("chat.php", { message: message }, function(data) {
            // Add the sent message to the chat window
            $("#chat-window").append("<div class='message-sent'>" + message + "</div>");
            // Clear the message input field
            $("#message-input").val("");
        });
    });
    
    // Receive new chat messages from the server
    setInterval(function() {
        $.get("chat.php", function(data) {
            // Add any new messages to the chat window
            $("#chat-window").append("<div class='message-received'>" + data + "</div>");
        });
    }, 1000); // Repeat every 1 second
});
