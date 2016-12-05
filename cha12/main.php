<?php 
	session_start();
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Main page</title>
 </head>
 <body>
 	<h1>Welcome to the home page!</h1>
 	<?php 
 	//print_r($_SESSION);
 		if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
 			// user is logged in
 	?>
 	<p>Thank you for login to our system <b><?php echo $_SESSION['username']; ?></b></p>
 	<p>You may mow <a href="user_personal.php">click here</a> to go to your own personal informational area and update or remove your information should you wish to do so.</p>

 	<?php 
	 	if ($_SESSION['admin_level'] > 0) {
	 		echo '<p><a href="admin_area.php">Click here</a> to access your administrator tools.</p>';
	 	}
 	} else {  // user is not logged in ?>

 		<p>You are not currently not log in to our system. Once you log in you will have access to your personal area along with other information.</p>

		<p>If you have already registered, <a href="login.php">Click here</a> to log in. Or if you would like to create an account, <a href="register.php">Click here</a> to register.</p>
 	<?php } //print_r($_SESSION); ?>
 </body>
 </html>