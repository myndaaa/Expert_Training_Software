<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="Employee Management"/>
	<meta name="keywords" content="HTML5, tags"/>
	<meta name="author" content="mysha"/>
	<title>Workshop Management</title>
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
		$stmt = mysqli_prepare($conn, "SELECT * FROM workshop");
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
			max-width: 1000px;
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
					<th>Workshop ID</th>
					<th>Title</th>
					<th>Sector</th>
					<th>Description</th>
					<th>Duration</th>
					<th>Cost Per Person</th>
					<th>Format</th>
					<th>Instructor</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = mysqli_fetch_assoc($result)) { ?>
					<tr>
						<td><?php echo $row['workshopID']; ?></td>
						<td><?php echo $row['Title']; ?></td>
						<td><?php echo $row['Sector']; ?></td>
						<td><?php echo $row['Description']; ?></td>
						<td><?php echo $row['Duration']; ?></td>
						<td><?php echo $row['Cost_Per_Person']; ?></td>
						<td><?php echo $row['Format']; ?></td>
						<td><?php echo $row['Instructor']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<a href = ""></a><a href = ""></a>
	</div>

	<div class="footer">
		<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
	</div>
</body>
</html>
