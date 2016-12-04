<?php 
	require 'db.inc.php';
	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD) or die ('Unable to connect, Please check your connection parameters.');
	mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

	$action = 'Add';

	$character = array( 'alias' => '',
						'real_name' => '',
						'alignment' => 'good',
						'address' => '',
						'city' => '',
						//'state' => '',
						'zip_code' => '' );
	$character_poweres = [];
	$rivalries = [];

	// validate incoming character id values
	$character_id = isset($_GET['id'] && ctype_digit($_GET['id'])) ? $_GET['id'] :0;

	// retrive information about requested character id

	if($character_id != 0){
		$query = 'SELECT c.alias, c.real_name, c.alignment, l.address, z.zipcode_id, z.state, z.city FROM comic_chatacter c , comic_lair l, comic_zipcode z WHERE c.lair_id = l.lair_id AND l.zip_code = z.zipcode_id AND c.character_id = ' . $character_id;
		$result = mysqli_query($db, $query) or die (mysqli_error($db));

		if(mysqli_num_rows($result) > 0){
			$action = 'Edit';
			$character = mysqli_fetch_assoc($result);
		}
		mysqli_free_result($result);

		if($action = 'Edit'){
			$query = 'SELECT power_id FROM comic_character_power WHERE '
		}
	}
 ?>