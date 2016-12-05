<?php 
	include 'auth.inc.php';
	include 'db.inc.php';
	
	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD) or die ('Unable to connect, Please check your connection parameter.');
	mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>personal info</title>
 </head>
 <body>
 	<h1>Welcome to your personal information area!</h1>
 	<p>Here you can update your personal information, or delete your account.</p>
 	<p>Your information as you currently have it is shon below.</p>
 	<p><a href="main.php">Click here</a> to return to the home page</p>

 	<?php 
<<<<<<< HEAD
 	//print_r($_SESSION);
 		$query = 'SELECT username, first_name, last_name, city, state, email, hobbies FROM site_user u JOIN site_user_info i ON u.user_id = i.user_id WHERE username = "' . mysqli_real_escape_string($db, $_SESSION['username']) . '"';
 		$result = mysqli_query($db, $query) or die(mysqli_error($db));
=======
 		$query = 'SELECT username, first_name, last_name, city, state, email, hobbies FROM site_user u JOIN site_user_info i ON u.user_id = i.user_id WHERE username = "' . mysqli_real_escape_string($_SESSION['username'], $db) . '"';
 		$result = mysqli_query($db, $query)) or die(mysqli_error($db));
>>>>>>> origin/master
		
		$row = mysqli_fetch_array($result);
		extract($row);
		mysqli_free_result($result);
		mysqli_close($db);
 	 ?>
 	 <ul>
 	 	<li>First Name: <?php echo $first_name; ?></li>
 	 	<li>Last Name: <?php echo $last_name; ?></li>
 	 	<li>City: <?php echo $city; ?></li>
 	 	<li>State Name: <?php echo $state; ?></li>
 	 	<li>Email Name: <?php echo $email; ?></li>
 	 	<li>Hobbies/Interest Name: <?php echo $hobbies; ?></li>
 	 </ul>
 	 <p><a href="update_account.php">Update Account</a>
 	 	<a href="delete_account.php">Delete Account</a></p>
 </body>
 </html>