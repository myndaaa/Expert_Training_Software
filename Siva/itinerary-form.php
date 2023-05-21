<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  // Collect form data
  $startTimes = $_POST["startTime"];
  $activities = $_POST["activity"];
  
  // Connect to database
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
  $deleteQuery = "DELETE FROM itinerary";
  $conn->query($deleteQuery);
  
  // Insert data into the table
  $stmt = $conn->prepare("INSERT INTO itinerary (start_time, _Activity) VALUES (?, ?)");
  $stmt->bind_param("ss", $startTime, $activity);
  
  // Loop through the form data and execute the query for each row
  for ($i = 0; $i < count($startTimes); $i++) {
    $startTime = $startTimes[$i];
    $activity = $activities[$i];
    $stmt->execute();
  }
  
  $stmt->close();
  
  // Close database connection
  $conn->close();
  
  // Redirect to previous page
  header("Location: " . $_SERVER['HTTP_REFERER']);
  exit();
}
?>
