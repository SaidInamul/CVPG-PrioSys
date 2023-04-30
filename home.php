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

	<dialog class="modalAddProject" id="modal">
		<div class="modalHead item2">
			<p>Add project</p>
		</div>
		<div class="modalContent item2">
			<div class="items">
				<img src="Illustration/Icon/Static/project.png" width="61px" height="61px" id="picture">
				<p class="naming">Title<span style="color: #F62323;">*</span> :</p>
				<input type="text" class="enterData" id="title" placeholder="Title project..." style="width: 204px;">
				<p class="naming">Developers :</p>
				<input type="text" class="enterData" id="developer" placeholder="Developer company..." style="width: 204px;">
				<p class="naming">Project status :</p>
				<input type="text" class="enterData" id="pStatus" value="Modifying" disabled style="width: 125px;">
				<p class="naming">Project start :</p>
				<input type="date" class="enterData" id="projectStart" placeholder="Pick date..." style="width: 125px;">
				<p class="naming">Project description :</p>
				<textarea placeholder="Tell us about your project..." rows="4" id="projectDesc"></textarea>
			</div>
		</div>
		<div class="modalFoot item2">
			<div class="items2">
				<button id="close" class="btnGrey">Cancel</button>
				<button id="save" class="btnBlue">Save</button>
			</div>
		</div>
	</dialog>

	<div class="container">
		<div class="subheader">
			<div class="subheaderHead">
				<p class="caption" id="tProject">Total project: <span id="totalProject">12</span></p>
				<div class="searchBar">
					<img src="Illustration/Icon/Static/searchIcon.svg" class="icon" id="searchProject">
					<input type="text" placeholder="Search project here..." id="search">
					<img src="Illustration/Icon/Static/cancel.svg" class="icon" id="cancelSearch">
				</div>
				<div class="loading">
				</div>
				<button class="btnGrey" id="addProject">Add project...</button>

			</div>
			<p class="heading caption">Project</p>
			<p class="caption">This page shows your list of projects with their status. You able to add and delete project. To start your project, you can click on one of your project below. If you can’t find your project, you can search your project at the search bar above.</p>
		</div>
		<div class="content">
			<p class="caption" id="noProject" style="text-align: center;">No project involve. Create your first project <span class="link" id="addProject2">here...</span></p>
			
		</div>
		<div class="empty">
			<p class="caption" id="noProjectSearch" style="text-align: center;">No project involve. Create your project <span class="link" id="addProject3">here...</span></p>
		</div>
	</div>
	
</body>
</html>