<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MSP";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch the last row from the table
$sql = "SELECT * FROM venue ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

// Retrieve the itinerary data from the table
$sql1 = "SELECT start_time, _Activity FROM itinerary";
$result1 = $conn->query($sql1);

// Retrieve data from the table
$sql2 = "SELECT name, age, email, phone FROM attendee";
$result2 = $conn->query($sql2);

// Retrieve the document data from the table
$sql3 = "SELECT docname, docfile FROM document";
$result3 = $conn->query($sql3);



if ($result->num_rows > 0) {
  // Store the values in variables
  $row = $result->fetch_assoc();
  $name = $row["_Name"];
  $address1 = $row["Address_L1"];
  $address2 = $row["Address_L2"];
  $city = $row["City"];
  $state = $row["_State"];
  $postal_code = $row["Postal_Code"];
  $country = $row["Country"];
}


$conn->close();
?>


<!DOCTYPE html>
    <head>
        <title>Workshop Processing</title>
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

        .tablinks {
            border-radius: 8px;
            border: 3px solid #2f455c;
            padding: 10px 20px;
            background-color: #fff;
            color: #333;
            font-weight: bold;
            cursor: pointer;
            vertical-align: middle;
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
            margin-left:10px;
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





.tabcontent {
  display: none;
  margin-top: 20px;
  margin-left: 10px;
  margin-right: 100px;
  border: 3px solid #2f455c;
  background-color:#fff;
}

.tabcontent h3 {
  margin-top: 0;
  margin-left: 15px;
  margin-top: 10px;
}

.tabcontent p {
  margin-bottom: 0;
  margin-left: 15px;
  margin-top: 10px;
}


.venue-info {
  padding: 15px;
}


.venue-info ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.venue-info li {
  margin-bottom: 5px;
}

.venue-form {
  display: none;
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
        <h2>Workshop Processing - Customer</h2>
        <div class="line"></div>
    </div>
    <div class="text">
        <p>Send and receive information related to workshop venue, itenerary and related documents</p>
    </div>
    <div class="tab-container">
  <button class="tablinks" onclick="openTab(event, 'attendee')">Attendees</button>
  <button class="tablinks" onclick="openTab(event, 'venue')">Venue</button>
  <button class="tablinks" onclick="openTab(event, 'itinerary')">Itinerary</button>
  <button class="tablinks" onclick="openTab(event, 'document')">Document Download</button>

  <div id="attendee" class="tabcontent">
    <h3>Attendee Information</h3>
    <?php
// Check if there are any rows returned
if ($result2->num_rows > 0) {
  // Start creating the HTML table
  echo '<table border="1">
          <tr>
              <th>Name</th>
              <th>Age</th>
              <th>Email</th>
              <th>Phone</th>
          </tr>';

  // Output data of each row
  while ($row2 = $result2->fetch_assoc()) {
      echo '<tr>
              <td>' . $row2["name"] . '</td>
              <td>' . $row2["age"] . '</td>
              <td>' . $row2["email"] . '</td>
              <td>' . $row2["phone"] . '</td>
            </tr>';
  }
  echo '</table>';
} else {
  echo "No itinerary data found.";
}
?>
<br>
<form method="post" action="attendee-form.php">
    <div id="row-container5">
      <div class="row5">
        <input type="text" name="name[]" placeholder="Name" required>
        <input type="number" name="age[]" placeholder="Age" required>
        <input type="email" name="email[]" placeholder="Email" required>
        <input type="text" name="phone[]" placeholder="Phone" required>
        <button type="button" class="remove-row-btn" onclick="removeRow(this)">Remove</button>
      </div>
    </div>
    <div class="form-controls">
      <button type="button" class="add-row-btn5" onclick="addRow()">Add Row</button>
      <button type="submit">Submit</button>
    </div>
  </form>

  </div>

  <div id="venue" class="tabcontent">
    <h3>Venue Information</h3>
    <p>
    <div class="venue-info">
        <ul>
            <li><strong>Name:</strong> <?php echo $name; ?></li>
            <li><strong>Address Line 1:</strong> <?php echo $address1; ?></li>
            <li><strong>Address Line 2:</strong> <?php echo $address2; ?></li>
            <li><strong>City:</strong> <?php echo $city; ?></li>
            <li><strong>State:</strong> <?php echo $state; ?></li>
            <li><strong>Postal Code:</strong> <?php echo $postal_code; ?></li>
            <li><strong>Country:</strong> <?php echo $country; ?></li>
        </ul>
    </div>
</p>

    <button class="rounded-button" id="VRequest-btn">Request Venue</button>
    <button class="rounded-button" id="VSuggest-btn">Suggest Venue</button>
    <br>
    <br>

    <div class="venue-form" >
        <form method="post" action="venue-form.php">
            <label for="venue-name">Venue Name:</label>
            <input type="text" id="venue-name" name="venue-name"><br>

            <label for="address-line-1">Address Line 1:</label>
            <input type="text" id="address-line-1" name="address-line-1"><br>

            <label for="address-line-2">Address Line 2:</label>
            <input type="text" id="address-line-2" name="address-line-2"><br>

            <label for="city">City:</label>
            <input type="text" id="city" name="city"><br>

            <label for="state">State:</label>
            <input type="text" id="state" name="state"><br>

            <label for="postal-code">Postal Code:</label>
            <input type="text" id="postal-code" name="postal-code"><br>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country"><br>
            <br>
            <button type="submit">Submit</button>
            <button onclick="goBack()">Close Form</button>
        </form>
    </div>

  </div>

  <div id="itinerary" class="tabcontent">
    <h3>Itinerary Handling</h3>

        <?php
    // Check if there are any rows returned
    if ($result1->num_rows > 0) {
      // Start creating the HTML table
      echo '<table border="1">
              <tr>
                  <th>Start Time</th>
                  <th>Activity</th>
              </tr>';

      // Output data of each row
      while ($row1 = $result1->fetch_assoc()) {
          echo '<tr>
                  <td>' . $row1["start_time"] . '</td>
                  <td>' . $row1["_Activity"] . '</td>
                </tr>';
      }

      echo '</table>';
    } else {
      echo "No itinerary data found.";
    }
    ?>
    <br>
    <div class="status"></div>
  </div>
  </div>
</div>

  <div id="document" class="tabcontent">
  <h3>Document Downalod</h3>
  <?php
  // Check if there are any rows returned
if ($result3->num_rows > 0) {
  // Start creating the HTML table
  echo '<table border="1">
          <tr>
              <th>Document Name</th>
              <th>Download</th>
          </tr>';

  // Output data of each row
  while ($row3 = $result3->fetch_assoc()) {
      echo '<tr>
              <td>' . $row3["docname"] . '</td>
              <td><a href="download.php?docname=' . urlencode($row3["docname"]) . '">Download</a></td>
            </tr>';
  }

  echo '</table>';
} else {
  echo "No document data found.";
}
  ?>
  <br>
    <div class="status"></div>
  </div>
  <p></p>
  </div>
</div>




    <script>
  function displayDate() {
    var date = new Date();
    var options = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    };
    var formattedDate = date.toLocaleDateString('en-US', options);
    document.getElementById('date').innerHTML = formattedDate;
  }
// call the displayDate function every second
setInterval(displayDate, 1000);

function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].classList.remove("active");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.classList.add("active");
}

const suggestBtn = document.getElementById('VSuggest-btn');
const venueForm = document.querySelector('.venue-form');

suggestBtn.addEventListener('click', () => {
  venueForm.style.display = 'block';
});

function goBack() {
  venueForm.style.display = 'none';
}





document.addEventListener("click", function(event) {
    if (event.target.classList.contains("remove-row-btn")) {
        var row = event.target.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
});


 


  // JavaScript code
  document.addEventListener("DOMContentLoaded", function() {
    // Get the "Add Row" button element
    var addRowBtn = document.querySelector(".add-row-btn5");

    // Add event listener to the button
    addRowBtn.addEventListener("click", function() {
      var rowContainer = document.querySelector("#row-container5");
      var newRow = document.createElement("div");
      newRow.className = "row5";
      newRow.innerHTML = `
        <input type="text" name="name[]" placeholder="Name" required>
        <input type="number" name="age[]" placeholder="Age" required>
        <input type="email" name="email[]" placeholder="Email" required>
        <input type="text" name="phone[]" placeholder="Phone" required>
        <button type="button" class="remove-row-btn" onclick="removeRow(this)">Remove</button>
      `;
      rowContainer.appendChild(newRow);
    });
  });








 

  // Remove Row button functionality
  function removeRow(button) {
    var row = button.parentNode;
    row.parentNode.removeChild(row);
  }
</script>

  </body>
</html>

