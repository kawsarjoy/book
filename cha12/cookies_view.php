<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cookies test (View)</title>
</head>
<body>
	<h1>These cookies are set</h1>

	<?php 
		if (!empty($_COOKIE)) {
			echo '<pre>';
			print_r($_COOKIE);
			echo '</pre>';
		} else {
			echo 'No cookies are set.';
		}
	 ?>
	 <p><a href="cookies_test.php">Back to the main test page</a></p>
</body>
</html>