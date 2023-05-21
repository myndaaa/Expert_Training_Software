<!DOCTYPE html>
<html>
<head>
	<title>Expert Training chat</title>
	<link rel="stylesheet" type="text/css" href="messages.css">
</head>
<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "training_portal";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Get the sender ID from the URL
if (isset($_GET['employeeID'])) {
    $senderID = $_GET['employeeID'];
    $senderType = 'employee';
} else if (isset($_GET['customerID'])) {
    $senderID = $_GET['customerID'];
    $senderType = 'customer';
}

// Get the name of the receiver
if ($senderType == 'employee') {
    $sql = "SELECT firstName, lastName FROM employee WHERE employeeID = $senderID";
} else if ($senderType == 'customer') {
    $sql = "SELECT firstName, lastName FROM customer WHERE customerID = $senderID";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $senderName = $row['firstName'] . ' ' . $row['lastName'];
} else {
    $senderName = '';
}


// Get the list of people the sender can message
if ($senderType == 'employee') {
	$sql = "SELECT employeeID, firstName, lastName FROM employee WHERE employeeID != $senderID";
} else if ($senderType == 'customer') {
	$sql = "SELECT e.employeeID, e.firstName, e.lastName FROM employee e JOIN WorksWith w ON e.employeeID = w.employeeID WHERE w.customerID = $senderID";
}

$result = mysqli_query($conn, $sql);

if ($result) {
	$people = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
	$people = array();
}

// Handle sending a message
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$receiverID = $_POST['receiverID'];
	$message = $_POST['message'];

$sql = "INSERT INTO message (customerID, employeeID, senderName, receiverName, date, time, text) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
	$date = date('Y-m-d');
	$time = date('H:i:s');
	mysqli_stmt_bind_param($stmt, 'iisssss', $receiverID, $senderID, $senderName, $receiverName, $date, $time, $message);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}
}

// Get the list of messages for the sender
if ($senderType == 'employee') {
	$sql = "SELECT * FROM message WHERE employeeID = $senderID";
} else if ($senderType == 'customer') {
	$sql = "SELECT * FROM message WHERE customerID = $senderID";
}

$result = mysqli_query($conn, $sql);

if ($result) {
	$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
	$messages = array();
}


// Close the database connection
mysqli_close($conn);
?>

<body>
	<div class="chat-container">
		<div class="chat-header">
  
  <select id="people" onchange="selectPerson()">
    <?php foreach ($people as $person): ?>
      <option value="<?php echo $person['employeeID']; ?>"><?php echo $person['firstName'] . ' ' . $person['lastName']; ?></option>
    <?php endforeach; ?>
  </select>
</div>

<script>
function selectPerson() {
    var select = document.getElementById("people");
    var personID = select.value;
    var url = window.location.href.split('?')[0] + '?<?php echo $senderType; ?>ID=' + personID;
    window.location.href = url;
}

</script>
		<div class="chat-box">
			<?php foreach ($messages as $message): ?>
				<div class="message">
					<p class="meta"><?php echo $message['senderName'] . ' ' . $message['date'] . ' at ' . $message['time']; ?></p>
					<p class="text"><?php echo $message['text']; ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<form method="post" action="">
			<textarea id="message-input" name="message" placeholder="Type your message here"></textarea>
			<input type="hidden" id="receiverID" name="receiverID" value="<?php echo $senderID; ?>">
			<input type="submit" id="send-button" value="Send">
		</form>
	</div>
	<script src="messages.js"></script>
</body>
</html>
