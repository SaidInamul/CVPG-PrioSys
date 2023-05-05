<?php

require "includes/connection.php";

	global $con;
	// $idu = $_SESSION['id'];

		$query = "SELECT idr FROM requirement WHERE idp = 1 AND idr NOT IN (SELECT idr FROM voted_requirement WHERE idp = 1) LIMIT 1;";

    	$result = mysqli_query($con,$query);

    	if(mysqli_num_rows($result) > 0) {
    		$row = mysqli_fetch_assoc($result);
    		echo $rID = $row['idr']; 
    		
    	}
?>