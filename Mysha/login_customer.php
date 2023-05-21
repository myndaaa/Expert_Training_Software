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
				<h3>Welcome to Expert Training Management Portal<a href = "portal.php">..</a></h3>
			</div>
		</div>
		<div class="container">
			<div class="login-form">
				<h2>Login</h2>
				<form id="myForm" method="POST" onsubmit="return validateForm()">
				<input type="hidden" id="customerID" name="customerID">
					<label for="username">Username:</label>
					<input type="text" id="username" name="username" placeholder="Enter username" required><br>
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" placeholder="Enter password" required><br>
					<button type="submit" class="btn">Login</button>
				</form>
				<p id="message"></p>
			</div>
		</div>
		<p class="signup-text">Forgot Password? Click <a href="reset_pass.php">here</a> to reset<br>
		Don't have an account yet? <a href="signup.php">Sign up</a></p>
		
		<div class="footer">
			<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
		</div>
	
		<?php
		// Start session
    session_start();
			// Establish database connection
			$conn = mysqli_connect('localhost', 'root', '', 'training_portal');

			// Retrieve username and password from form
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$username = $_POST['username'];
				$password = $_POST['password'];

				// Query database for user's password and customerID
				$stmt = mysqli_prepare($conn, "SELECT password, customerID FROM login_customer WHERE username = ?");
				mysqli_stmt_bind_param($stmt, 's', $username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $db_password, $customerID);
				mysqli_stmt_fetch($stmt);
				mysqli_stmt_close($stmt);

				// Verify password
				if ($password === $db_password) {
					// Redirect to dashboard_customer.php and pass the customerID as a parameter
					header("Location: dashboard_customer.php?customerID=$customerID");
					exit();
				} else {
					// Display error message
					echo "<script>alert('Wrong password');</script>";
				}
			}
?>

	
	</body>
</html>
