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
        <h2>Workshop Processing</h2>
        <div class="line"></div>
    </div>
    <div class="text">
        <p>Send and receive information related to workshop venue, itenerary and related documents</p>
    </div>
    <div class="tab-container">
  <button class="tablinks" onclick="openTab(event, 'attendee')">Attendees</button>
  <button class="tablinks" onclick="openTab(event, 'venue')">Venue</button>
  <button class="tablinks" onclick="openTab(event, 'itinerary')">Itinerary</button>
  <button class="tablinks" onclick="openTab(event, 'document')">Document Upload</button>

  <div id="attendee" class="tabcontent">
    <h3>Attendee Information</h3>
    <p><table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Age</th>
      <th>Email</th>
      <th>Phone Number</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>John Doe</td>
      <td>30</td>
      <td>johndoe@example.com</td>
      <td>123-456-7890</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Jane Doe</td>
      <td>25</td>
      <td>janedoe@example.com</td>
      <td>123-456-7890</td>
    </tr>
    <tr>
      <td>3</td>
      <td>Bob Smith</td>
      <td>40</td>
      <td>bobsmith@example.com</td>
      <td>123-456-7890</td>
    </tr>
  </tbody>
</table>
</p>
  </div>

  <div id="venue" class="tabcontent">
    <h3>Venue Information</h3>
    <p><div class="venue-info">
            <ul>
                <li><strong>Name:</strong> Venue Name</li>
                <li><strong>Address Line 1:</strong> 123 Main Street</li>
                <li><strong>Address Line 2:</strong> Suite 100</li>
                <li><strong>City:</strong> New York</li>
                <li><strong>State:</strong> NY</li>
                <li><strong>Postal Code:</strong> 10001</li>
                <li><strong>Country:</strong> United States</li>
            </ul>
    </div></p>
    <button class="rounded-button" id="VRequest-btn">Request Venue</button>
    <button class="rounded-button" id="VSuggest-btn">Suggest Venue</button>
    <br>
    <br>

    <div class="venue-form">
        <form>
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
    <h3>Itinerary Content</h3>
    <p>This is the content for the Itinerary tab.</p>
  </div>

  <div id="document" class="tabcontent">
    <h3>Document Upload Content</h3>
    <p>This is the content for the Document Upload tab.</p>
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

</script>


    </body>
</html>
