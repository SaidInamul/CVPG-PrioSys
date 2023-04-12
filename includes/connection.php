<?php
	
	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$dbname = "cvpg";

	$con = mysqli_connect($serverName, $userName, $password, $dbname);

	if (mysqli_connect_errno()) {
		echo "Failed to connect!";
		exit();
	}

?>