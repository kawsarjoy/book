<?php 
	// cookies expire some time in the past
	
	$expire = time() -1000;
	setcookie('username', NULL, $expire);
	setcookie('remember_me', NULL, $expire);

	header('Refresh : 5; URL=cookies_test.php');
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Cookies test (DELETE)</title>
 </head>
 <body>
 	<h1>Deleting Cookies</h1>

 	<p>You will be redirected to the main test page in 5 seconds.</p>
 	<p>If your browser doesn't redirect you automatically <a href="cookies_test.php">Click Here</a></p>

 </body>
 </html>