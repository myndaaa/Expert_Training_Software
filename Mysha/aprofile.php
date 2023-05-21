<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="description" content="Basic HTML elements"/>
  <meta name="keywords" content="HTML5, tags"/>
  <meta name="author" content="mysha"/>
  <script src="#"></script>
  <title>Expert Training Management Portal</title>
  <link rel="stylesheet" href="styles1.css"/>
</head>

<body>
  
  <div class="header">
    <div class="header-container">
      <h3>Welcome to Expert Training Management Portal</h3>
    </div>
  </div>
  <div class="container">
    <?php
    // Start session
    session_start();

    // Get customerID from URL parameter
    if (isset($_GET['employeeID'])) {
        $employeeID = $_GET['employeeID'];
    } else {
        // Redirect to login_customer.php if customerID is not provided in URL
        header("Location: login_employee.php");
        exit();
    }

    // Set customerID in session
    $_SESSION['employeeID'] = $employeeID;

    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'training_portal');

    // Query database for customer's information
    $stmt = mysqli_prepare($conn, "SELECT * FROM employee WHERE employeeID = ?");
    mysqli_stmt_bind_param($stmt, 'i', $employeeID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $employee = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    // Display customer information
    if ($employee) {
        echo "<div class='customer-info'>";
        echo "<h2>Employee Information</h2>";

        foreach ($employee as $field => $value) {
            echo "<div class='field'>";
            echo "<label>$field:</label> <span>$value</span>";
            echo "</div><br>";
        }
    }

    $conn->close();
    ?>

  </div>
  <button class="logout-btn" onclick="location.href='dashboard_admin.php?employeeID=<?php echo $employeeID; ?>'">Back</button>
			<style>
.logout-btn {
  position: fixed;
  bottom: 80px;
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
