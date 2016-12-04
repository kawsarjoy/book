<?php 

	$to = 'kawsarjoydiu@gmail.com';
	$subject = 'Hello world';
	$message = 'Hi, world, Prepare for out arival , we are striving';
	
		if(mail($to, $subject, $message)){
		echo 'Mail sent successfully';
	} else {
		die('Feiliue: mail was not sent!!!');
	}
	
 ?>