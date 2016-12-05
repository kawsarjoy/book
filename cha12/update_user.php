<?php 
	include 'auth.inc.php';

	if($_SESSION['admin_level'] < 1){
		header('Refresh:5; UTL=user_personal.php');
		echo '<p><strong>You are not authorized for this page.</strong></p>';
		echo '<p>You are being redirected to the main page. If your browser doesn\'t redirect automatically, Please <a href="main.php>Click here</a></p>.';
		die();
	}
	include 'db.inc.php';

	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD) or die ('Unable to connect, Please check your connection parameters.');
	mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

	$hobbies_list = array('Computers', 'Internet', 'Reading', 'Golf', 'Flying', 'Traveling', 'Hunting', 'Exercise', 'Other than listed');

	if (isset($_POST['submit']) && $_POST['submit'] = 'Update') {
		$user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
		$password = (isset($_POST['password'])) ? $_POST['password'] : '';
		$username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
		$first_name = (isset($_POST['first_name'])) ? trim($_POST['first_name']) : '';
		$last_name = (isset($_POST['last_name'])) ? trim($_POST['last_name']) : '';
		$email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
		$city = (isset($_POST['city'])) ? trim($_POST['city']) : '';
		$state = (isset($_POST['state'])) ? trim($_POST['state']) : '';
		$hobbies = (isset($_POST['hobbies_list']) && is_array($_POST['hobbies_list'])) ? $_POST['hobbies_list'] : array();

		// delete user record
		if(isset($_POST['delete'])){
			$query = 'DELETE FROM site_user_info WHERE user_id="' . $user_id . '"';
			mysqli_query($db, $query) or die (mysqli_error($db));
			$query = 'DELETE FROM site_user WHERE user_id="' . $user_id . '"';
			mysqli_query($db, $query) or die (mysqli_error($db));
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Update Account Info</title>
 </head>
 <body>
 	<p><strong>The account has been deleted.</strong></p>
 	<p><a href="admin_area.php">Click here</a> to return to the admin area.</p>
 </body>
 </html>

<?php 
 	die();
 }

 $errors = array();
 if (empty($username)) {
 	$errors[] = 'Username connot be blank.';
 }
 // Check username already is registered
 $query = 'SELECT username FROM site_user WHERE username = "' . $username . '" AND user_id !=' . $user_id;
 $result = mysqli_query($db, $query) or die (mysqli_error($db));

 if(mysqli_num_rows($result) > 0){
 	$errors[] = 'Username' . $username . ' is already registered';
 	$username = '';
 }
 mysqli_free_result($result);

 if (empty($first_name)) {
 	$errors[] 'First name cannot be blank.';
 }
 if (empty($last_name)) {
 	$errors[] 'Last name cannot be blank.';
 }
 if (empty($email)) {
 	$errors[] 'Email Address cannot be blank.';
 }
 if(count($errors) > 0){
 	echo '<p><strong style="color:#FF000;">Unable to update the account information.</strong></p>';
 	echo '<p>Please fix the following:</p>';
 	echo '<ul>';
 	foreach ($errors as $error) {
 		echo '<li>' . $error . '</li>';
 	}
 	echo '</ul>';
 } else {
 	// no errors so enter the information into database
 	if(!empty($password)){
 		$query = 'UPDATE site_user SET password = PASSWORD("' . mysqli_real_escape_string($password, $db) . '") WHERE user_id=' . $user_id;
 		mysqli_query($db, $query) or die (mysqli_error($db));
 	}

 	$query = 'UPDATE site_user u, site_user_info SET
 	 username = "' . mysqli_real_escape_string($username, $db) . '",
 	 first_name = "' . mysqli_real_escape_string($first_name, $db) . '",
 	 last_name = "' . mysqli_real_escape_string($last_name, $db) . '",
 	 email = "' . mysqli_real_escape_string($email, $db) . '",
 	 state = "' . mysqli_real_escape_string($state, $db) . '",
 	 sity = "' . mysqli_real_escape_string($city, $db) . '",
 	 hobbies = "' . mysqli_real_escape_string(join(',', $hobbies), $db) . '" WHERE user_id = ' . $user_id;
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
	<p><strong>The account information has been updated.</strong></p>
	<p><a href="admin_area.php">Click here</a> to return to the admin area.</p>
</body>
</html>
<?php 
	die();
} else {
	$user_id = (isset($_GET['id']) ? $_GET['user_id'] : 0);
	if($user_id == 0){
		header('Location: admin_area.php');
		die();
	}

	$query = 'SELECT username, first_name, last_name, email, city, state, hobbies AS my_hobby FROM site_user u JOIN site_user_info i ON u.user_id = i.user_id WHERE user_id=' . $user_id;
	$result = mysqli_query($db, $query) or die (mysqli_error($db));
	if(mysqli_num_rows($result) == 0){
		header('Location: admin_area.php');
		die();
	}

	$row = mysqli_fetch_assoc($result);
	extract($row);
	$password = '';
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
 		window.onload = function(){
 			document.getElementById('cancel').onclick = goBack;
 		}
 		function goBack(){
 			history.go(-1);
 		}
 	</script>
 </head>
 <body>
 	<h1>Update Account Information</h1>
 	<form action="update_user.php" method="post">
 		<table>
 			<tr>
 				<td><label for="username">Username: </label></td>
 				<td><input type="text" name="username" id="password" size="20" maxlength="20" value="<?php echo $username; ?>"></td>
 			</tr>
 			<tr>
 				<td><label for="password">Password: </label></td>
 				<td><input type="password" name="password" id="password" size="20" maxlength="20" value="<?php echo $password; ?>"><small>(Leave blank if you're not changing the password.)</small></td>
 			</tr>
 			<tr>
 				<td><label for="email">Email: </label></td>
 				<td><input type="text" name="email" id="email" size="20" maxlength="20" value="<?php echo $email; ?>"></td>
 			</tr>
 			<tr>
 				<td><label for="first_name">First name: </label></td>
 				<td><input type="text" name="first_name" id="first_name" size="20" maxlength="20" value="<?php echo $first_name; ?>"></td>
 			</tr>
 			<tr>
 				<td><label for="last_name">Last name: </label></td>
 				<td><input type="text" name="last_name" id="last_name" size="20" maxlength="20" value="<?php echo $last_name; ?>"></td>
 			</tr>
 			<tr>
 				<td><label for="city">City: </label></td>
 				<td><input type="text" name="city" id="city" size="20" maxlength="20" value="<?php echo $city; ?>"></td>
 			</tr>
 			<tr>
 				<td><label for="state">State: </label></td>
 				<td><input type="text" name="state" id="state" size="2" maxlength="2" value="<?php echo $state; ?>"></td>
 			</tr>
 			<tr>
 				<td><label for="hobbies">Hobbies/Interest: </label></td>
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
 				<?php 
 					if($_SESSION['admin_level'] == 1){
 						echo '</tr><tr>';
 						echo '<td></td>';
 						echo '<td><input type = "checkbox" name="delete" id="delete"><label for="delete">Delete</label></td>';
 					}
 				 ?>
 			</tr>
 			<tr>
 				<td></td>
 				<td>
 					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
 					<input type="submit" name="submit" value="Update">
 					<input type="button" id="cancel" value="Cancel">
 				</td>
 			</tr>
 		</table>
 	</form>
 </body>
 </html>