<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Collect form data
  $names = $_POST["name"];
  $ages = $_POST["age"];
  $emails = $_POST["email"];
  $phones = $_POST["phone"];

  // Connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "MSP";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

    // Delete existing data from the table
    $deleteQuery = "DELETE FROM attendee";
    $conn->query($deleteQuery);

  // Prepare and bind the INSERT statement
  $stmt = $conn->prepare("INSERT INTO attendee (name, age, email, phone) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("siss", $name, $age, $email, $phone);

  // Loop through the form data and execute the query for each row
  for ($i = 0; $i < count($names); $i++) {
    $name = $names[$i];
    $age = $ages[$i];
    $email = $emails[$i];
    $phone = $phones[$i];
    $stmt->execute();
  }

  // Close statement
  $stmt->close();

  // Close database connection
  $conn->close();

  // Redirect to the previous page
  header("Location: " . $_SERVER['HTTP_REFERER']);
  exit();
}
?>
