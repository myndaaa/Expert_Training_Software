<?php
// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'msp';
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the form data
$title = $_POST['title'];
$sector = $_POST['sector'];
$description = $_POST['description'];
$time = $_POST['time'];
$cost = $_POST['cost'];
$format = $_POST['format'];
$instructor = $_POST['instructor'];

// Sanitize and validate the form data
$title = mysqli_real_escape_string($conn, $title);
$sector = mysqli_real_escape_string($conn, $sector);
$description = mysqli_real_escape_string($conn, $description);
$time = mysqli_real_escape_string($conn, $time);
$cost = mysqli_real_escape_string($conn, $cost);
$format = mysqli_real_escape_string($conn, $format);
$instructor = mysqli_real_escape_string($conn, $instructor);

// Construct the MySQL INSERT statement
$sql = "INSERT INTO workshops (Title, Sector, Description, Duration, Cost_Per_Person, Format, Instructor) VALUES ('$title', '$sector', '$description', '$time', '$cost', '$format', '$instructor')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo '<script>alert("New record created successfully.");setTimeout(function() { window.location.href = "WS_Employee.php"; }, 3000);</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
