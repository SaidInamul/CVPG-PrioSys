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

	<dialog class="modalView" id="modalViewSK">
		<div class="modalContent3">
			<div class="picture2">
				<p class="fChar2" style="font-weight: 600; font-size:32px"></p>
			</div>
			<p class="name2"><b></b></p>
			<p class="email2"></p>

		</div>
		<hr class="line3">
		<div class="details">
			<p class="naming2">Company name:</p>
			<p class="data" id="companyName"></p>
			<p class="naming2">Email:</p>
			<p class="data" id="emailMember"></p>
			<p class="naming2">Location:</p>
			<p class="data" id="locationMember"></p>
			<p class="naming2">Status vote:</p>
			<p class="data" id="statusVoteMember"></p>
			<p class="naming2">Role:</p>
			<p class="data" id="roleMember"></p>
			<p class="naming2">Status aggrement:</p>
			<p class="data" id="statusAggrementMember"></p>
		</div>
		<hr class="line4">
		<div class="modalFoot3">
			<button id="deleteStakeholder" class="btnSecondary red blurBtn">Discard this stakeholder...</button>
			<button id="close2" class="btnGrey blurBtn" style="height: 26px;">Close</button>
		</div>
	</dialog>

	<dialog class="modalView" id="modalViewPM">
		<div class="modalContent3">
			<div class="picture2">
				<p class="fChar2" style="font-weight: 600; font-size:32px"></p>
			</div>
			<p class="name2"><b></b></p>
			<p class="email2"></p>

		</div>
		<hr class="line3">
		<div class="details">
			<p class="naming2">Company name:</p>
			<p class="data" id="companyName"></p>
			<p class="naming2">Email:</p>
			<p class="data" id="emailMember"></p>
			<p class="naming2">Location:</p>
			<p class="data" id="locationMember"></p>
			<p class="naming2">Status vote:</p>
			<p class="data" id="statusVoteMember"></p>
			<p class="naming2">Role:</p>
			<p class="data" id="roleMember"></p>
			<p class="naming2">Status aggrement:</p>
			<p class="data" id="statusAggrementMember"></p>
		</div>
		<hr class="line4">
		<div class="modalFoot3">
			<button id="close2" class="btnGrey blurBtn">Close</button>
		</div>
	</dialog>

	<dialog class="modalMain" id="modalRemoveStakeholder">
		<img src="Illustration/Icon/Static/removeUser.png" style="width: 60px; height: 60px;" class="image">
		<p class="titleModal">Discard stakeholder ?</p>
		<p class="captionModal">Do you want to delete this stakeholder ? The stakeholder will not be able to access this project anymore.</p>
		<hr class="line">
		<div class="buttons">
			<button class="close btnGrey btnModal" id="closeModalMain" style="width: 136px;">No, keep them</button>
			<button class="delete btnRed btnModal" id="deleteProject" style="width: 165px;">Yes, discard them</button>
		</div>
	</dialog>

	<div class="container">
		<div class="subheader">
			<div class="subheaderHead">
				<div class="back backProject">
					<img src="Illustration/Icon/Static/back.svg">
					<p class="caption" id="backToProject" style="color: rgba(35, 107, 246, 1);">Project</p>
				</div>
				<div class="searchBar3 searchDiv">
					<img src="Illustration/Icon/Static/searchIcon.svg" class="icon">
					<input type="text" placeholder="Search stakeholder first name, last name, email..." id="searchStakeholder" class="searchInputField">
					<img src="Illustration/Icon/Static/cancel.svg" class="icon search" id="cancelSearch3">
				</div>
				<div class="loading">
				</div>
				<button class="btnGrey btnSubHeader" id="addStakeholder">Add stakeholder...</button>

			</div>
			<p class="heading caption">Stakeholders</p>
			<p class="caption">Below are the stakeholders that participate in voting the requirements. <b>Project Manager (PM)</b> able to invite other stakeholders and modify stakeholders’ role inside the project.</p>
		</div>
		<div class="content">
			<p class="caption" id="noStakeholder" style="text-align: center;">No stakeholder yet. Invite your project's stakeholders <span class="link" id="addStakeholder2">here...</span></p>
		</div>
		<div class="stakeholder">
			<table>
		        <tr>
		        	<thead>
			            <th width="10%">No</th>
			            <th width="30%">Stakeholder name</th>
			            <th width="30%">Company</th>
			            <th width="15%">Role</th>
			            <th width="15%">Status vote</th>
			        </thead>
		        </tr>
		        <tbody class="sData">
		        </tbody>
	        </table>
		</div>
		<div class="empty">
			<p class="caption" id="noStakeholderSearch" style="text-align: center;">No stakeholder found. Invite them to the project <span class="link" id="addStakeholder3">here...</span></p>
		</div>
	</div>
	
</body>
</html>