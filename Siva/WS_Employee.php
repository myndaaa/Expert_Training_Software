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
        
        .table-container {
            width: 100%;
            overflow-x: auto;
            white-space: nowrap;
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

        .Send{
            border-radius: 8px;
            border: 3px solid #2f455c;
            padding: 10px 20px;
            background-color: #fff;
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

        #create-popup {
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

        #close-popup-btn1 {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        #close-popup-btn2 {
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
            overflow-y:auto;
            padding:10px;
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
            position: relative;
            bottom: 0;
            width: 100%;
            height: 50px;
            background-color: #2f455c;
            color: #fff;
            text-align: left;
        }

    @media (max-height: 500px) {
        footer {
            position: static;
        }
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
        <span id="date">7th April 2023</span>
    </div>
    <div class="heading">
        <h2>Workshop Suggestion Management</h2>
        <div class="line"></div>
    </div>
    <div class="text">
        <p>View, add and delete workshops and add them to the selected enquiry's suggestion list</p>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Search">
    </div>
    <button class="rounded-button" id="create-btn">Create New Workshop</button>
        <div id="create-popup">
            <button id="close-popup-btn1"><img src="images/close.png" alt="" title="" width="30" height="30"></button>
            <h1 class="heading">Create a Workshop</h1>
            <form method="POST" action="create_workshop.php">
                <label for="title">Workshop Title:</label>
                <input type="text" name="title" required>
                <br>
                <br>
                <label for="title">Workshop Sector:</label>
                <input type="text" name="sector" required>
                <br>
                <br>
                <label for="description">Description:</label>
                <textarea name="description" required></textarea>
                <br>
                <br>
                <label for="time">Time:</label>
                <input type="number" name="time" required>
                <br>
                <br>
                <label for="cost">Cost Per Person: RM</label>
                <input type="number" name="cost" required>
                <br>
                <br>
                <label for="format">Format:</label>
                <input type="text" name="format" required>
                <br>
                <br>
                <label for="intructor">Intructor</label>
                <input type="text" name="instructor" required>
                <br>
                <br>
                <button type="submit">Create</button>
            </form>
        </div>
        <button class="rounded-button" id="suggestion-btn"><img src="images/suggestion-clip.png" alt="" title="" width="15" height="15">Suggestion List</button>
        <div id="suggestion-popup">
    <button id="close-popup-btn2"><img src="images/close.png" alt="" title="" width="30" height="30"></button>
    <h1 class="heading">Suggestion List</h1>
    <table class="sugg-table">
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
              <form method='POST' action='delete_suggestion.php'>
                  <input type='hidden' name='workshop_id' value='" . $row["Workshop_ID"] . "'>
                  <button type='submit'>Delete</button>
              </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";?>
    </table>
</div>
        <br>
        <br>
        <div style="overflow-y: auto;">
        <table id="All">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Sector</th>
                <th>Instructor</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($workshops as $workshop): ?>
            <tr>
                <td>
                    <?php echo $workshop['Workshop_ID']; ?>
                </td>
                <td> <?php echo $workshop['Title']; ?></td>
                <td><?php echo $workshop['Sector']; ?></td>
                <td><?php echo $workshop['Instructor']; ?></td>
                <td> 
                    <div class="section">
                        <form method="POST" action="about.php">
                            <input type="hidden" name="workshop_id" value="<?php echo $workshop['Workshop_ID']; ?>">
                            <button type="submit" id="add-<?php echo $workshop['Workshop_ID']; ?>" class="add-btn"><img src="images/about.png" alt="" title="" width="30" height="30"></button>
                        </form>
                    </div>
                </td>
                <td>
                    <div class="section">
                        <form method="POST" action="add_suggestion_list.php">
                            <input type="hidden" name="workshop_id" value="<?php echo $workshop['Workshop_ID']; ?>">
                            <button type="submit" id="add-<?php echo $workshop['Workshop_ID']; ?>" class="add-btn"><img src="images/add-1.png" alt="" title="" width="30" height="30"></button>
                        </form>
                    </div>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <br>
    </div>
    <script src="scripts.js"></script>
    <script>
       // call the displayDate function every second
    </script>
    <!-- Your workshop suggestion management content here -->
</body>
<footer>2024 Expert Sdn. Bhd. All Rights Reserved.</footer>
</html>
