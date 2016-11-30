<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Powers</title>
	<style type="text/css">
		td { vertical-align:  top; }
	</style>
</head>
<body>
	<img src="images/logo.jpg" alt="Comic Book Appreciation" style="float: left;" />
	<h1>Comic Book <br/> Appreciation</h1>
	<h2>Edit character Powers</h2>
	<hr style="clear: both;" />
	<form action="char_transaction.php" method="post">
		<div>
			<input type="text" name="new_power" size="20" maxlength="40" value="" />
			<input type="submit" name="action" value="Add New power">
		</div>
		<?php 
			require 'db.inc.php';
			$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD) or die ('Unable to connect, check your connection parameters.');
			mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));
			$query = 'SELECT power_id, power FROM comic_power ORDER BY power ASC';
			$result = mysqli_query($db, $query);
			if(mysqli_num_rows($result) > 0){
				echo '<p><em>Remove power will remove its association with anu character as well.</em></p>';
				$num_powers = mysqli_num_rows($result);
				$threshold = 1;
				$max_columns = 15;
				$num_columns = min($max_columns, ceil($num_powers / $threshold));
				$count_per_column = ceil($num_powers/ $num_columns);
				$i = 0;
				echo '<table><tr><td>';
				while ($row = mysqli_fetch_assoc($result)) {
					if(($i > 0) && ($i % $count_per_column == 0)){
						echo '</td><td>';
					}
					echo '<input type = "checkbox" name = "powers[]" value = "' . $row['power_id'] . '" />';
					echo $row['power'] . '<br/>';
					$i++;
				}
				echo '</td></tr></table>';
				echo '<br/><input type = "submit" name = "action" value = "Delete Selected Powers" /> ';
			} else {
				echo '<p><strong>No power entered....</strong></p>';
			}
		 ?>
	</form>
</body>
</html>