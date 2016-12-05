<?php 
	session_start();

	include 'db.inc.php';
	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD) or die ('Unable to connect, Please Check your connection parameters.');
	mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

	// filter before values
	//echo $_POST['username'];
	//echo $_POST['password'];
	$username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
	$password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
	$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'main.php';

	if(isset($_POST['submit'])){
		//echo 'Hi';
		$query = 'SELECT admin_level FROM site_user WHERE username = "' . mysqli_real_escape_string($db, $username) . '" AND password = PASSWORD("' . mysqli_real_escape_string($db, $password) . '")';

		$result = mysqli_query($db, $query) or die (mysqli_error($db));
		if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				$_SESSION['username'] = $username;
				$_SESSION['logged'] = 1;
				$_SESSION['admin_level'] = $row['admin_level'];
				header('Refresh : 5; URL = ' . $redirect);
				echo '<p>You will be redirect your original page requested.</p>';
				echo '<p>If your browser doesn\'t redirect you properly autometically <a href = "' . $redirect . '"> Click here </a></p>';
				die(); 
			} else {
				// ste this explicitly just to make sure
				$_SESSION['username'] = '';
				$_SESSION['logged'] = 0;
				$_SESSION['admin_level'] = 0;
				$error = '<p><strong> You have supplied invalid username and/or password!</strong> Please <a href="register.php"> Click here</a> if you have not done so already</p>';
			}
			mysqli_free_result($result);
	}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Login</title>
 </head>
 <body>
 	<?php 
 		if(isset($error)){
 			echo $error;
 		}
 	 ?>
	<form action="login.php" method="post">
		<table>
			<tr>
				<td>Username: </td>
				<td><input type="text" name="username" size="20" maxlength="20" value="<?php echo $username; ?>"></td>
			</tr>
			<tr>
				<td>Password: </td>
				<td><input type="password" name="password" size="20" maxlength="20" value="<?php echo $password; ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="hidden" name="redirect" value="<?php echo $redirect; ?>">
					<input type="submit" name="submit" value="login">
				</td>
			</tr>
		</table>
	</form>

 </body>
 </html>