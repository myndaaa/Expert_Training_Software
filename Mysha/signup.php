<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta name="description" content="Basic HTML elements"/>
		<meta name="keywords" content="HTML5, tags"/>
		<meta name="author" content="mysha"/>
		<title>Expert Training Management Portal</title>
		<link rel="stylesheet" href="styles.css"/>
	</head>

	<body>
		<div class="header">
			<div class="header-container">
				<h3>Welcome to Expert Training Management Portal</h3>
			</div>
		</div>
		<div id= "registration">
			<form id="reg" action="verification.php" method="POST" novalidate="novalidate" onsubmit="return validateForm();">
			<div class = "row">
				<div class= "column">
					<div class= "card">
						<h4>Upload your Profile Picture</h4>
						<img src = "images/profile.png" id = "profile-pic">
						<input type="file" accept="image/jpeg, image/png, image/jpg" id="input-file">
						
					</div>					
				</div>
				<div class = "column">
				
					<input type="text" id="fname" name="user_fname" placeholder="Enter your first name" required="required">					
					<input type="text" id="lname" name="user_lname" placeholder="Enter your last name" required="required">										
					<input type="text" id="email" name="email" placeholder="Enter your email address" required="required">							
					<input type="text" id="pprt" name="passport" placeholder="Enter your passport number" required="required">										
					<input type="text" id="ic" name="ic" placeholder="Enter your IC number" required="required">						
					<input type="text" id="phone" name="phn" placeholder="Enter your phone number" required="required">										
					
				
				</div>
				
				<div class ="column">
					<input type="text" id="orgntn" name="org" placeholder="Enter your Organization name" required="required">								
					<input type="text" id="postcode" name="postcode" placeholder="Enter your organization postal code" required="required">			
					<input type="text" id="street" name="strt" placeholder="Enter your organization street adress" required="required">		
					<input type="text" id="city" name="city" placeholder="Enter your organization city name" required="required"></br></br></br>
					<input type="text" id="username" name="uname" placeholder="Create a username for your account" required="required">
					<input type="password" id="pw" name="password" placeholder="create a password for your account" required="required"></br>
					<button type="submit" class="btn" name="submit">Register</button>
					
					<p id="doraemon"> Already have an account? <a href = "login_customer.php">Log in</a></p>
				
				</div>
			</div>
			</form>
		</div>
		


		<div class="footer">
			<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
		</div>
	<script>
		let profilePic = document.getElementById("profile-pic");
		let inputFile = document.getElementById("input-file");
		let registerButton = document.querySelector("#reg button[type='submit']");

		inputFile.onchange = function() {
			console.log('File selected:', inputFile.files[0]);
			profilePic.src = URL.createObjectURL(inputFile.files[0]);
		};

		function validateForm() {
  // Get the values of the input fields
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var email = document.getElementById("email").value;
  var passport = document.getElementById("pprt").value;
  var ic = document.getElementById("ic").value;
  var phone = document.getElementById("phone").value;
  var org = document.getElementById("orgntn").value;
  var postcode = document.getElementById("postcode").value;
  var street = document.getElementById("street").value;
  var city = document.getElementById("city").value;
  var uname = document.getElementById("username").value;
  var password = document.getElementById("pw").value;

  // Check if any of the input fields are empty
  if (fname == "" || lname == "" || email == "" || passport == "" || ic == "" || phone == "" || org == "" || postcode == "" || street == "" || city == "" || uname == "" || password == "") {
    alert("Please fill in all the required fields.");
    return false;
  }

  // Check if the email address is valid
  var emailRegex = /^\S+@\S+\.\S+$/;
  if (!emailRegex.test(email)) {
    alert("Please enter a valid email address.");
    return false;
  }

  // Check if the passport number is valid
  var passportRegex = /^[A-Z]{2}[0-9]{7}$/;
  if (!passportRegex.test(passport)) {
    alert("Please enter a valid passport number.");
    return false;
  }

  // Check if the IC number is valid
  var icRegex = /^[0-9]{6}-[0-9]{2}-[0-9]{4}$/;
  if (!icRegex.test(ic)) {
    alert("Please enter a valid IC number.");
    return false;
  }

  // Check if the phone number is valid
  var phoneRegex = /^\d{10}$/;
  if (!phoneRegex.test(phone)) {
    alert("Please enter a valid phone number.");
    return false;
  }

  // Check if the username is at least 6 characters
  if (uname.length < 6) {
    alert("Username should be at least 6 characters.");
    return false;
  }

  // Check if the password is at least 8 characters
  if (password.length < 8) {
    alert("Password should be at least 8 characters.");
    return false;
  }

  // If all the input fields are valid, return true to submit the form
  return true;
}

	</script>
	</body>

</html>