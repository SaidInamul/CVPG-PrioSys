<?php
require "includes/connection.php";

if(isset($_GET['action'])) {
	if($_GET['action'] == "user") {
		stackAvatar();
	}
}

function stackAvatar() {
	global $con;

	$query = "SELECT first_name, backgroundColor FROM user;";

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0) {
		$numUser = mysqli_num_rows($result);?>
		<div class="avatarHidden">
			<div class="hiddenAvatar">
				<p><?php echo "+" .$numUser; ?></p> 
			</div>
		</div>
		<div class="avatars">

		<?php
		while ($row = mysqli_fetch_assoc($result)) { 

			$firstChar = substr($row['first_name'],0,1);
			?>

			<div class="avatar" style="background-image: <?php echo $row['backgroundColor']; ?>">
				<p><?php echo $firstChar; ?></p>
			</div>


		<?php
		}

		?>

		</div>

		<?php
		
	}

	else {
		echo "Patta head shot";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" href="library/css/main.css"> -->

	<script type="text/javascript" src="library/js/jquery-3.6.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="library/css/font.css">
	<title>Stakeholders</title>

	<style type="text/css">
		* {
			box-sizing: border-box;
			padding: 0;
			margin: 0;
		}

		body {
			font-size: 25px;
			font-family: Rubik;
		    font-style: normal;
		    font-weight: 500;

			background-color: #E2E2E2;

			height: 500px;

			display: grid;
			grid-template-columns: 1fr;
			grid-template-rows: 1fr;

			justify-content: center;
			align-items: center;
		}

		.container {
			grid-column: 1 / 2;
			grid-row: 1 / 2;

			/*width: 500px;
			height: 500px;*/

			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 20px;
		}

		.avatarHidden {
			grid-row: 1 / 2;
			grid-column: 1 / 2;
			justify-self: end;
			align-self: center;
		}

		.avatars {
			grid-column: 2 / 3;
			grid-row: 1 / 2;

			justify-self: start;
			align-self: center;
		  display: inline-flex;
		  flex-direction: row-reverse;
		}

		.avatar {
			position: relative;
			/*border: 4px solid #fff;*/
			overflow: hidden;

			width: 55px;
			height: 55px;

			border-radius: 100%;

			display: flex;
			justify-content: center;
			align-items: center;

/*			background-image: linear-gradient(#BDC3C7,#2C3E50);*/

			text-align: center;
			color: white;
			font-size: 30px;
		}

		.hiddenAvatar {
			width: 55px;
			height: 55px;

			border-radius: 100%;

			display: flex;
			justify-content: center;
			align-items: center;
			text-align: center;

			background-color: rgb(179, 179, 179);
			color: white;
			font-weight: 400;

			transition: transform 0.3s ease;
		}

		.avatar:not(:last-child) {
			margin-left: -12px;
		}
	</style>


</head>
<body>
	<div class="container">
		<p></p>
	</div>
	
</body>

<script type="text/javascript">
	$(document).ready(function(){
		// alert("Hello world");

		$.ajax({
	        type:'GET',
	        data:{
	            action:'user',
	        },
	        url:'testStackAvatar.php',
	        success:function(data) {
	        	$(".container").html(data);
	        	// console.log(data);      	
	        }
	    });

	});
</script>

</html>