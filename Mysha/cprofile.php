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
    if (isset($_GET['customerID'])) {
        $customerID = $_GET['customerID'];
    } else {
        // Redirect to login_customer.php if customerID is not provided in URL
        header("Location: login_customer.php");
        exit();
    }

    // Set customerID in session
    $_SESSION['customerID'] = $customerID;

    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'training_portal');

    // Query database for customer's information
    $stmt = mysqli_prepare($conn, "SELECT * FROM customer WHERE customerID = ?");
    mysqli_stmt_bind_param($stmt, 'i', $customerID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $customer = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    // Display customer information
    if ($customer) {
        echo "<div class='customer-info'>";
        echo "<h2>Customer Information</h2>";

        foreach ($customer as $field => $value) {
            echo "<div class='field'>";
            echo "<label>$field:</label> <span>$value</span>";
            echo "</div><br>";
        }
    }

    $conn->close();
    ?>

  </div>
  <button class="logout-btn" onclick="location.href='dashboard_customer.php?customerID=<?php echo $customerID; ?>'">Back</button>
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
