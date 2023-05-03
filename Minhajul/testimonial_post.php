<?php
$connection = new mysqli('localhost', 'root', '', 'expert-db');
if ($connection->connect_error) {
    die("Coudn't connnect to database!");
}



$testimonialResult = $connection->query('SELECT * FROM testimonials');
echo json_encode(mysqli_fetch_all($testimonialResult));
?>