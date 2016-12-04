<?php 
	session_start();

	// filter before values
	$username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
	$password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
	$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'main.php';

	if(isset($_POST['submit'])){
		if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1){
			if(!empty($_POST['username']) && $_POST['username'] == 'kawsar.diu' && !empty($_POST['password']) && $_POST['password'] == '12345'){

				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;
				$_SESSION['logged'] = 1;
				header('Refresh : 5; URL = ' . $redirect);
				echo '<p>You will be redirect your original page requested.</p>';
				echo '<p>If your browser doesn\'t redirect you properly autometically <a href = "' . $redirect . '"> Click here </a></p>';
				die(); 
			} else {
				// Set this explicitly just to make sure
				$_SESSION['username'] = '';
				$_SESSION['logged'] = 0;

				$error = '<p><strong> You have supplied invalid username and/or password!</strong> Please <a href="register.php"> Click here</a> if you have not done so already</p>';
			}
		}
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