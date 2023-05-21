
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Password Reset"/>
    <meta name="keywords" content="password reset"/>
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
	<div class="container">
		<div class="login-form">
			<h2>Reset Password</h2>
			<form id="reg" action="resetpasswordemp.php" method="POST" novalidate="novalidate" onsubmit="return validateForm();">
				<label for="email">Email:</label>
				<input type="text" id="email" name="email" placeholder="Enter email" required><br>
				<label for="username">Username:</label>
				<input type="text" id="username" name="username" placeholder="Enter username" required><br>
				<label for="password">New Password:</label>
				<input type="password" id="password" name="npassword" placeholder="new password" required><br>
			
			<button id="reset-button" type="submit" class="btn">Change Password</button>
		</form>		
	</div>
</div>
<div class="footer">
			<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
		</div>
		<script>
		function validateForm() {
  // Get the values of the input fields
  var username = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  
  if (email == "" ||  username == "" || password == "") {
    alert("Please fill in all the required fields.");
    return false;
  }

  // Check if the email address is valid
  var emailRegex = /^\S+@\S+\.\S+$/;
  if (!emailRegex.test(email)) {
    alert("Please enter a valid email address.");
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

