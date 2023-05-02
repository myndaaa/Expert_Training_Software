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

// Create the payment database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS payment";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the payment database
$conn->select_db("payment");

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
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert form data into the payments table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $city = $_POST["city"];
    $payment_amount = 1000; // Fixed payment amount
    $payment_type = "";
    $payment_status = "no";

    // Determine payment type based on uploaded file
    if ($_FILES["upload"]["tmp_name"] !== "") {
        $payment_type = "cash";
    } else {
        $payment_type = "card";
    }

    // Prepare and execute SQL statement to insert data
    $stmt = $conn->prepare("INSERT INTO payments (customer_name, email, city, payment_amount, payment_type, payment_status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $city, $payment_amount, $payment_type, $payment_status);

    if ($stmt->execute() === TRUE) {
        echo "Payment data inserted successfully<br>";
    } else {
        echo "Error inserting payment data: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

$conn->close();

?>
