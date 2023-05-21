<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta name="description" content="Basic HTML elements"/>
		<meta name="keywords" content="HTML5, tags"/>
		<meta name="author" content="mysha"/>
		<script src="#"></script>
		<title>Expert Training Management Portal</title>
		
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
			    // Redirect to login_customer.php if customerID is not provided
			    header("Location: login_customer.php");
			    exit();
			}

			// Query database for customer's information
			$stmt = mysqli_prepare($conn, "SELECT * FROM customer WHERE customerID = ?");
			mysqli_stmt_bind_param($stmt, 'i', $customerID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$customer = mysqli_fetch_assoc($result);
			mysqli_stmt_close($stmt);
		?>
	    <style>
        body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			background-color: #D4DFEF;
			min-height: 100vh;
			position: relative;
		}

		.header {
			background-color: #2F455C;
			color: #fff;
			text-align: left;
			padding: 10px 0;
			margin: 0;
		}

		.header-container {
			margin: 0 auto;
			padding: 0 30px; 
		}

		.container {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
			padding: 40px 0;
		}
		a {
			text-decoration: none;
			color: #2F455C;
		}

        h1 {
            text-align: center;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
			margin-bottom: 40px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input[type="submit"] {
            background-color: #2F455C;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #021226;
			transform: scale(1.03);
        }
		.footer {
			color: #2F455C;
			text-align: left;
			padding: 20px;
			bottom: 0;
			left: 0;
			right: 0;
		}

    </style>
			
	<div class="header">
			<div class="header-container">
				<h3>Welcome to Expert Training Management Portal </h3>
			</div>
	</div>
	<h1>Workshop Request Form</h1>
       <form action="submit_workshop_request.php?customerID=<?php echo $customerID; ?>" method="POST" onsubmit="return validateForm()">

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>
        
        <label for="sector">Sector:</label>
        <input type="text" id="sector" name="sector" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
        
        <label for="duration">Duration (in hours):</label>
        <input type="number" id="duration" name="duration" required><br><br>
        
        <label for="format">Format:</label>
        <input type="text" id="format" name="format" required><br><br>
        
        <label for="instructor_type">Instructor Type:</label>
        <input type="text" id="instructor_type" name="instructor_type" required><br><br>
        
        <input type="submit" value="Submit">
    </form>
	<script>
        function validateForm() {
            var title = document.getElementById("title").value;
            var sector = document.getElementById("sector").value;
            var description = document.getElementById("description").value;
            var duration = document.getElementById("duration").value;
            var format = document.getElementById("format").value;
            var instructorType = document.getElementById("instructor_type").value;

            if (title === "" || sector === "" || description === "" || duration === "" || format === "" || instructorType === "") {
                alert("Please fill in all fields.");
                return false; // Prevent form submission
            }
            
            return true; // Allow form submission
        }
    </script>
	<div class="footer">
			<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
	</div>
		
	</body>

</html>