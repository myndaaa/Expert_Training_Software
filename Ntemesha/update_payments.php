<?php
// Database configuration
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "payment"; // Change this to your desired database name

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
$conn->close();

// Create a connection to the payment database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the payments table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS payments (
    payment_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    payment_amount INT(11) NOT NULL,
    payment_type VARCHAR(255) NOT NULL,
    payment_status VARCHAR(255) NOT NULL DEFAULT 'no'
)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();

// Insert data from the payment form into the payments table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST["nameOnCard"];
    $email = $_POST["email"];
    $city = $_POST["city"];
    $paymentAmount = 1000; // Hardcoded payment amount as 1000
    $paymentType = $_POST["cardInfo"] ? "card" : "cash"; // If card info is present, payment type is "card", otherwise "cash"
    $paymentStatus = "no"; // Default payment status is "no"

    // Insert data into the payments table
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "INSERT INTO payments (customer_name, email, city, payment_amount, payment_type, payment_status) VALUES ('$customerName', '$email', '$city', $paymentAmount, '$paymentType', '$paymentStatus')";
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data: " . $conn->error;
    }
    $conn->close();
}
