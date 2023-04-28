<?php
// connect to the database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'msp';
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// retrieve data from the database
$sql = "SELECT Workshop_ID, Title, Sector, Instructor FROM workshops";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// check if any data was returned
if (mysqli_num_rows($result) > 0) {
    // fetch data as associative array
    $workshops = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $workshops = array();
    echo "No workshops found.";
}

// Retrieve the data from the suggestion_list table
$result = $conn->query("SELECT Workshop_ID, Title, Sector, Instructor FROM suggestion_list");


?>

<!DOCTYPE html>
<html>
<head>
    <title>Workshop Suggestions</title>
    <style>
        /* Styles for the navigation bar */
        .navbar {
            background-color: #2f455c;
            color: white;
            height: 60px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .section {
            display: flex;
            margin-right: 2px;
            margin-left:2px;
            align-items: center;
        }

        .section img {
            margin-right: 2px;
            vertical-align: middle; /* Align image to the text baseline */
        }

        .section button {
            margin-right: 20px;
            vertical-align: middle; /* Align image to the text baseline */
        }

        #date {
            display: flex;
            justify-content: flex-end;
            padding-top:22px;
            padding-right: 75px;
        }
        
        /* Styles for the heading and line */
        .heading {
            text-align: left;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #2f455c;
            padding-left: 1%;
        }

        .heading2 {
            text-align: right;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #2f455c;
            padding-left: 1%;
        }

        .line {
            border-top: 2px solid #2f455c;
            width: 36%;
        }

        .text {
            text-align: left;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #2f455c;
            padding-left: 1%;
        }

        /* Remove default margin on body element */
        body {
            margin: 0;
            background-color: #e2eafc;
        }

        .search-bar {
            display: inline-block;
            border-radius: 20px;
            padding: 4px;
            margin-left:10px;
        }

        .search-bar input[type="text"] {
            border-radius: 10px;
            padding: 10px;
        }

        .search-bar input[type="text"]::placeholder {
            color: #999;
            line-height: 32px; /* set the line-height equal to the input height */
        }

        .rounded-button {
            border-radius: 8px;
            border: 3px solid #2f455c;
            padding: 10px 20px;
            background-color: #fff;
            color: #333;
            font-weight: bold;
            cursor: pointer;
            vertical-align: middle;
        }

        .rounded-button img{
            vertical-align: middle;
        }

        #suggestion-popup {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 800px;
            height: 400px;
            background-color: #fff;
            border-radius: 8px;
            border: 3px solid #2f455c;
            padding: 20px;
            z-index: 1;
        }

        #about-popup {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 400px;
            background-color: #fff;
            border-radius: 8px;
            border: 3px solid #2f455c;
            padding: 20px;
            z-index: 1;
        }

        #close-popup-btn3 {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        #about {
            position: absolute;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        #add {
            position: absolute;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            margin-left: 10px;
            width: 100%;
            max-width: 800px;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            
        }

        th {
            background-color: #2f455c;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }


        td img {
            display:flex;
            margin-right: 10px;
        }


        footer {
            background-color: #e2eafc;
            color: #2f455c;
            text-align: left;
            margin-left: 10px;
            margin-bottom:15px;
            position: absolute;
            bottom: 0;
            left: 0;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <!-- Your navigation bar content here -->
        <div class="section">
            <img src="images/request.png" alt="" title="" width="30" height="30">
            <span>Requests</span>
        </div>
        <div class="section">
            <img src="images/arrow.png" alt="" title="" width="30" height="30">
        </div>
        <div class="section">
            <img src="images/suggestion.png" alt="" title="" width="30" height="30">
            <span>Suggestion</span>
        </div>
        <div class="section">
            <img src="images/arrow.png" alt="" title="" width="30" height="30">
        </div>
        <div class="section">
            <img src="images/payment.png" alt="" title="" width="30" height="30">
            <span>Payment</span>
        </div>
        <div class="section">
            <img src="images/arrow.png" alt="" title="" width="30" height="30">
        </div>
        <div class="section">
            <img src="images/processing.png" alt="" title="" width="30" height="30">
            <span>Processing</span>
        </div>
        <hr>
        <h3>Workshop #E01</h3>
        <hr>
        <span id="date"></span>
    </div>
    <div class="heading">
        <h2>Workshop Suggestions</h2>
        <div class="line"></div>
    </div>
    
    <div class="text">
        <p>Manage suggestions by accepting a workshop or requesting new suggestions</p>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Search">
    </div>
    <button class="rounded-button" id="New-Suggestion">Request New Suggestions</button>
    <button class="rounded-button" id="Confirm-Selection">Confirm Selection</button>
    <div id="about-popup">
        <button id="close-popup-btn3"><img src="images/close.png" alt="" title="" width="30" height="30"></button>
        <h1 class="heading">About Workshop</h1>
    </div>

    <br>
    <br>
    <?php // Display the data in a table
    echo "<table>";
    echo "<tr><th>ID</th><th>Title</th><th>Sector</th><th>Instructor</th><th>&nbsp;</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Workshop_ID"] . "</td>";
        echo "<td>" . $row["Title"] . "</td>";
        echo "<td>" . $row["Sector"] . "</td>";
        echo "<td>" . $row["Instructor"] . "</td>";
        echo "<td>
              <input type='radio' name='workshop_id' value='" . $row["Workshop_ID"] . "'>
              </td>";
        echo "</tr>";
    }
    echo "</table>";?>
    <script src="scripts.js"></script>
    <script>
      setInterval(displayDate, 1000); // call the displayDate function every second
    </script>
    <script>
    // Make sure only one radio button can be selected at a time
    var radioButtons = document.getElementsByName('workshop_id');
    for (var i = 0; i < radioButtons.length; i++) {
        radioButtons[i].addEventListener('click', function() {
            for (var j = 0; j < radioButtons.length; j++) {
                if (radioButtons[j] != this) {
                    radioButtons[j].checked = false;
                }
            }
        });
    }
</script>
<script>
    // Get a reference to the "Confirm Selection" button
    var confirmSelectionBtn = document.getElementById('Confirm-Selection');
    
    // Add a click event listener to the button
    confirmSelectionBtn.addEventListener('click', function() {
        // Get a reference to all the radio buttons in the table
        var radioButtons = document.querySelectorAll('input[type="radio"]');
        
        // Loop through the radio buttons and check which one is selected
        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                // If a radio button is selected, display its value (which should be the workshop ID) in an alert
                alert('You have selected workshop ' + radioButtons[i].value);
                return;
            }
        }
        
        // If no radio button is selected, display an error message
        alert('Please select a workshop before confirming your selection.');
    });
</script>
</body>
<footer>2023 Expert Sdn. Bhd. All Rights Reserved.</footer>
</html>
