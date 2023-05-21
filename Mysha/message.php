<?php
// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'training_portal');
session_start();

// If a chat message is being sent
if (isset($_POST['message'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $sender = 'customer'; // You can set the sender to 'employee' or 'customer', depending on who is logged in
    $time = date('Y-m-d H:i:s');
    mysqli_query($conn, "INSERT INTO messages (sender, text, time) VALUES ('$sender', '$message', '$time')");
}

// Retrieve any new chat messages
$result = mysqli_query($conn, "SELECT * FROM messages WHERE time > '{$_SESSION['last_message_time']}'");
while ($row = mysqli_fetch_assoc($result)) {
  $sender = $row['sender']; // 'employee' or 'customer'
  $text = $row['text'];
  $time = $row['time'];
  // output the message as an HTML element
  echo '<div class="message ';
  if ($sender === 'employee') {
    echo 'employee-message';
  } else {
    echo 'customer-message';
  }
  echo '">';
  echo htmlspecialchars($text);
  echo '<span class="message-time">' . $time . '</span>';
  echo '</div>';
  $_SESSION['last_message_time'] = $time;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="Password Reset"/>
	<meta name="keywords" content="password reset"/>
	<meta name="author" content="mysha"/>
	<title>Expert Training Management Portal</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="message.js"></script>
	
	
</head>
<style>
.chat-container {
  width: 400px;
  height: 500px;
  border: 1px solid #ccc;
  border-radius: 5px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.chat-header {
  background-color: #007bff;
  color: #fff;
  padding: 10px;
  text-align: center;
  font-size: 20px;
}

.chat-messages {
  flex-grow: 1;
  padding: 10px;
  overflow-y: scroll;
}

.chat-input {
  display: flex;
  align-items: center;
  padding: 10px;
}

#message-input {
  flex-grow: 1;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 5px;
  margin-right: 10px;
}

#send-button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 5px 10px;
  cursor: pointer;
}
</style>
<script>
const chatMessages = document.querySelector('.chat-messages');
const messageInput = document.getElementById('message-input');
const sendButton = document.getElementById('send-button');

function showMessage(message, sender) {
  const messageElement = document.createElement('div');
  messageElement.classList.add('message');
  if (sender === 'employee') {
    messageElement.classList.add('employee-message');
  } else {
    messageElement.classList.add('customer-message');
  }
  messageElement.innerText = message;
  chatMessages.appendChild(messageElement);
  chatMessages.scrollTop = chatMessages.scrollHeight;
}

sendButton.addEventListener('click', () => {
  const message = messageInput.value.trim();
  if (message) {
    showMessage(message, 'customer');
    messageInput.value = '';
    // send message to server using AJAX or fetch API
  }
});
</script>
<body>
	<div class="header">
		<div class="header-container">
			<h3>Welcome to Expert Training Management Portal</h3>
		</div>
		<div id="chat-window">
		  <div class="chat-header">
			<h3>Chat Window</h3>
		  </div>
		  <div class="chat-messages">
			<!-- Messages will be added here -->
		  </div>
		  <div class="chat-input">
			<input type="text" id="message-input" placeholder="Type a message...">
			<button id="send-button">Send</button>
		  </div>
		</div>
		<div class="chat-container">
			  <div class="chat-header">
				<h2>Chat</h2>
			  </div>
			  <div class="chat-messages">
				<!-- messages will be dynamically added here -->
			  </div>
			  <div class="chat-input">
				<input type="text" id="message-input" placeholder="Type your message...">
				<button id="send-button">Send</button>
			  </div>
		</div>
	</div>
	<div class="footer">
		<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
	</div>
</body>
</html>

