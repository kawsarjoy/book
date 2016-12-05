<?php 
	include 'auth.inc.php';
	include 'db.inc.php';

	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD) or die ('Unable to connect, Please check your connection parameters.');
	mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

	$hobbies_list = array('Computers', 'Dancing', 'Golf', 'Internet', 'Reading', 'Traveling', 'Exercise', 'flying', 'Hunting', 'Other than listed');

	if(isset($_POST['submit']) && $_POST['submit'] == 'Update'){
		// filter incoming values 
		
		$username = (isset($_POST['username']) ? trim($_POST['username']) : '');
		$user_id = (isset($_POST['user_id']) ? $_POST['user_id'] : '');
		$first_name = (isset($_POST['first_name']) ? trim($_POST['first_name']) : '');
		$last_name = (isset($_POST['last_name']) ? trim($_POST['last_name']) : '');
		$email = (isset($_POST['email']) ? trim($_POST['email']) : '');
		$city = (isset($_POST['city']) ? trim($_POST['city']) : '');
		$state = (isset($_POST['state']) ? trim($_POST['state']) : '');
		$hobbies = (isset($_POST['hobbies']) && is_array($_POST['hobbies']) ? $_POST['hobbies'] : array());

		$errors = [];

		// make sure the username and user_id is a valid pair ( we don't want people to try and manipulate the form to hack someone else's account)
		
		$query = 'SELECT username FROM site_user WHERE user_id = "' . (int)$user_id . '" AND username = "' . mysqli_real_escape_string($db, $_SESSION['username']) . '"';
		$result = mysqli_query($db, $query) or die (mysqli_error($db));

		if(mysqli_num_rows($result) == 0){
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Update Account Form</title>
 </head>
 <body>
 	<p><strong>Don't try to break out form!</strong></p>
 </body>
 </html>

 <?php 
 	mysqli_free_result($result);
 	mysqli_close($db);
 	die();
 }

 	mysqli_free_result($result);

 	if (empty($first_name)) {
 		$errors[] = 'First name cannot be blank!';
 	}
 	if (empty($last_name)) {
 		$errors[] = 'last name cannot be blank!';
 	}
 	if (empty($email)) {
 		$errors[] = 'email cannot be blank!';
 	}
 	if(count($errors) > 0){
 		echo '<p><strong style="color: #FF000">;Unable to update your account information</strong></p>';
 		echo '<p>Please fix the following:</p>';

 		echo '<ul>';
 		foreach ($errors as $error) {
 			echo '<li>' . $error . '</li>';
 		}
 		echo '</ul>';
 	} else {
 		// No errors so entered the infotmation in database
 		$query = 'UPDATE site_user_info SET 
 				first_name = "' . mysqli_real_escape_string($db, $first_name) . '",
 				last_name = "' . mysqli_real_escape_string($db, $last_name) . '",
 				email = "' . mysqli_real_escape_string($db, $email) . '",
 				city = "' . mysqli_real_escape_string($db, $city) . '",
 				state = "' . mysqli_real_escape_string($db, $state) . '",
 				hobbies = "' . mysqli_real_escape_string($db, join(',', $hobbies)) . '"
 				WHERE user_id = ' . $user_id;
 		mysqli_query($db, $query) or die (mysqli_error($db));
 		mysqli_close($db);
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
  	<meta charset="UTF-8">
  	<title>Update Account Info</title>
  </head>
  <body>
  	<p><strong>Your account information has been updated.</strong></p>
  	<p><a href="user_personal.php"> Click here</a> to return to your account.</p>
  </body>
  </html>

  <?php 
  	die();
  }
} else {
<<<<<<< HEAD
	$query = 'SELECT u.user_id, first_name, last_name, email, city, state, hobbies AS my_hobby FROM site_user u JOIN site_user_info i ON u.user_id = i.user_id WHERE username = "' . mysqli_real_escape_string($db, $_SESSION['username']) . '"';
=======
	$query = 'SELECT u.user_id, first_name, last_name, email, city, state, hobbies AS my_hobby FROM site_user u JOIN site_user_info i ON u.user_id = i.user_id WHERE username = "' . mysqli_real_escape_string($_SESSION['username'], $db) . '"';
>>>>>>> origin/master
	$result = mysqli_query($db, $query) or die (mysqli_error($db));
	$row = mysqli_fetch_assoc($result);

	extract($row);

	$hobbies = explode(',', $my_hobby);

	mysqli_free_result($result);
	mysqli_close($db);
}
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update Account Info</title>
	<style type="text/css">
		td { vertical-align: top; }
	</style>
	<script type="text/javascript">
		window.onload = function() {
			document.getElementById('cancel').onclick = goBack;
		}
		function goBack(){
			history.go(-1);
		}
	</script>
</head>
<body>
	<h1>Update Account Information</h1>
	<form action="update_account.php" method="post">
		<table>
			<tr>
				<td>
					Username:
				</td>
				<td>
					<input type="text" value="<?php echo $_SESSION['username']; ?>" disabled>
				</td>
			</tr>
			<tr>
				<td>
					<label for="email">Email: </label>
				</td>
				<td>
					<input type="text" name="email" id="email" size="20" maxlength="50" value="<?php echo $email; ?>"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="first_name">First name: </label>
				</td>
				<td>
					<input type="text" name="first_name" id="first_name" size="20" maxlength="20" value="<?php echo $v; ?>"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="last_name">Last name: </label>
				</td>
				<td>
					<input type="text" name="last_name" id="last_name" size="20" maxlength="20" value="<?php echo $last_name; ?>"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="city">City: </label>
				</td>
				<td>
					<input type="text" name="city" id="city" size="20" maxlength="20" value="<?php echo $city; ?>"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="state">State: </label>
				</td>
				<td>
					<input type="text" name="state" id="state" size="2" maxlength="5" value="<?php echo $state; ?>"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="hobbies">Hobbies/Interest:</label>
				</td>
				<td>
					<select name="hobbies[]" id="hobbies" multiple="multiple">
					<?php 
						foreach ($hobbies_list as $hobby) {
							if(in_array($hobby, $hobbies)){
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
					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
					<input type="submit" name="submit" value="Update">
					<input type="button" name="cancel" value="Cancel">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>