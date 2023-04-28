<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="library/css/font.css">
	<script type="text/javascript" src="library/js/jquery-3.6.3.min.js"></script>
	<script type="text/javascript" src="library/js/ajaxScript.js"></script>

	<style type="text/css">

		* {
			box-sizing: border-box;
			padding: 0;
			margin: 0;
		}

		body {
			font-size: 20px;
			font-family: Rubik;
		    font-style: normal;
		    font-weight: 400;

			background-color: #E2E2E2;

			display: grid;
			grid-template-columns: 1fr;
		}

		.header {

			grid-column: 1 / 2;
			grid-row: 1 / 2;

			background-color: #414141;

			display: flex;
			height: 62px;
			align-items: center;
			justify-content: space-between;

			
  			
  			text-decoration: none;
		}

		.link-right {
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 90px;

			margin-left: 25px;

			text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
		}

		.profile {
/*			margin-top: 125px;*/
			display: grid;
			grid-template-columns: 1fr;

			width: 150px;
			max-height: 51px;;

			gap: 10px;

			align-items: center;
			justify-content: center;
		}

		.buttonProfile {

			grid-column: 1 / 2;
			grid-row: 1 / 2;

			display: grid;
			grid-template-columns: 50px 1fr;
			gap: 5px;

			width: 150px;
			height: 51px;
			border-radius: 25px;

			background-color: rgba(255, 255, 255, 0.8);

			margin-right: 25px;

			text-shadow: 0px 0px 0px rgba(0, 0, 0, 0);

			box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
		}

		.buttonProfile:hover {
			background-color: rgba(255, 255, 255, 1);

			cursor: pointer;
		}

		.buttonProfile:active {
			outline-color: rgba(58, 108, 217, 0.5);
			outline-style: solid;
			outline-width: 5.5px;
		}

		.picture {
			width: 36px;
			height: 36px;

			grid-column: 1 / 2;
			justify-self: center;
			align-self: center;

			border-radius: 100%;

			display: flex;
			justify-content: center;
			align-items: center;

			background-color: grey;

			text-align: center;
			color: white;
		}

		.username {
			grid-column: 2 / 3;
			justify-self: start;

			display: flex;
			flex-direction: column;
			gap: 1px;


			justify-content: center;
			align-items: center;
		}

		.email {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;

			width: 75px;
		}

		a {
			color: rgba(255, 255, 255, 0.9);

			cursor: pointer;

			text-decoration: none;
		}

		a:hover {
			color: white;
		}

		.dropdownProfile {

			grid-column: 1 / 2;
			grid-row: 2 / 3;


			width: 155px;
			height: 115px;

			background-color: rgba(255, 255, 255, 0.8);

			font-size: 15px;
			font-weight: 400;
			color: rgba(0, 0, 0, 0.6);

			padding: 0.2em 0.5em;

			box-shadow: 0px 5px 15px 2px rgba(0, 0, 0, 0.15);
			border-radius: 7px;

			display: none;

/*			visibility: hidden;*/

			z-index: 4;
		}

		.menu {
			list-style: none;

		}

		.dropdownProfile li:not(:first-child) {
			padding: 3px 7px;
			border-radius: 4px;
			cursor: pointer;
		}

		.dropdownProfile li:not(:first-child):hover { 
			color: white;
			background-image: linear-gradient(rgba(75, 145, 247, 1),rgba(54, 125, 246, 1));
		}

		#logout:hover {
			color: white;
		} 

		#email {
			padding: 3px 7px;

			margin-bottom: 7px;

			font-weight: 500;

			text-decoration: underline;
  			text-underline-offset: 9px;
		}
	</style>

</head>
<?php
	require 'includes/connection.php';
	session_start();

	if(!$_SESSION['id']) {
	header('location:login.html');	
}

?>
<body>
	<div class="header">
		<div class="link-right">
			<a href="home.php">CVPG - PrioSys</a>
			<a href="home.php" id="linkProject">Project</a>
			<a href="#" id="linkNotification">Notification</a>
			<a href="#" id="linkSetting">Setting</a>
		</div>
		<div class="profile">
			<div class="buttonProfile">
				<div class="picture">
					<p class="fChar" style="font-weight: 600; font-size:16px"></p>
				</div>
				<div class="username">
					<p class="name" style="font-weight: 500; font-size: 18px;"></p>
					<p class="email" style="font-weight: 300; font-size: 13px;"></p>
				</div>
			</div>
			<div class="dropdownProfile">
				<ul class="menu">
					<li id="email"></li>
					<li id="profile">Profile...</li>
					<li id="acctSetting">Account Setting...</li>
					<li id="logout">Log out...</li>
				</ul>
			</div>
		</div>
	</div>
	
</body>
</html>