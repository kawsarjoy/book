<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Character Database</title>
	<style type="text/css">
		th { background-color: #999; }
		td { vertical-align: top; }
		.odd_row { background-color: #eee; }
		.even_row { background-color: #eee; }
	</style>
</head>
<body>
	<img src="images/logo.jpg" alt="Comic book appreciation site" style="float: left;">
	<h1>Comic Book<br/> Appriciation</h1>
	<h2>Character Database</h2>
	<hr style="clear:both"; />
	<?php 
		require 'db.inc.php';
		$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD) or die ('Unable to connect. Check your connection parameters.');
		mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

		// determine order array 
		$order = array(1 => 'alias ASC',
					   2 => 'real_name ASC',
					   3 => 'alignment ASC, alias ASC');
		$o = (isset($_GET['o']) && ctype_digit($_GET['o'])) ? $_GET['o'] : 1;
		if(!in_array($o, array_keys($order))){
			$o = 1;
		}

		// select list of character for table
		$query = 'SELECT character_id, real_name, alias, alignment FROM comic_character ORDER BY ' . $order[$o];
		$result = mysqli_query($db, $query) or die (mysqli_error($db));

		if(mysqli_num_rows($result) > 0){
			echo '<table>';
			echo '<tr><th><a href="' . $_SERVER['PHP_SELF'] . '?o=1">Alias</a></th>';
			echo '<th><a href="' . $_SERVER['PHP_SELF'] . '?o=2">Real Name</a></th>';
			echo '<th><a href="' . $_SERVER['PHP_SELF'] . '?o=3">Alignment</a></th>';
			echo '<th>Powers</th>';
			echo '<th>Enemies</th></tr>';

			$odd = true;

			while($row = mysqli_fetch_assoc($result)){
				echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
				$odd = !$odd;
				echo '<td><a href="edit_character.php?id=' . $row['character_id'] . '">' . $row['alias'] . '</a></td>';
				echo '<td>' . $row['real_name'] . '</td>';
				echo '<td>' . $row['alignment'] . '</td>';

				// select list of powers of this character
				
				$query2 = 'SELECT power FROM comic_power p JOIN comic_character_power cp ON p.power_id = cp.power_id WHERE cp.character_id = ' . $row['character_id'] . ' ORDER BY power ASC';
				$result2 = mysqli_query($db, $query2) or die (mysqli_error($db));
				if(mysqli_num_rows($result2) > 0){
					$powers = [];
					while($row2 = mysqli_fetch_assoc($result2)){
						$powers[] = $row2['power'];
						echo '<td>' . implode(',', $powers) . '</td>';
					}
				} else {
					echo '<td>none</td>';
				}
				mysqli_free_result($result2);
				// select list riverlies for this character
				$query2 = 'SELECT c2.alias FROM comic_character c1 JOIN comic_character c2 JOIN comic_rivalry r ON (c1.character_id = r.hero_id AND
										 c2.character_id = r.villain_id) OR
										(c1.character_id = r.villain_id AND 
										 c2.character_id = r.hero_id) WHERE c1.character_id = ' . $row['character_id'] . 'ORDER BY c2.alias ASC';
				$result2 = mysqli_query($db, $query2) or die (mysqli_error($db));
				if(mysqli_num_rows($result2) > 0){
					$aliases = [];
					while($row2 = mysqli_fetch_assoc($result2)){
						$aliases [] = $row2['alias'];
						echo '<td>' . implode(',', $aliases) . '</td>';
					}
				} else {
					echo '<td>none</td>';
				}
				mysqli_free_result($result2);
				echo '</tr>';
			}
			echo '</table>';
		} else {
			echo '<p><strong>No character entered !!!</strong></p>';
		}
	 ?>
	 <p><a href="edit_character.php">Add New Character</a></p>
	 <p><a href="edit_power.php">Edit Powers</a></p>
</body>
</html>