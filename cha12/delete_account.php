<?php 
	include 'auth.inc.php';
	include 'db.inc.php';

	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_HOST) or die ('Unable connect, Please check your connection parameters.');
	mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

	if(isset($_POST['submit']) && $_POST['submit'] == 'Yes'){
		$query = 'DELETE i FROM site_user u JOIN site_user_info i ON u.user_id = i.site_user_info WHERE username = "' . mysqli_real_escape_string($_SESSION['username'], $db) . '"';
		mysqli_query($db, $query) or die (mysqli_error($db));

		$query = 'DELETE FROM site_user WHERE username="' . mysqli_real_escape_string($_SESSION['username'], $db) . '"';
		mysqli_query($db, $query) or die (mysqli_error($db));

		$_SESSION['logged'] = null;
		$_SESSION['username'] = null;
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Delete Account</title>
 </head>
 <body>
 	<p><strong>Your account has been deleted!</strong></p>
 	<p><a href="main.php">Click here</a> to return to the home page.</p>
 </body>
 </html>
 <?php 
 	mysqli_close($db);
 	die();
 } else {
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Delete Account</title>
	<script type="text/javascript">
		window.load = function(){
			document.getElementById('cancle').onclick = goBack;
		}
		function foBlack(){
			history.go(-1);
		}
	</script>
</head>
<body>
	<p>Are you sure you want to delete your account?</p>
	<p><strong>There is no way to retrieve your account once you confirm!</strong></p>
	<form action="delete_account.php" method="post">
		<div>
			<input type="submit" name="submit" value="Yes">
			<input type="button" id="cancel" value=" No " onclick="history.go(-1);">
		</div>
	</form>
</body>
</html>
<?php 
	?
 ?>