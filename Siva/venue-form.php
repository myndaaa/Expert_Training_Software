<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  // Collect form data
  $name = $_POST['venue-name'];
  $addressL1 = $_POST['address-line-1'];
  $addressL2 = $_POST['address-line-2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $postalCode = $_POST['postal-code'];
  $country = $_POST['country'];

  echo $name;
  echo $addressL1;
  
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
    $deleteQuery = "DELETE FROM venue";
    $conn->query($deleteQuery);
  
  // Insert data into the table
  $sql = "INSERT INTO venue (_Name, Address_L1, Address_L2, City, _State, Postal_Code, Country) VALUES ('$name', '$addressL1', '$addressL2', '$city', '$state', '$postalCode', '$country')";
  
  if ($conn->query($sql) === TRUE) {
    // Redirect to previous page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  // Close database connection
  $conn->close();
}
?>
