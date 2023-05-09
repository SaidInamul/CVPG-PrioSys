<?php
	include_once("header3.php");
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
				<div class="back backProject">
					<img src="Illustration/Icon/Static/back.svg">
					<p class="caption" id="backToProject" style="color: rgba(35, 107, 246, 1);">Project</p>
				</div>
				<div class="searchBar2 searchDiv">
					<img src="Illustration/Icon/Static/searchIcon.svg" class="icon">
					<input type="text" placeholder="Search requirement here..." id="searchRequirement" class="searchInputField">
					<img src="Illustration/Icon/Static/cancel.svg" class="icon search" id="cancelSearch2">
				</div>
				<div class="loading">
				</div>

			</div>
			<p class="heading caption">Project: <span id="projectName"></span></p>
			<p class="caption">For this project, your are one of the <b>stakeholders (SK).</b> SK can view list of requirements of the project.</p>
		</div>
		<div class="content">
			<p class="caption" id="noRequirement" style="text-align: center;">No requirement yet. Your <b>project manager (PM)</b> will list out the project's requirements later...</p>
		</div>
		<div class="requirement">
			<table>
		        <tr>
		        	<thead>
			            <th width="10%">No</th>
			            <th width="15%">RID</th>
			            <th width="50%">Requirement name</th>
			            <th width="20%">Date updated</th>
			        </thead>
		        </tr>
		        <tbody class="rData">
		        </tbody>
	        </table>
		</div>
		<div class="empty">
			<p class="caption" id="noRequirementSearch" style="text-align: center;">No requirement found...</p>
		</div>
	</div>
	
</body>
</html>