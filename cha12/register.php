<?php 
	session_start();

	include 'db.inc.php';

	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD) or die ('Unable to connect, Please check your connection parameters.');

	mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

	$hobbies_list = array('Conputers', 'Dancing', 'Exercise','Flying', 'Golfimg', 'Hunting', 'Internet', 'Reading', 'Traveling', 'Other than listed');

	// filter incoming list
	//echo 'hi';
	$username = (isset($_POST['username']) ? trim($_POST['username']) : '');
	$password = (isset($_POST['password']) ? trim($_POST['password']) : '');
	$first_name = (isset($_POST['first_name']) ? trim($_POST['first_name']) : '');
	$last_name = (isset($_POST['last_name']) ? trim($_POST['last_name']) : '');
	$email = (isset($_POST['email']) ? trim($_POST['email']) : '');
	$city = (isset($_POST['city']) ? trim($_POST['city']) : '');
	$state = (isset($_POST['state']) ? trim($_POST['state']) : '');
	$hobbies = (isset($_POST['hobbies']) && is_array($_POST['hobbies'])) ? $_POST['hobbies'] : array();

	if(isset($_POST['submit']) && $_POST['submit'] == 'Register'){
		//echo 'submit';
		$errors = array();

		// make sure manditory have been entered

		if(empty($username)){
			$errors[] = 'User name cannot be blank.';
		}

		// Check username is already registered
		$query = 'SELECT username FROM site_user WHERE username = "' . $_POST['username'] . '"';
		$result = mysqli_query($db, $query) or die (mysqli_error($db));

		if(mysqli_num_rows($result) > 0){
			$errors[] = 'Username ' . $_POST['username'] . ' is already taken.';
			$username = '';
		}
		mysqli_free_result($result);

		if(empty($first_name)){
			$errors[] = 'First name cannot be blank.';
		}
		if(empty($last_name)){
			$errors[] = 'Last name cannot be blank.';
		}
		if(empty($password)){
			$errors[] = 'Password cannot be blank.';
		}
		if(empty($email)){
			$errors[] = 'Email cannot be blank.';
		}
		if(count($errors) > 0){
			echo '<p><strong style="color:#FF000;"> Unable to precess your registration.</strong></p>';
			echo '<p>Please fix the following</p>';
			echo '<ul>';
			foreach ($errors as $error) {
				echo '<li>' . $error . '</li>';
			}
			echo '<ul>';
		} else {
			//print_r($_POST);
			// No errors so enter information to the database
			$query = 'INSERT INTO site_user (user_id, username, password) VALUES (NULL, "' . mysqli_real_escape_string($db, $username) . '", PASSWORD("' . mysqli_real_escape_string($db, $password) . '"))';
			$result = mysqli_query($db, $query) or die (mysqli_error($db));
			$user_id = mysqli_insert_id($db);

			$query = 'INSERT IGNORE INTO site_user_info (user_id, first_name, last_name, email, city, state, hobbies) VALUES (' . $user_id . ', "' . mysqli_real_escape_string($db, $first_name) . '", "' . mysqli_real_escape_string($db, $last_name) . '", "' . mysqli_real_escape_string($db, $email) . '", "' . mysqli_real_escape_string($db, $city) . '", "' . mysqli_real_escape_string($db, $state) . '", "' . mysqli_real_escape_string($db, join(', ', $hobbies)) . '")';
			$result = mysqli_query($db, $query) or die (mysqli_error($db));

			$_SESSION['logged'] = 1;
			$_SESSION['username'] = $username;

			header('Refresh: 5; URL = main.php');
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Register</title>
 </head>
 <body>
 	<p><strong>Thank you <?php echo $username; ?> for registering !</strong></p>
 	<p>Your registration is complete. You are being sent to the page you requested. If your browser doesn't redirect peoperly after 5 seconds, <a href="main.php">Click here</a></p>
 </body>
 </html>
 <?php 
 	die();
	}
}
  ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Register</title>
 </head>
 <style type="text/css">
 	td { vertical-align: top; }
 </style>
 <body>
 	<form action="register.php" method="post">
 		<table>
 			<tr>
 				<td>
 					<label for="username">Username: </label>
 				</td>
 				<td>
 					<input type="text" name="username" id="username" size="20" maxlength="20" value="<?php echo $username; ?>">
 				</td>
 			</tr>
 			<tr>
 				<td>
 					<label for="Password">Password: </label>
 				</td>
 				<td>
 					<input type="password" name="password" id="password" size="20" maxlength="20" value="<?php echo $password; ?>">
 				</td>
 			</tr>
 			<tr>
 				<td>
 					<label for="first_name">First name: </label>
 				</td>
 				<td>
 					<input type="text" name="first_name" id="first_name" size="20" maxlength="20" value="<?php echo $first_name; ?>">
 				</td>
 			</tr>
 			<tr>
 				<td>
 					<label for="last_name">Last name: </label>
 				</td>
 				<td>
 					<input type="text" name="last_name" id="last_name" size="20" maxlength="20" value="<?php echo $last_name; ?>">
 				</td>
 			</tr>
 			<tr>
 				<td>
 					<label for="Email">Email: </label>
 				</td>
 				<td>
 					<input type="text" name="email" id="email" size="50" maxlength="50" value="<?php echo $email; ?>">
 				</td>
 			</tr>
 			<tr>
 				<td>
 					<label for="City">City: </label>
 				</td>
 				<td>
 					<input type="text" name="city" id="city" size="20" maxlength="20" value="<?php echo $city; ?>">
 				</td>
 			</tr>
 			<tr>
 				<td>
 					<label for="State">State: </label>
 				</td>
 				<td>
 					<input type="text" name="state" id="state" size="2" maxlength="2" value="<?php echo $state; ?>">
 				</td>
 			</tr>
 			<tr>
 				<td>
 					<label for="Hobbies">Hobbies/Interest: </label>
 				</td>
 				<td>
 					<select name="hobbies[]" id="hobbies" multiple="multiple">
 					<?php 
 						foreach ($hobbies_list as $hobby) {
 							if (in_array($hobby, $hobbies_list)) {
 								echo '<option value="' . $hobby . '" selected>' . $hobby . '</option>';
 							} else {
 								echo '<option value="' . $hobby . '">' . $hobby . '</option>';
 							}
 						}
 					 ?>
 					 </select>
 				</td>
 			</tr>
 			<tr>
 				<td></td>
 				<td>
 					<input type="submit" name="submit" value="Register">
 				</td>
 			</tr>
 		</table>
 	</form>
 </body>
 </html>