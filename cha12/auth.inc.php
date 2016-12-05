<?php 
	session_start();

	if(!isset($_SESSION['logged'])){
		header('Refresh : 5; URL = login.php?redirect=' . $_SERVER['PHP_SELF']);
		echo '<p>You will be redirect to login page in 5 second.</p>';
		echo '<p>If your page doesn\'t rediect properly atuomaticaly, <a href = "login.php?redirect=' . $_SERVER['PHP_SELF'] . '">Click here</a></p>';
		die();
	}
 ?>