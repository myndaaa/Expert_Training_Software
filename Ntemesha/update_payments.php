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

// Insert data into the payments table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST["nameOnCard"];
    $email = $_POST["email"];
    $city = $_POST["city"];
    $paymentAmount = 1000; // Hardcoded payment amount as 1000
    $paymentType = "Card"; // If card info is present, payment type is "card", otherwise "cash"
    $paymentStatus = "no"; // Default payment status is "no"
    $cardNumber = $_POST["cardInfo"];
    $expiryDate = $_POST["expiryYear"] . '-' . $_POST["expiryDate"] . '-01'; // Construct the date string in yyyy-mm-dd format
    $cvc = $_POST["cvc"];
    $recipt = "upload";
    

    // Insert data into the payments table
    $sql = "INSERT INTO payments (customer_name, email, city, payment_amount, payment_type, payment_status, card_info, expiry_date, cvc, name_on_card) VALUES ('$customerName', '$email', '$city', $paymentAmount, '$paymentType', '$paymentStatus', '$cardNumber', '$expiryDate', $cvc, '$customerName')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data: " . $conn->error;
    }
}

$conn->close();
?>