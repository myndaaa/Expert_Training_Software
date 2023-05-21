<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "training_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$employeeID = $_GET["employeeID"];

// Prepare the SQL statement
$sql = "SELECT * FROM employee WHERE employeeID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employeeID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Employee found, fetch the data
    $employee = $result->fetch_assoc();
    
    if ($employee['employeeRank'] === "admin") {
        echo "Information classified";
    } else {
        // Display the employee information
        echo "<h2>Employee Information</h2>";
        echo "<p>First Name: " . $employee['firstName'] . "</p>";
        echo "<p>Last Name: " . $employee['lastName'] . "</p>";
        echo "<p>Employee Rank: " . $employee['employeeRank'] . "</p>";
        echo "<p>Email: " . $employee['email'] . "</p>";
        echo "<p>IC Number: " . $employee['icNumber'] . "</p>";
        echo "<p>Passport: " . $employee['passport'] . "</p>";
        echo "<p>Phone: " . $employee['phone'] . "</p>";
        echo "<p>Address: " . $employee['address'] . "</p>";
    }
} else {
    // Employee not found
    echo "EmployeeID not found";
}

$stmt->close();
$conn->close();
?>
