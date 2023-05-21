// Get references to the relevant DOM elements
const messageForm = document.getElementById('message-input');
const messageInput = document.getElementById('message-input');
const messageList = document.getElementById('message-list');

// When the message form is submitted, send the message via AJAX
messageForm.addEventListener('submit', (event) => {
	event.preventDefault();

	// Get the values from the form
	const receiverID = document.getElementById('people').value;
	const message = messageInput.value;

	// Send the message via AJAX
	const xhr = new XMLHttpRequest();
	xhr.open('POST', 'send-message.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		// If the request was successful, add the message to the list
		if (xhr.status === 200) {
			const messageData = JSON.parse(xhr.responseText);
			const messageHTML = createMessageHTML(messageData);
			messageList.insertAdjacentHTML('beforeend', messageHTML);
			messageInput.value = '';
		}
	};
	xhr.send('receiverID=' + encodeURIComponent(receiverID) + '&message=' + encodeURIComponent(message));
});

// Helper function to create HTML for a message
function createMessageHTML(messageData) {
	const date = new Date(messageData.date + ' ' + messageData.time);
	const dateStr = date.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
	const timeStr = date.toLocaleTimeString(undefined, { hour: 'numeric', minute: 'numeric' });
	const messageHTML = `
		<div class="message">
			<div class="message-header">
				<span class="sender-name">${messageData.senderName}</span>
				<span class="message-timestamp">${dateStr} at ${timeStr}</span>
			</div>
			<div class="message-body">
				${messageData.text}
			</div>
		</div>
	`;
	return messageHTML;
}

// When the page loads, fetch the messages via AJAX
window.addEventListener('load', () => {
	const xhr = new XMLHttpRequest();
	xhr.open('GET', 'get-messages.php');
	xhr.onload = function() {
		// If the request was successful, add the messages to the list
		if (xhr.status === 200) {
			const messageDataArray = JSON.parse(xhr.responseText);
			messageDataArray.forEach((messageData) => {
				const messageHTML = createMessageHTML(messageData);
				messageList.insertAdjacentHTML('beforeend', messageHTML);
			});
		}
	};
	xhr.send('receiverID=' + encodeURIComponent(receiverID) + '&message=' + encodeURIComponent(message) + '&userID=' + encodeURIComponent(user_id));

});
