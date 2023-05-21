<?php
// Establish database connection
$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "training_portal";
  $conn = mysqli_connect('localhost', 'root', '', 'training_portal');
// Check the connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
// Get the user input values from the HTML form
  $uname = $_POST["username"];
  $npassword = $_POST["npassword"];
  $email = $_POST["email"];
  
// Check if the username and email combination exist in the database
$sql = "SELECT * FROM login_customer WHERE username='$uname' AND email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
  // If the combination exists, update the password in the table
  $sql_update = "UPDATE login_customer SET password='$npassword' WHERE username='$uname' AND email='$email'";
  if (mysqli_query($conn, $sql_update)) {
    echo "<script>alert('Password has been updated successfully.');</script>";
  } else {
    echo "<script>alert('Error updating password: " . mysqli_error($conn) . "');</script>";
  }
} else {
  // If the combination does not exist, display an error message
  echo "<script>alert('Username or email is wrong.');</script>";
}

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta name="description" content="Basic HTML elements"/>
		<meta name="keywords" content="HTML5, tags"/>
		<meta name="author" content="mysha"/>
		<title>Expert Training Management Portal</title>
		<link rel="stylesheet" href="styles.css"/>
	</head>

	<body>
		<div class="header">
			<div class="header-container">
				<h3>Welcome to Expert Training Management Portal</h3>
			</div>
		</div>
		
		<div class="container">
			
			<div class="card">
				<h2>Return to <a href = "login_customer.php">log in</a> </h2>
			</div>
			
			
		</div>
		
		<div class="footer">
			<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
		</div>
		
	</body>

</html>
