<?php
	include_once("header2.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="library/css/main.css">
	<title>Project Details</title>
</head>
<body>

	<dialog class="modalManage" id="modalEditProject">
		<div class="modalHead item2">
			<p class="modalTitle">Add project</p>
			<div class="loading" style="grid-column: 3 / 4; margin-right: 25px; justify-self: end;">
				</div>
		</div>
		<div class="modalContent item2">
			<div class="items">
				<img src="Illustration/Icon/Static/project.png" width="61px" height="61px" id="picture">
				<p class="naming">Title<span style="color: #F62323;">*</span> :</p>
				<input type="text" class="enterData" id="title" placeholder="Title project..." style="width: 204px;">
				<p class="naming">Developers :</p>
				<input type="text" class="enterData" id="developer" placeholder="Developer company..." style="width: 204px;">
				<p class="naming">Project status :</p>
				<input type="text" class="enterData disabledSearch" id="pStatus" value="Modifying" disabled style="width: 125px;">
				<p class="naming">Project start :</p>
				<input type="date" class="enterData" id="projectStart" placeholder="Pick date..." style="width: 135px;">
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

	<dialog class="modalManage2" id="modalUpdateStatusProject">
		<div class="modalContent2">
			<p class="naming2" style="grid-column: 1/2; grid-row: 1/2;">Update project's status :</p>
			<input type="text" class="enterData2" id="projectStatus" style="grid-column: 2/3; grid-row: 1/2; width: 150px;">
			<div class="dropdown">
				<div class="select">
					<span class="selected">Show all</span>
					<img src="DropDownIcon.svg">
				</div>
				<ul class="menu">
					<li id="1">Essential...</li>
					<li id="2">Less - essential...</li>
					<li id="3">Non - essential...</li>
					<li id="4">Show all...</li>
				</ul>
			</div>
		</div>
		<hr class="line2">
		<div class="modalFoot2">
			<div class="loading" style="grid-column: 2 / 3; margin-right: 25px; justify-self: end;">
				</div>
			<button id="close2" class="btnGrey">Cancel</button>
			<button id="save2" class="btnBlue">Save</button>
		</div>
	</dialog>

	<div class="container2">
		<div class="subheader2">
			<div class="subheaderHead2">
				<div class="back backProject">
					<img src="Illustration/Icon/Static/back.svg">
					<p class="caption" id="backToProject" style="color: rgba(35, 107, 246, 1);">Project</p>
				</div>

			</div>
			<div class="subheaderProjectDetails">
				<img src="Illustration/Icon/Static/project.png" width="100px" height="100px" class="logoProject">
				<p class="titleProjectDetail">Ecommerce</p>
				<p class="statusProject">Status: Result</p>
			</div>
		</div>
		<div class="content2">
			<div class="totalRequirements centerContent">
				<p class="naming4">Total</p>
				<p class = "data4" id="totalRequirement">3</p>
				<p class="naming5">Requirements</p>
			</div>
			<div class="totalStakeholders centerContent">
				<p class="naming4">Total</p>
				<p class = "data4" id="totalStakeholder">2</p>
				<p class="naming5">Stakeholders</p>
			</div>
			<div class="statusOfProjects centerContent">
				<p class="naming4">Status</p>
				<p class = "data4" id="statusOfProject">Result</p>
				<p class="naming5">Project</p>
			</div>
			<div class="CompanyPMs centerContent">
				<p class="naming4">Developer</p>
				<img src="Illustration/Icon/Static/apartment.svg" style="justify-self: center;" width="36px" height="36px">
				<p class="naming5" id="CompanyPM">ABC Technology Sdn Bhd</p>
			</div>
		</div>
		<div class="SegmentationProjectDetails">
			<div class="tab">
		        <div class="activeSegment" id="detail">
		          <p>Details</p>
		        </div>
		        <div id="result">
		          <p>Result</p>
		        </div>
		     </div>
		     <div class="detailSegment">
		     	<div class="descriptionProjects">
		     		<p class="head descriptionProject">Description:</p>
		     		<p class="caption2 captionDescription">E-commerce, also known as electronic commerce, is a term that is frequently brought up in conversations pertaining to sales these days. It is simple for businesses that sell products or provide services to enhance their revenue and expand their sales through the use of online commerce. The use of the internet to conduct business is becoming increasingly common everywhere.</p>
		     		<button class="btnGrey" id="updateProjectDetails">Update project details...</button>
		     	</div>
		     	<div class="statusProjects2">
		     		<p class="head statusProject2">Project Status:</p>
		     		<div class="currentStatus">
		     			<p class="caption2 naming6">Project status:</p>
		     			<p class="caption2" id="currentStatusData">Result</p>
		     		</div>
		     		<button class="btnGrey" id="updateStatusProject">Update status...</button>
		     		<div class="help"><img src="Illustration/Icon/Static/help.svg" width="24px" height="24px" class="imgHelp">
		     		</div>
		     	</div>
		     </div>
		     <div class="resultSegment" style="display: none;">Item 2</div>
		</div>
	</div>
	
</body>
<script type="text/javascript">
    $(document).ready(function(){
      // alert("Hello world");

      $('#result').click(function(){
        $(this).addClass('activeSegment');
        $('#detail').removeClass('activeSegment');
        $('.resultSegment').css({
          "display" : "block"
        });
        $('.detailSegment').css({
          "display" : "none"
        });
      });

      $('#detail').click(function(){
        $(this).addClass('activeSegment');
        $('#result').removeClass('activeSegment');
        $('.detailSegment').css({
          "display" : "block"
        });
        $('.resultSegment').css({
          "display" : "none"
        });
      });       

    });
  </script>
</html>