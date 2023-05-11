<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles.css" />
  <title>Document</title>
</head>
<nav>
  <ul>
    <li class="">
      <a class="" href="#">
        <img src="images/icons8-questions-48.png" alt="Icon" width="30" height="30" class="" />
        Request
      </a>
    </li>
    <li class="">
      <a class="" href="#">
        <img src="images/icons8-idea-48 (1).png" alt="Icon" width="30" height="30" class="" />
        Suggestion
      </a>
    </li>
    <li class="">
      <a class="" href="#">
        <img src="images/icons8-iphone-spinner-48.png" alt="Icon" width="30" height="30" class="" />
        Processing
      </a>
    </li>
    <li class="">
      <a class="" href="#">
        <img src="images/icons8-online-payment-48.png" alt="Icon" width="30" height="30" class="" />
        Payment
      </a>
    </li>
    <li class="">
      <a class="" href="#">
        <img src="images/icons8-chat-message-96 (1).png" alt="Icon" width="30" height="30" class="" />
        Communication
      </a>
    </li>
  </ul>
</nav>

<body>
  <?php

  // Database configuration
  $servername = "localhost"; // Change this to your database server name
  $username = "root"; // Change this to your database username
  $password = ""; // Change this to your database password
  $dbname = "payment"; // Change this to your desired database name

  // Create a connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Search functionality
  $searchInput = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchInput = $_POST["searchInput"];
  }

  // Update payment status
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["approveBtn"])) {
    $paymentId = $_POST["paymentId"];
    $stmt = $conn->prepare("UPDATE payments SET payment_status = 'paid' WHERE payment_id = ?");
    $stmt->bind_param("i", $paymentId);
    if ($stmt->execute() === TRUE) {
      echo "Payment with ID $paymentId has been approved and status changed to 'paid'.<br>";
    } else {
      echo "Error updating payment status: " . $stmt->error . "<br>";
    }
    $stmt->close();
  }

  // Retrieve payments from the database
  $sql = "SELECT * FROM payments WHERE payment_id LIKE ? OR customer_name LIKE ? ORDER BY payment_id DESC";
  $stmt = $conn->prepare($sql);
  $searchParam = "%" . $searchInput . "%";
  $stmt->bind_param("ss", $searchParam, $searchParam);
  $stmt->execute();
  $result = $stmt->get_result();

  // Display payments in HTML table
echo '<div class="container_payments">';
echo '<h1>Payment Admin Page</h1>';
echo '<div class="search-container">';
echo '<form method="post" action="">';
echo '<input type="text" id="searchInput" name="searchInput" placeholder="Search" value="' . $searchInput . '" class= "search"/>';
echo '<input type="submit" value="Search" class="pay-now-button">';
echo '</form>';
echo '</div>';
echo '<table>';
echo '<tr>';
echo '<th>Customer Name</th>';
echo '<th>Payment Amount</th>';
echo '<th>Payment Status</th>';
echo '</tr>';

while ($row = $result->fetch_assoc()) {
  echo '<tr>';
  echo '<td>' . $row["customer_name"] . '</td>';
  echo '<td>' . $row["payment_amount"] . '</td>';
  echo '<td>' . $row["payment_status"] . '</td>';
  echo '</tr>';
}
echo '</table>';
echo '</div>';

  // Close database connection
  $stmt->close();
  $conn->close();
  ?>

</body>

</html>