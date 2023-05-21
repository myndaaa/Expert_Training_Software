<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  // check if the request method is POST and if the register button is pressed
  // Establish a connection to the MySQL database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "training_portal";
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check the connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Get the user input values from the HTML form
  $fname = $_POST["user_fname"];
  $lname = $_POST["user_lname"];
  $email = $_POST["email"];
  $passport = $_POST["passport"];
  $ic = $_POST["ic"];
  $phone = $_POST["phn"];
  $rank = $_POST["employeeRank"];
  $address = $_POST["adress"];
  
  $username_input = $_POST["uname"];
  $password_input = $_POST["password"];

  // Check if the password is at least 8 characters
  if (strlen($password_input) < 8) {
    echo "<script>alert('Password should be at least 8 characters')</script>";
    exit;
  }

  // Insert the data into the "customer" table
  $sql = "INSERT INTO employee (firstName, lastName, employeeRank, email, icNumber, passport, phone, address ) 
  VALUES ('$fname', '$lname', '$rank','$email' ,'$ic', '$passport','$phone', '$address')";
  if (mysqli_query($conn, $sql)) {
    $employeeID = mysqli_insert_id($conn);
// Insert the data into the "login_customer" table
  $sql = "INSERT INTO login_employee (username, password, employeeID, email) VALUES ('$username_input', '$password_input', '$employeeID', '$email')";
  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Registration successful!')</script>";
  } else {
    $error_message = mysqli_error($conn);
    echo "<script>alert('Registration failed: $error_message')</script>";
  }
} else {
  $error_message = mysqli_error($conn);
  echo "<script>alert('Registration failed: $error_message'); window.location.href='newemployee.php?employeeID=" . $employeeID . "';</script>";

}


  mysqli_close($conn);
}
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
		<?php
		// Establish database connection
		$conn = mysqli_connect('localhost', 'root', '', 'training_portal');

		// Retrieve employeeID from URL parameter
		if (isset($_GET['employeeID'])) {
		    $employeeID = $_GET['employeeID'];
		} else {
		    // Redirect to login_employee.php if employeeID is not provided
		    header("Location: login_employee.php");
		    exit();
		}

	?>
		<div class="header">
			<div class="header-container">
				<h3>Welcome to Expert Training Management Portal</h3>
			</div>
		</div>
		
		<div class="container">
			
			<div class="card">
				<h2>Return to <a href = "dashboard_employee.php?employeeID=<?php echo $employeeID; ?>">dashboard</a> </h2>
			</div>
			
			
		</div>
		
		<div class="footer">
			<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
		</div>
		
	</body>

</html>
