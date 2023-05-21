<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="Employee Management"/>
	<meta name="keywords" content="HTML5, tags"/>
	<meta name="author" content="mysha"/>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
		$stmt = mysqli_prepare($conn, "SELECT * FROM workshop_request WHERE status = 'pending'");
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
	<h3 class = "topper">Workshop Enquiries</h3>
	<div class="container">
	
		<table>
			<thead>
				<tr>
					<th>Request ID</th>
					<th>Title</th>
					<th>Sector</th>
					<th>Description</th>
					<th>Duration</th>
					<th>Format</th>
					<th>Instructor Type</th>
					<th>Customer ID</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = mysqli_fetch_assoc($result)) { ?>
					<tr>
						<td><?php echo $row['requestID']; ?></td>
						<td><?php echo $row['Title']; ?></td>
						<td><?php echo $row['Sector']; ?></td>
						<td><?php echo $row['Description']; ?></td>
						<td><?php echo $row['Duration']; ?></td>
						<td><?php echo $row['Format']; ?></td>
						<td><?php echo $row['InstructorType']; ?></td>
						<td><?php echo $row['customerID']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>	
	</div>
	<style>
  .assign-workshop-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 300px;
    width: 40%;
    margin: 0 auto;
    font-family: Arial, sans-serif;
    font-size: 24px;
    text-align: center;
    background-color: #f2f2f2;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    animation: fade-in 1s;
    padding: 20px;
  }

  .assign-workshop-container h1 {
    margin-bottom: 20px;
  }

  .assign-workshop-form label {
    display: block;
    margin-bottom: 10px;
  }

  .assign-workshop-form select,
  .assign-workshop-form input[type="submit"] {
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: none;
  }

  .assign-workshop-form input[type="submit"] {
    background-color: #2F455C;
    color: #fff;
    cursor: pointer;
  }
  .assign-workshop-form input[type="submit"]:hover {
    background-color: #1A2A35;
	transform: scale(1.03);
  }
</style>
	<h3 class = "topper">Assign Workshop</h3>
	<div class = "assign-workshop-container">
  <?php
  // Establish database connection
  $conn = mysqli_connect('localhost', 'root', '', 'training_portal');
  
  // Retrieve employees with rank "employee"
  $employeeQuery = "SELECT employeeID FROM employee WHERE employeeRank = 'employee'";
  $employeeResult = mysqli_query($conn, $employeeQuery);
  
  // Retrieve requests with status "pending"
  $requestQuery = "SELECT requestID FROM workshop_request WHERE status = 'pending'";
  $requestResult = mysqli_query($conn, $requestQuery);
  
  // Handle form submission
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeID = $_POST['employeeID'];
    $requestID = $_POST['requestID'];
    
    // Update workshop_assignment table
    $assignQuery = "INSERT INTO workshop_assignment (employeeID, requestID) VALUES ('$employeeID', '$requestID')";
    mysqli_query($conn, $assignQuery);
    
    // Update workshop_request status to "approved"
    $updateQuery = "UPDATE workshop_request SET status = 'approved' WHERE requestID = '$requestID'";
    mysqli_query($conn, $updateQuery);
    
    echo '<script>alert("Workshop assigned successfully!");</script>';
    
  }
  
  // Close the database connection
  mysqli_close($conn);
  ?>
  
  <form class="assign-workshop-form" method="POST" onsubmit="return validateForm()">
    <label for="employeeID">Select Employee:</label>
    <select id="employeeID" name="employeeID" required>
      <?php while ($employee = mysqli_fetch_assoc($employeeResult)): ?>
        <option value="<?php echo $employee['employeeID']; ?>"><?php echo $employee['employeeID']; ?></option>
      <?php endwhile; ?>
    </select><br><br>
    
    <label for="requestID">Select Request:</label>
    <select id="requestID" name="requestID" required>
      <?php while ($request = mysqli_fetch_assoc($requestResult)): ?>
        <option value="<?php echo $request['requestID']; ?>"><?php echo $request['requestID']; ?></option>
      <?php endwhile; ?>
    </select><br><br>
    
    <input type="submit" value="Assign">
  </form>
  
  <script>
     function validateForm() {
    var employeeID = document.getElementById("employeeID").value;
    var requestID = document.getElementById("requestID").value;

    if (employeeID === "" || requestID === "") {
      alert("Please select both an Employee and a Request before submitting the form.");
      return false; // Prevent form submission
    }
    

    return true; // Allow form submission
  }

	  
  </script>
  </div>
	<div class="footer">
		<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
	</div>
</body>
</html>
