<?php 
	require 'db.inc.php';

	$db = mysqli_connect(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD) or die ('Unable to connect, Please check your connection parameter.');

	mysqli_select_db($db, MYSQLI_DB) or die (mysqli_error($db));

	// create the user table 

	$query = 'CREATE TABLE IF NOT EXISTS site_user (
			  user_id INTEGER NOT NULL AUTO_INCREMENT,
			  username VARCHAR(20) NOT NULL,
			  password CHAR(41) NOT NULL,

			  PRIMARY KEY (user_id)
			)
			ENGINE = MyISAM';
	mysqli_query($db, $query) or die (mysqli_error($db));

	// create user information table

	$query = 'CREATE TABLE IF NOT EXISTS site_user_info (
			  user_id INTEGER NOT NULL,
			  first_name VARCHAR(20) NOT NULL,
			  last_name VARCHAR(20) NOT NULL,
			  email VARCHAR(50) NOT NULL,
			  city VARCHAR(20),
			  state VARCHAR(2),
			  hobbies VARCHAR(255),

			  FOREIGN KEY (user_id) REFERENCES site_user(user_id)
			  )
			  ENGINE MyISAM';
	mysqli_query($db, $query) or die (mysqli_error($db));

	// populate the user table 

	$query = 'INSERT IGNORE INTO site_user (user_id, username, password) VALUES 
			  (1, "admin", PASSWORD("admin")),
			  (2, "user", PASSWORD("user"))';
	mysqli_query($db, $query) or die (mysqli_error($db));

	// populate the user information table 

	$query = 'INSERT INTO site_user_info (user_id, first_name, last_name, email, city, state, hobbies) VALUES (1, "SUPER", "ADMIN", "admin@gmail.com", NULL, NULL, NULL), (2, "SUPER", "user", "user@gmail.com", NULL, NULL, NULL)';
	mysqli_query($db, $query) or die (mysqli_error($db));

	echo 'Success';
 ?>