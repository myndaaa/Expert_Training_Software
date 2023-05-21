<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Basic HTML elements" />
    <meta name="keywords" content="HTML5, tags" />
    <meta name="author" content="mysha" />
    <script src="#"></script>
    <title>Edit Customer Profile</title>
    <link rel="stylesheet" href="styles2.css" />
</head>

<body>
    <?php
    session_start();
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'training_portal');

    // Retrieve customerID from URL parameter
    if (isset($_GET['customerID'])) {
        $customerID = $_GET['customerID'];
    } else {
        // Redirect to dashboard_customer.php if customerID is not provided
        header("Location: dashboard_customer.php");
        exit();
    }

    // Query database for customer's information
    $stmt = mysqli_prepare($conn, "SELECT * FROM customer WHERE customerID = ?");
    mysqli_stmt_bind_param($stmt, 'i', $customerID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $customer = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    // Update customer's email and phone number
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // JavaScript validation
        echo '<script>';
        echo 'var email = "' . $email . '";';
        echo 'var phone = "' . $phone . '";';
        echo 'var emailRegex = /^\S+@\S+\.\S+$/;';
        echo 'var phoneRegex = /^\d{10}$/;';
        echo 'if (!emailRegex.test(email)) {';
        echo 'alert("Please enter a valid email address.");';
        echo 'return false;';
        echo '}';
        echo 'if (!phoneRegex.test(phone)) {';
        echo 'alert("Please enter a valid phone number.");';
        echo 'return false;';
        echo '}';
        echo '</script>';

        $stmt = mysqli_prepare($conn, "UPDATE customer SET email = ?, phone = ? WHERE customerID = ?");
        mysqli_stmt_bind_param($stmt, 'ssi', $email, $phone, $customerID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Redirect back to dashboard_customer.php
        header("Location: dashboard_customer.php?customerID=$customerID");
        exit();
    }
    ?>
    <div class="header">
        <div class="header-container">
            <h3>Welcome to Expert Training Management Portal</h3>
        </div>
    </div>
    <p>You are only allowed to edit email and phone number to combat fake information. Contact +60189769044 for details</p>
    <style>
        p {
            text-align: center;
        }
    </style>
	<div class="container1">
    <form method="POST" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $customer['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" name="phone" id="phone" value="<?php echo $customer['phone']; ?>" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Save">
        </div>
    </form>
</div>
<button class="logout-btn" onclick="location.href='dashboard_customer.php?customerID=<?php echo $customerID; ?>'">Back</button>

<script>
    function validateForm() {
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        var emailRegex = /^\S+@\S+\.\S+$/;
        var phoneRegex = /^\d{10}$/;

        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            return false;
        }

        if (!phoneRegex.test(phone)) {
            alert("Please enter a valid phone number.");
            return false;
        }

        return true;
    }
</script>

<style>
    .logout-btn {
        position: fixed;
        bottom: 80px;
        margin: 20px;
        right: 20px;
        background-color: #2F455C;
        color: #fff;
        font-size: 16px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<div class="footer">
    <p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
</div>
</body>
</html>
