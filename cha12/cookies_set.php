<?php 
	// Cookies may expire 30 days from now ( given fron now )
	
	$expire = time() + (60 * 60 * 24 * 30);

	setcookie('username', 'test_user', $expire);
	setcookie('remember_me', 'yes', $expire);

	header('Refresh: 5; URl=cookies_test.php');

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Cookies Test (set)</title>
 </head>
 <body>
 	<h1>Setting cookies</h1>
 	<p>You will be redirected to the main test page in 5 seconds.</p>
 	<p>If your browser doesm't redirect you automatically <a href="cookies_test.php">Click here</a></p>
 	
 </body>
 </html>