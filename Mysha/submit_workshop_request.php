<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta name="description" content="Basic HTML elements"/>
		<meta name="keywords" content="HTML5, tags"/>
		<meta name="author" content="mysha"/>
		<link rel="stylesheet" href="styles.css"/>
		<title>Expert Training Management Portal</title>
		
	</head>

	<body>
<?php
		session_start();
			// Establish database connection
			$conn = mysqli_connect('localhost', 'root', '', 'training_portal');

			// Retrieve customerID from URL parameter
			if (isset($_GET['customerID'])) {
			    $customerID = $_GET['customerID'];
			} else {
			    // Redirect to login_customer.php if customerID is not provided
			    header("Location: login_customer.php");
			    exit();
			}

			// Query database for customer's information
			$stmt = mysqli_prepare($conn, "SELECT * FROM customer WHERE customerID = ?");
			mysqli_stmt_bind_param($stmt, 'i', $customerID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$customer = mysqli_fetch_assoc($result);
			mysqli_stmt_close($stmt);
		?>
<div class="header">
			<div class="header-container">
				<h3>Welcome to Expert Training Management Portal </h3>
			</div>
</div>
<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "training_portal";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve customerID from URL parameter
if (isset($_GET['customerID'])) {
    $customerID = $_GET['customerID'];
} else {
    // Redirect if customerID is not provided
    header("Location: login_customer.php");
    exit();
}

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO workshop_request (Title, Sector, Description, Duration, Format, InstructorType, customerID) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiisi", $title, $sector, $description, $duration, $format, $instructor_type, $customerID);

// Get the form data
$title = $_POST['title'];
$sector = $_POST['sector'];
$description = $_POST['description'];
$duration = $_POST['duration'];
$format = $_POST['format'];
$instructor_type = $_POST['instructor_type'];

// Execute the statement
if ($stmt->execute()) {
    echo '<div style="display: flex; justify-content: center; align-items: center; height: 300px; font-family: Arial, sans-serif; font-size: 24px; text-align: center; background-color: #f2f2f2; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); animation: fade-in 1s;">';
    echo '<span style="animation: move 2s infinite;">Workshop request submitted successfully!</span>';
    echo '</div>';
} else {
    echo '<div style="display: flex; justify-content: center; align-items: center; height: 300px; font-family: Arial, sans-serif; font-size: 24px; text-align: center; background-color: #f2f2f2; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); animation: fade-in 1s;">';
    echo '<span style="animation: move 2s infinite;">Error: ' . $stmt->error . '</span>';
    echo '</div>';
}


// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
<style>
	@keyframes move {
    0% {
        transform: translateX(-10px);
    }
    50% {
        transform: translateX(10px);
    }
    100% {
        transform: translateX(-10px);
    }
}
</style>

<div class="footer">
			<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
		</div>
		
	</body>

</html>
