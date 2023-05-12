<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payment";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the payments table to get payment amounts
$sql = "SELECT payment_amount FROM payments";
$result = $conn->query($sql);

// Extract payment amounts from the result set and store in an array
$paymentAmounts = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $paymentAmounts[] = $row["payment_amount"];
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/styles.css" />
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<nav>
    <ul>
        <li class="">
            <a class="" href="#">
                <img src="images/icons8-questions-48.png" alt="Icon" width="30" height="30" class="" />
                Request
            </a>
        </li>
        <li class="">
            <a class="" href="#">
                <img src="images/icons8-idea-48 (1).png" alt="Icon" width="30" height="30" class="" />
                Suggestion
            </a>
        </li>
        <li class="">
            <a class="" href="#">
                <img src="images/icons8-iphone-spinner-48.png" alt="Icon" width="30" height="30" class="" />
                Processing
            </a>
        </li>
        <li class="">
            <a class="" href="#">
                <img src="images/icons8-online-payment-48.png" alt="Icon" width="30" height="30" class="" />
                Payment
            </a>
        </li>
        <li class="">
            <a class="" href="#">
                <img src="images/icons8-chat-message-96 (1).png" alt="Icon" width="30" height="30" class="" />
                Communication
            </a>
        </li>
    </ul>
</nav>

<body>
    <br><br><br>
    <div class="chart-container">
        <canvas id="myChart"></canvas>
    </div>

    <style>
        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
            width: 70vw;
            margin: auto;
        }

        canvas {
            max-width: 100%;
            max-height: 100%;
        }
    </style>

<script>
    // Calculate total payment amount
    var totalPaymentAmount = <?php echo array_sum($paymentAmounts) ?>;

    // Create a bar chart of payment amounts using Chart.js library
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total Payment Amount'],
            datasets: [{
                label: 'Payment Amount',
                data: [totalPaymentAmount],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
</body>


</html>