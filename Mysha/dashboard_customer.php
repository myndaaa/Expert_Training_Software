
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta name="description" content="Basic HTML elements"/>
		<meta name="keywords" content="HTML5, tags"/>
		<meta name="author" content="mysha"/>
		<script src="#"></script>
		<title>Expert Training Management Portal</title>
		<link rel="stylesheet" href="styles.css"/>
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
		<div class="header">
			<div class="header-container">
				<h3>Welcome to Expert Training Management Portal    <span>------------------------ --------------------------------------------------------------------------------------------------------------------------------------------------------------</span>                                       
				<a href = "cprofile.php?customerID=<?php echo $customerID; ?>"><img src="images/profile3.png" alt=""></a><span>---------</span>
				<a href = "message.php?customerID=<?php echo $customerID; ?>"><img src="images/message.png" alt=""></a><span>-----</span>
				<a href = "cnotification.php?customerID=<?php echo $customerID; ?>"><img src="images/notification.png" alt=""></a></h3>
				<style>
				span{
				color: #2F455C;
				}
				</style>
			</div>
		</div>
	
			
		
		<div class = "name"></div>
		<h2 id = "firstname">Welcome <?php echo $customer['firstName']; ?></h2>	
<style>
#firstname {
  margin-left: 20px;
  font-size: 37px;
  font-weight: bold;
  color: #2F455C;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}
</style>
		<div class="container">			
				<a href="editcustomer.php?customerID=<?php echo $customerID; ?>">					
					<div class="box left-box"><h2>Edit Profile</h2>	</div>				
				</a>		
				<a href="workshoprequest.php?customerID=<?php echo $customerID; ?>">				
					<div class="box left-box"><h2>Workshop Enquiry</h2>	</div>			
				</a>
				<a href=".php?customerID=<?php echo $customerID; ?>">				
					<div class="box left-box"><h2>Your Workshops</h2>	</div>			
				</a>
		</div>
			<button class="logout-btn" onclick="location.href='login_customer.php'">Log Out</button>
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
		</div>
		
		<div class="footer">
			<p>2023 Expert Sdn. Bhd. All Rights Reserved.</p>
		</div>
		
	</body>

</html>