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

		// Query database for employee's information
		$stmt = mysqli_prepare($conn, "SELECT * FROM employee WHERE employeeRank = 'employee'");
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	?>

	<div class="header">
		<div class="header-container">
			<h3>Welcome to Expert Training Management Portal</h3>
		</div>
	</div>
	<style>
	.topper {
  text-align: center;
}
	table {
	  width: 80%;
	  border-collapse: collapse;
	  margin-bottom: 20px;
	}

	th, td {
	  padding: 10px;
	  text-align: left;
	  border-bottom: 1px solid #ddd;
	}

	th {
	  background-color: #f2f2f2;
	  font-weight: bold;
	}

	tbody tr:hover {
	  background-color: #f5f5f5;
	}
	.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
		}

	.search-bar {
			margin-bottom: 10px;
		}

	.search-bar input[type="text"] {
			padding: 5px;
			width: 200px;
		}
	</style>
	<h3 class = "topper">Workshops</h3>
	<div class="container">
		<table>
			<thead>
				<tr>
					<th>Employee ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>IC Number</th>
					<th>Passport</th>
					<th>Phone</th>
					<th>Address</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = mysqli_fetch_assoc($result)) { ?>
					<tr>
						<td><?php echo $row['employeeID']; ?></td>
						<td><?php echo $row['firstName']; ?></td>
						<td><?php echo $row['lastName']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['icNumber']; ?></td>
						<td><?php echo $row['passport']; ?></td>
						<td><?php echo $row['phone']; ?></td>
						<td><?php echo $row['address']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<button class="btn-btn" onclick="location.href='employeesearch.php?employeeID=<?php echo $employeeID; ?>'">Search By ID</button>
<button class="logout-btn" onclick="location.href='newemployee.php?employeeID=<?php echo $employeeID; ?>'">Add new employee</button>
<button class="back-btn" onclick="location.href='dashboard_admin.php?employeeID=<?php echo $employeeID; ?>'">Back</button>
			<style>
.logout-btn {
  position: fixed;
  bottom: 90px;
  margin: 20px;
  right: 20px;
  background-color: #2F455C;
  color: #fff;
  font-size: 16px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
 } 
  .btn-btn{
  position: fixed;
  bottom: 150px;
  margin: 20px;
  right: 20px;
  background-color: #2F455C;
  color: #fff;
  font-size: 16px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  }
  .back-btn{
  position: fixed;
  bottom: 40px;
  margin: 20px;
  right: 20px;
  background-color: #2F455C;
  color: #fff;
  font-size: 16px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  }

</style>
	<div class="footer">
		<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
	</div>
</body>
</html>
