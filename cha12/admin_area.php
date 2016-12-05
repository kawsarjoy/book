<?php 
	include 'auth.inc.php';

	if($_SESSION['admin_level'] < 1){
		header('Refresh:5; URL = user_personal.php');
		echo '<p><strong>You are not authorized for this page</strong></p>';
		echo '<p>You are bieng redirected to the main page. If your browser doesn\'t redirect you automatically, Please <a href="main.php">Click here</a>';
		die();
	}

	include 'db.inc.php';
<<<<<<< HEAD
	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD) or die ('Unable to connect, Please check your connection parameters.');
=======
	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_HOST) or die ('Unable to connect, Please check your connection parameters.');
>>>>>>> origin/master
	mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Administration Area</title>
 	<style type="text/css">
 		th { background-color: #999; }
 		.odd_row { background-color: #EEE; }
 		.even_row { background-color: #FFF; }
 	</style>
 </head>
 <body>
 	<h1>Welcome to the administration area.</h1>
 	<p>Here you can view and manage other users.</p>
 	<p><a href="main.php">Click here</a> return to main page.</p>
 	<table style="width: 70%">
 	<tr><th>Username</th><th>First name</th><th>Last name</th></tr>
 	<?php 
 		$query = 'SELECT u.user_id, username, first_name, last_name FROM site_user u JOIN site_user_info i ON u.user_id = i.user_id ORDER BY username ASC';
 		$result = mysqli_query($db, $query) or die (mysqli_error($db));

 		$odd = true;
 		while ($row = mysqli_fetch_array($result)) {
 			echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row"';
<<<<<<< HEAD
 			$odd != $odd;
=======
 			$odd = !$odd;
>>>>>>> origin/master
 			echo '<td><a href = "update_user.php?id=' . $row['user_id'] . '">' . $row['username']  . '</a></td>';
 			echo '<td>' . $row['first_name'] . '</td>';
 			echo '<td>' . $row['last_name'] . '</td>';
 			echo '</tr>';
 		}
 		mysqli_free_result($result);
 		mysqli_close($db);
 	 ?>
 	 </table>
 </body>
 </html>