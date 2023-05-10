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

$sql = "CREATE TABLE IF NOT EXISTS payments (
    payment_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    payment_amount INT(11) NOT NULL,
    payment_type VARCHAR(255) NOT NULL,
    payment_status VARCHAR(255) NOT NULL DEFAULT 'no',
    card_info VARCHAR(255) NOT NULL,
    expiry_date VARCHAR(255) NOT NULL,
    cvc VARCHAR(255) NOT NULL,
    name_on_card VARCHAR(255) NOT NULL,
    recipt LONGBLOB
)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $city = $_POST["city"];
    $payment_amount = 1000; // Fixed payment amount
    $payment_type = "";
    $payment_status = "no";
    $recipt = "upload";

    // Determine payment type based on uploaded file
    if ($recipt!== "") {
        $payment_type = "cash";
    } else {
        $payment_type = "card";
    }

    // Insert form data into the payments table
    $sql = "INSERT INTO payments (customer_name, email, city, payment_amount, payment_type, payment_status, recipt) VALUES ('$name', '$email', '$city', '$payment_amount', '$payment_type', '$payment_status', '$recipt')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Payment data inserted successfully<br>";
    } else {
        echo "Error inserting payment data: " . $conn->error . "<br>";
    }
}

    


$conn->close();

?>
