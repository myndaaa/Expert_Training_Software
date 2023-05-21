<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
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
  $deleteQuery = "DELETE FROM document";
  $conn->query($deleteQuery);
  
  // Prepare the SQL statement
  $stmt = $conn->prepare("INSERT INTO document (docname, docfile, file_format) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $docName, $docFile, $fileFormat);
  
  // Process each uploaded file
  for ($i = 0; $i < count($_FILES['docFile']['name']); $i++) {
    $docName = $_POST["docName"][$i];
    $file_tmp = $_FILES['docFile']['tmp_name'][$i];
    
    // Read file data
    $docFile = file_get_contents($file_tmp);
    
    // Get file format
    $fileFormat = pathinfo($_FILES['docFile']['name'][$i], PATHINFO_EXTENSION);
    
    // Execute the statement
    if (!$stmt->execute()) {
        echo "Error inserting file: " . $stmt->error;
        exit();
    }
    
    // Reset the parameter values to avoid binding issues
    $stmt->free_result();
  }
  
  $stmt->close();
  
  // Close database connection
  $conn->close();
  
  // Redirect to the previous page or another page if desired
  header("Location: " . $_SERVER['HTTP_REFERER']);
  exit();
}
?>
