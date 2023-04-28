<?php
	include_once("header.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="library/css/main.css">
	<title>Home</title>
</head>
<body>
	<div class="container">
		<div class="subheader">
			<div class="subheaderHead">
				<p class="caption" id="tProject">Total project: <span id="totalProject">12</span></p>
				<div class="searchBar">
					<img src="Illustration/Icon/Static/searchIcon.svg" class="icon search" width="20px" height="20px">
					<input type="text" placeholder="Search project here..." id="search">
				</div>
				<button class="btnGrey" id="addProject">Add project...</button>

			</div>
			<p class="heading caption">Project</p>
			<p class="caption">This page shows your list of projects with their status. You able to add and delete project. To start your project, you can click on one of your project below. If you can’t find your project, you can search your project at the search bar above.</p>
		</div>
		<div class="content">
			<p class="caption" id="noProject" style="text-align: center;">No project involve. Create your first project <span class="link">here...</span></p>
		</div>
	</div>
	
</body>
</html>