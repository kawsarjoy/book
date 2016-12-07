<?php 
	require_once('db.inc.php');
	require_once('cms_http_functions.inc.php');

	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD) or die ('Unable to connect, Please check your connection parameters.');
	mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

	if(isset($_REQUEST['action'])){
		switch ($_REQUEST['action']) {
			case 'Login':
				$email = (isset($_POST['email']) ? $_POST['email'] : '');
				$password = (isset($_POST['password']) ? $_POST['password'] : '');

				$sql = 'SELECT user_id, access_level, name FROM cms_users WHERE email = "' . mysqli_real_escape_string($db, $email) . '"AND password=PASSWORD("' . mysqli_real_escape_string($db, $password) . '")';
				$result = mysqli_query($db, $sql) or die (mysqli_error($db));

				if(mysqli_num_rows($result) > 0){
					$row = mysqli_fetch_array($result);
					extract($row);
					$_SESSION['user_id'] = $user_id;
					$_SESSION['name'] = $name;
					$_SESSION['access_level'] = $access_level;
				}
				mysqli_free_result($result);
				redirect('cms_index.php');
				break;

			case 'Logout':
				session_start();
				session_unset();
				session_destroy();
				redirect('cms_index.php');
				break;

			case 'Create Account':
				$name = (isset($_POST['name']) ? $_POST['name']) : '';
				$email = (isset($_POST['email']) ? $_POST['email']) : '';
				$password_1 = (isset($_POST['password_1']) ? $_POST['password_1']) : '';
				$password_2 = (isset($_POST['password_2']) ? $_POST['password_2']) : '';
				$password = ($password_1 == $password_2) ? $password_1 : '';

				if(!empty($name) && !empty($email) && !empty($password)){
					$sql = 'INSERT INTO cms_users (email, password, name) VALUES '
				}
				break;
			
			default:
				# code...
				break;
		}
	}
 ?>