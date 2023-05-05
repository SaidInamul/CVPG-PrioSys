<?php
	include_once("header2.php");
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

	<dialog class="modalManage2" id="modalEditRequirement">
		<div class="modalContent2">
			<p class="naming2" style="grid-column: 1/2; grid-row: 1/2;">RID<span style="color: #F62323;">*</span> :</p>
			<input type="text" class="enterData2" id="rid" placeholder="Enter requirement ID..." style="grid-column: 2/3; grid-row: 1/2;">
			<p class="naming2" style="grid-column: 1/2; grid-row: 2/3;">Requirement name<span style="color: #F62323;">*</span> :</p>
			<input type="text" class="enterData2" id="rName" placeholder="Enter requirement name..." style="grid-column: 2/3; grid-row: 2/3;">
		</div>
		<hr class="line2">
		<div class="modalFoot2">
			<button id="deleteRequirement" class="btnSecondary red">Discard this requirement...</button>
			<div class="loading" style="grid-column: 2 / 3; margin-right: 25px; justify-self: end;">
				</div>
			<button id="close2" class="btnGrey">Cancel</button>
			<button id="save2" class="btnBlue">Save</button>
		</div>
	</dialog>

	<dialog class="modalManage2" id="modalAddRequirement">
		<div class="modalContent2">
			<p class="naming2" style="grid-column: 1/2; grid-row: 1/2;">RID<span style="color: #F62323;">*</span> :</p>
			<input type="text" class="enterData2" id="rid" placeholder="Enter requirement ID..." style="grid-column: 2/3; grid-row: 1/2;">
			<p class="naming2" style="grid-column: 1/2; grid-row: 2/3;">Requirement name<span style="color: #F62323;">*</span> :</p>
			<input type="text" class="enterData2" id="rName" placeholder="Enter requirement name..." style="grid-column: 2/3; grid-row: 2/3;">
		</div>
		<hr class="line2">
		<div class="modalFoot2">
			<div class="loading" style="grid-column: 2 / 3; margin-right: 25px; justify-self: end;">
				</div>
			<button id="close2" class="btnGrey">Cancel</button>
			<button id="save2" class="btnBlue">Save</button>
		</div>
	</dialog>

	<div class="container">
		<div class="subheader">
			<div class="subheaderHead">
				<div class="back">
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
				<button class="btnGrey" id="addRequirement">Add requirement...</button>

			</div>
			<p class="heading caption">Project: <span id="projectName"></span></p>
			<p class="caption">For this project, you are the <b>Project Manager (PM).</b> PM can make modification on the requirements of the project. If there is no requirement yet, then PM can add one.</p>
		</div>
		<div class="content">
			<p class="caption" id="noRequirement" style="text-align: center;">No requirement yet. List out your project's requirements <span class="link" id="addRequirement2">here...</span></p>
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
			<p class="caption" id="noRequirementSearch" style="text-align: center;">No requirement found. List out your project's requirements <span class="link" id="addRequirement3">here...</span></p>
		</div>
	</div>
	
</body>
</html>