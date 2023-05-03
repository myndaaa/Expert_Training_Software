<?php

// Connect to the MSP database
$msp_db = new mysqli("localhost", "root", "", "msp");

// Check for connection errors
if ($msp_db->connect_error) {
    die("Connection failed: " . $msp_db->connect_error);
}

// Retrieve the workshop ID from the form
$workshopID = $_POST['workshop_id'];
echo $workshopID;

// Check if the workshop is already in the suggestion list
$result = $msp_db->query("SELECT * FROM suggestion_list WHERE Workshop_ID = $workshopID");

if ($result->num_rows > 0) {
    // Workshop is already in the suggestion list, display alert message
    echo "<script>alert('This workshop is already in the suggestion list.')</script>";
} else {
    // Workshop is not in the suggestion list, insert it into the database
    $result = $msp_db->query("SELECT * FROM workshops WHERE Workshop_ID = $workshopID");
    $workshop = $result->fetch_assoc();
    $msp_db->query("INSERT INTO suggestion_list(Workshop_ID, Title, Sector,Description, Duration, Cost_Per_Person, Instructor) VALUES ('$workshop[Workshop_ID]', '$workshop[Title]', '$workshop[Sector]','$workshop[Description]','$workshop[Duration]','$workshop[Cost_Per_Person]', '$workshop[Instructor]')");
}

// Redirect back to the original page
header("Location: WS_Employee.php");


// Fetch the suggestions from the database
$result = $msp_db->query("SELECT * FROM suggestion_list");
?>



