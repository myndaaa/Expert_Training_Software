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

// Delete the workshop from the suggestion_list table
$sql = "DELETE FROM suggestion_list WHERE Workshop_ID = $workshopID";
if ($msp_db->query($sql)) {
    // Workshop deleted successfully, display success message
    echo "<script>alert('Workshop deleted successfully.')</script>";
} else {
    // Error deleting workshop, display error message
    echo "<script>alert('Error deleting workshop: " . $msp_db->error . "')</script>";
}

// Close the database connection
$msp_db->close();

// Redirect back to the original page
header("Location: WS_Employee.php");


?>
