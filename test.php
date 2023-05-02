<?php

require "includes/connection.php";

	global $con;
	// $idu = $_SESSION['id'];

	$query = "SELECT COUNT(idu) FROM group_project WHERE idu = 3;";

	// echo "hello world";

	$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0) {
			while($data = mysqli_fetch_array($result)) {
				if ($data['0'] == 0) {
					echo 0;
				}

				else {
					echo $data[0];
				}
			}
		}

		else {
			echo -1;
		}
?>