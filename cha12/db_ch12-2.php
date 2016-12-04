<?php 
	include 'db.inc.php';

	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD)or die ('Unable to connect, Please check your connection parameters.');
	mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

	// update the user table
	$query = 'ALTER TABLE site_user ADD COLUMN admin_lavel TINYINT UNSIGNED NOT NULL DEFAULT 0 AFTER password';
	mysqli_query($db, $query) or die (mysqli_error($db));

	// give one of our test account administrators previleges
	$query = 'UPDATE site_user SET admin_lavel = 1 WHERE username = "john"';
	mysqli_query($db, $query) or die (mysqli_error($db));

	echo 'Success!';
 ?>