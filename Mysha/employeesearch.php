<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="Employee Management"/>
	<meta name="keywords" content="HTML5, tags"/>
	<meta name="author" content="mysha"/>
	<title>Employee Management</title>
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
		<h1>Search Employee</h1>
		<form onsubmit="searchEmployee(); return false;">
			<label for="employee_search">Employee ID:</label>
			<input type="text" id="searchInput" name="searchInput">
			<input type="submit" value="Search">
		</form>

<div id="employeeInfo"></div>


<?php

  // Establish database connection
  $conn = mysqli_connect('localhost', 'root', '', 'training_portal');

  // Retrieve searchInput from URL parameter
  if (isset($_GET['searchInput'])) {
      $searchInput = $_GET['searchInput'];

      // Query database for employee information
      $stmt = mysqli_prepare($conn, "SELECT * FROM employee WHERE employeeID = ?");
      mysqli_stmt_bind_param($stmt, "i", $searchInput);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $employee = mysqli_fetch_assoc($result);

      // Display employee information
      if ($employee['employeeRank'] === "employee") {
          // Output the employee information
          echo "Employee ID: " . $employee['employeeID'] . "<br>";
          echo "First Name: " . $employee['firstName'] . "<br>";
          echo "Last Name: " . $employee['lastName'] . "<br>";
          echo "Employee Rank: " . $employee['employeeRank'] . "<br>";
          echo "Email: " . $employee['email'] . "<br>";
          echo "IC Number: " . $employee['icNumber'] . "<br>";
          echo "Passport: " . $employee['passport'] . "<br>";
          echo "Phone: " . $employee['phone'] . "<br>";
          echo "Address: " . $employee['address'] . "<br>";
      }elseif($employee['employeeRank'] === "admin") {
		  echo "Information classified";
	  }
	  
	  else {
          echo "Employee not found.";
      }
  }
?>


		  
<style>
h1 {
  text-align: center;
}

form {
  text-align: center;
  margin-bottom: 20px;
  width: 70%;
}

#result {
  text-align: center;
  margin-top: 20px;
}

</style>
		 
</body>
</html>
