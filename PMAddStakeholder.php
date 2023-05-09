<?php
	include_once("header2.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="library/css/main.css">
	<title>Stakeholders</title>
</head>
<body>

	<dialog class="modalFeedback" id="addedStakeholder">
		<img src="Illustration/Icon/Static/inviteUser.png" width="60px" height="60px" class="image2">
		<p class="titleModal2">The stakeholder has been added</p>
		<p class="captionModal2">The stakeholder below is successfully added into the project.</p>
		<div class="modalContent4">
			<p class="naming3">From:</p>
			<p class="data3" id="emailStakeholder">Ali@gmail.com</p>
			<p class="naming3">Company name:</p>
			<p class="data3" id="companyStakeholder">ABC Technology SDN BHD</p>
		</div>
		<hr class="line5">
		<div class="modalFoot4">
			<button class="btnBlue blurBtn" id="check" style="height: 34px; grid-column: 1 / 3;">Done</button>
		</div>
		
	</dialog>

	<div class="container">
		<div class="subheader">
			<div class="subheaderHead">
				<div class="back backStakeholder">
					<img src="Illustration/Icon/Static/back.svg">
					<p class="caption" id="backToStakeholder" style="color: rgba(35, 107, 246, 1);">Stakeholder</p>
				</div>
				<div class="searchBar4 searchDiv">
					<img src="Illustration/Icon/Static/searchIcon.svg" class="icon">
					<input type="text" placeholder="Search stakeholder first name, last name, email..." id="searchStakeholder2" class="searchInputField">
					<img src="Illustration/Icon/Static/cancel.svg" class="icon search" id="cancelSearch4">
				</div>
				<div class="loading">
				</div>

			</div>
			<p class="heading caption">Invite Stakeholder</p>
			<p class="caption">Invite stakeholders by searching their <b>name, email</b> or <b>company name.</b></p>
		</div>
		<div class="content">
			<p class="caption" id="noStakeholderAdd" style="text-align: center;">Type something in the searchbar above...</p>
		</div>
		<div class="stakeholderResult">
			<table>
		        <tr>
		        	<thead>
			            <th width="10%">No</th>
			            <th width="60%">Stakeholder</th>
			            <th width="30%">Action</th>
			        </thead>
		        </tr>
		        <tbody class="sDataAdd">
		        </tbody>
	        </table>
		</div>
		<div class="empty">
			<p class="caption" id="noStakeholderResult2" style="text-align: center;">No stakeholder found. Please try enter other names...</p>
		</div>
	</div>
	
</body>
</html>