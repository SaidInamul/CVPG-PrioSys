<?php
	require 'includes/connection.php';
	session_start();

	if(!$_SESSION['id']) {
	header('location:login.html');	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="library/css/font.css">
	<link rel="icon" type="image/x-icon" href="Illustration/Icon/Static/logo6.png">
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

/*			margin-top: 50px;*/

			display: grid;
			align-items: center;
			justify-content: center;
			grid-template-columns: repeat(4,1fr);
			grid-template-rows: 51px 55px;
			column-gap: 90px;

			margin-left: 25px;

			
			max-height: 51px;
		}

		#logo {
			grid-column: 1 / 2;
			text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);

		}

		#linkRequirement {

			grid-column: 2 / 3;
			grid-row:  1 / 2;

		}

		.subLinkRequirement {
			grid-column: 2 / 4;
			grid-row: 2 / 3;

			z-index: 4;
		}

		.dropdownRequirement {
			
			margin-top: 24px;

			max-width: 145px;
			min-height: 25px;

			background-color: rgba(255, 255, 255, 0.8);

			font-size: 15px;
			font-weight: 400;
			color: rgba(0, 0, 0, 0.6);

			padding: 5px;

			box-shadow: 0px 5px 15px 2px rgba(0, 0, 0, 0.15);
			border-radius: 7px;


			display: none;

			
		}

		.linkStakeholders {
			grid-column: 3 / 4;
			grid-row: 1 / 2;

			text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);

		}

		.linkProjectDetails {
			grid-column: 4 / 5;
			grid-row: 1 / 2;

			text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);

		}

		.dropdownRequirement li {
			padding: 3px 5px;
			border-radius: 4px;
			cursor: pointer;
		}

		.dropdownRequirement li:hover { 
			color: white;
			background-image: linear-gradient(rgba(75, 145, 247, 1),rgba(54, 125, 246, 1));
		}

		.profile {
			display: grid;
			grid-template-columns: 1fr;

			width: 150px;
			max-height: 51px;

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

		a, #linkRequirement {
			color: rgba(255, 255, 255, 0.9);

			cursor: pointer;

			text-decoration: none;

			text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
		}

		a:hover, #linkRequirement:hover {
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

<body>
	<div class="header">
		<div class="link-right">
			<a href="home.php" id="logo">CVPG - PrioSys</a>
			<p id="linkRequirement">Requirements</p>
			<div class="subLinkRequirement">
				<div class="dropdownRequirement">
					<ul class="menu">
						<li id="requirementPage">Requirements...</li>
						<li id="votingPage">Voting...</li>
					</ul>
				</div>
				
			</div>
			<a href="#" id="linkStakeholders">Stakeholders</a>
			<a href="#" id="linkProjectDetails">Project details</a>
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