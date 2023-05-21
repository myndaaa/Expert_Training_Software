<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="Basic HTML elements"/>
	<meta name="keywords" content="HTML5, tags"/>
	<meta name="author" content="mysha"/>
	<script src="#"></script>
	<title>Edit Admin Profile</title>
	<link rel="stylesheet" href="styles2.css"/>
</head>

<body>
	<?php
	session_start();
	// Establish database connection
	$conn = mysqli_connect('localhost', 'root', '', 'training_portal');

	// Retrieve employeeID from URL parameter
	if (isset($_GET['employeeID'])) {
	    $employeeID = $_GET['employeeID'];
	} else {
	    // Redirect to dashboard_admin.php if employeeID is not provided
	    header("Location: dashboard_admin.php");
	    exit();
	}

	// Query database for employee's information
	$stmt = mysqli_prepare($conn, "SELECT * FROM employee WHERE employeeID = ?");
	mysqli_stmt_bind_param($stmt, 'i', $employeeID);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$employee = mysqli_fetch_assoc($result);
	mysqli_stmt_close($stmt);

	// Update employee's email, phone number, and address
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	    $email = $_POST['email'];
	    $phone = $_POST['phone'];
	    $address = $_POST['address'];

	    $stmt = mysqli_prepare($conn, "UPDATE employee SET email = ?, phone = ?, address = ? WHERE employeeID = ?");
	    mysqli_stmt_bind_param($stmt, 'sssi', $email, $phone, $address, $employeeID);
	    mysqli_stmt_execute($stmt);
	    mysqli_stmt_close($stmt);

	    // Redirect back to dashboard_admin.php
	    header("Location: dashboard_admin.php?employeeID=$employeeID");
	    exit();
	}
?>
	<div class="header">
		<div class="header-container">
			<h3>Welcome to Expert Training Management Portal</h3>
		</div>
	</div>

			<div class="container1">
				<form method="POST">
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" name="email" id="email" value="<?php echo $employee['email']; ?>" required>
					</div>
					<div class="form-group">
						<label for="phone">Phone Number:</label>
						<input type="tel" name="phone" id="phone" value="<?php echo $employee['phone']; ?>" required>
					</div>
					<div class="form-group">
						<label for="address">Address:</label>
						<input type="text" name="address" id="address" value="<?php echo $employee['address']; ?>" required>
					</div>
					<div class="form-group">
						<input type="submit" value="Save">
					</div>
				</form>
			</div>

	<div class="footer">
		<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
	</div>
</body>
</html>
