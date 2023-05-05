<?php	
	require "connection.php";
	
	session_start();

	if(isset($_GET['action'])) {
		if($_GET['action'] == "register") {
			sleep(2);

			if($_GET['fName'] != "" && $_GET['lName'] != "" && $_GET['email'] != "" && $_GET['pass'] != "" && $_GET['pass2'] != "" && $_GET['profileColor'] != "") {
				$fName = $_GET['fName'];
				$lName = $_GET['lName'];
				$email = $_GET['email'];
				$pass = $_GET['pass'];
				$pass2 = $_GET['pass2'];
				$bc = $_GET['profileColor'];
				registerUser($fName,$lName,$email,$pass,$pass2,$bc);
			}

			else 
			{
				$data['response'] = "empty";
				$data['comment'] = "All field must be entered";
				echo json_encode($data);
			}
		}

		else if($_GET['action'] == "login") {
			sleep(2);

			if($_GET['email'] != "" && $_GET['pass'] != "") {
				$email = $_GET['email'];
				$pass = $_GET['pass'];
				loginUser($email,$pass);
			}

			else {
				$data['response'] = "empty";
				$data['comment'] = "All field must be entered";
				echo json_encode($data);
			}
		}

		else if($_GET['action'] == 'user') {
			userProfile();
		}

		else if($_GET['action'] == 'project') {
			fetchProject();
		}

		else if($_GET['action'] == 'getTotalProject') {
			getTotalProject();
		}

		else if($_GET['action'] == 'search') {
			$inputSearch = stripslashes($_GET['inputSearch']);
			$inputSearch = mysqli_real_escape_string($con,$inputSearch);
			sleep(2);
			searchProject($inputSearch);
		}

		else if($_GET['action'] == 'addProject') {

			$title = validateInput($_GET['title']);
			$dev = validateInput($_GET['dev']);
			$date = $_GET['date'];
			$pDesc = validateInput($_GET['pDesc']);

			sleep(2);
			projectAdd($title, $dev, $date, $pDesc);
		}

	}

	else if(isset($_POST['action'])) {
		if($_POST['action'] == "openProject") {
			$pID = $_POST['pID'];
			openProject($pID);
		}

		else if($_POST['action'] == "getProjectName") {
			getProjectName();
		}

		else if($_POST['action'] == "requirement") {
			fetchRequirement();
		}

		else if($_POST['action'] == "addRequirement") {
			$rid = validateInput($_POST['rid']);
			$rName = validateInput($_POST['rName']);
			sleep(2);
			addRequirement($rid,$rName);
		}

		else if($_POST['action'] == "fetchRequirementData") {
			$rID = $_POST['rID'];
			fetchRequirementData($rID);
		}

		else if($_POST['action'] == "editRequirement") {
			$rid = validateInput($_POST['rid']);
			$rName = validateInput($_POST['rName']);
			$rID = $_POST['rID'];
			sleep(2);
			editRequirement($rID,$rid,$rName);
		}

		else if($_POST['action'] == "deleteRequirement") {
			$rID = $_POST['rID'];
			sleep(2);
			deleteRequirement($rID);
		}
	}

	function validateInput ($input) {

		global $con;

		$input = stripslashes($input);
		$input = mysqli_real_escape_string($con,$input);

		return $input;
	}

	function registerUser($fName,$lName,$email,$pass,$pass2,$bc) {
		global $con;

		$validPassword = checkPassword($pass,$pass2);
		$validEmail = checkEmail($email);

		if($validEmail == 0) {
			//Used email..
			$data['responseEmail'] = 1;
			$data['dataEmail'] = "used";
		}

		else if($validEmail == -1) {
			$data['responseEmail'] = 1;
			$data['dataEmail'] = "invalid";
		}

		if($validPassword == 0) {
			$data['responsePassword'] = 1;
			$data['dataPassword'] = "unequel";
		}

		if($validEmail == 1 && $validPassword == 1) {
			$query = "INSERT INTO user (first_name, last_Name, email, password, backgroundColor) VALUES ('$fName','$lName','$email','$pass2', '$bc')";

			$result = mysqli_query($con, $query);

			if($result) {
				$data['response'] = 1;
				echo json_encode($data);
			}
			else {
				$data['response'] = 0;
				echo json_encode($data);
			}
		}

		else {
			echo json_encode($data);
		}
		
	}

	function checkEmail($email) {
		global $con;
		$query = "SELECT email FROM user WHERE email = '$email' LIMIT 1";

		$result = mysqli_query($con,$query);

		if (mysqli_num_rows($result) == 1) {
			return 0;
		}

		elseif (preg_match("/^([a-zA-Z0-9_\.\+\-])+\@(([a-zA-z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/",$email)) {
			return 1;
		}

		else {
			return -1;
		}
	}

	function checkPassword($pass,$pass2) {
		global $con;

		if($pass == $pass2) {
			return 1;
		}

		else {
			return 0;
		}
	}

	function loginUser($email,$pass) {
		global $con;

		$validEmail = checkEmail($email);

		if($validEmail == -1) {
			$data['response'] = -1;

			echo json_encode($data);
		}

		else {
			$query = "SELECT idu, first_name, last_name, email, backgroundColor FROM user WHERE email = '$email' AND password = '$pass' LIMIT 1";
			$result = mysqli_query($con, $query);

			if (mysqli_num_rows($result) == 1) {

				$row = mysqli_fetch_array($result);
				$_SESSION['id'] = $row['idu'];

				$data['response'] = 1;
				echo json_encode($data);

		   }

		   else
		   {
		   		$data['response'] = 0;
		   		echo json_encode($data);
		   }
		}
	}

	function userProfile() {
		global $con;

		$idu = $_SESSION['id'];
		$bc;
		$fName;
		$email;

		$query = "SELECT first_name, email, backgroundColor FROM user WHERE idu = $idu LIMIT 1";

		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) == 1) {
			while($row = mysqli_fetch_row($result)) {
						$bc = $row[2];
						$fName = $row[0];
						$email = $row[1];
			}
		}

		$data['fName'] = $fName;
		$data['bc'] = $bc;
		$data['email'] = $email;
		$data['response'] = 1;

		echo json_encode($data);
	}

	function fetchProject() {
		global $con;
		$idu = $_SESSION['id'];

		$query = "SELECT project.title, project.descp, project.idp FROM project JOIN group_project ON project.idp = group_project.idp WHERE group_project.idu = $idu;";

    	$result = mysqli_query($con, $query);

    	if(mysqli_num_rows($result) > 0) {
    		while ($data = mysqli_fetch_array($result)): ?>

	        <div class="project" data-id="<?php echo $data['2'] ?>">
	            <img src="Illustration/Icon/Static/project.png" class="projectPicture" width="39px" height="39px">
	            <img src="Illustration/Icon/Static/option.svg" class="option" width="22px" height="22px">
	            <div class="menus">
	                <ul class="list">
	                    <li id="titleProject"><?php echo $data['0'] ?></li>
	                    <li id="open">Open...</li>
	                    <li id="delete">Delete...</li>
	                </ul>   
	            </div>
	            <p class="caption title"><?php echo $data['0'] ?></p>
	            <p class="caption desc" id="projectCaption"><?php echo $data['1'] ?></p>
	        </div>

			<?php endwhile;

			require_once 'ajaxFunction.php';
    	}

    	else {
    		echo 0;
    	}
	}

	function getTotalProject() {
		global $con;
		$idu = $_SESSION['id'];

		$query = "SELECT COUNT(idu) FROM group_project WHERE idu = $idu;";

		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0) {
			while($data = mysqli_fetch_array($result)) {
				if ($data['0'] == 0) {
					echo 0;
				}

				else {
					echo $data[0];
				}
			}
		}

		else {
			echo -1;
		}
	}

	function searchProject($inputSearch) {
		global $con;
		$idu = $_SESSION['id'];

		$query = "SELECT project.title, project.descp, project.idp FROM project JOIN group_project ON project.idp = group_project.idp WHERE group_project.idu = $idu AND project.title LIKE '%$inputSearch%';";

		$result = mysqli_query($con, $query);

    	if(mysqli_num_rows($result) > 0) {
    		while ($data = mysqli_fetch_array($result)): ?>

	        <div class="project" data-id="<?php echo $data['2'] ?>">
	            <img src="Illustration/Icon/Static/project.png" class="projectPicture" width="39px" height="39px">
	            <img src="Illustration/Icon/Static/option.svg" class="option" width="22px" height="22px">
	            <div class="menus">
	                <ul class="list">
	                    <li id="titleProject"><?php echo $data['0'] ?></li>
	                    <li id="open">Open...</li>
	                    <li id="delete">Delete...</li>
	                </ul>   
	            </div>
	            <p class="caption title"><?php echo $data['0'] ?></p>
	            <p class="caption desc" id="projectCaption"><?php echo $data['1'] ?></p>
	        </div>

			<?php endwhile;

			require_once 'ajaxFunction.php';
    	}

    	else {
    		echo 0;
    	}
	}

	function projectAdd($title, $dev, $date, $pDesc) {
		global $con;
		$idu = $_SESSION['id'];

		if($date != '') {
			$query = "INSERT INTO project (idp, title, totalMembers, exeTime, idps, descp, dateInitiated, idu, developer) VALUES (NULL, '$title', 1, '', 1, '$pDesc', '$date', $idu, '$dev');";
		}

		else {
			$query = "INSERT INTO project (idp, title, totalMembers, exeTime, idps, descp, dateInitiated, idu, developer) VALUES (NULL, '$title', 1, '', 1, '$pDesc', current_timestamp(), $idu, '$dev');";
		}

		$result = mysqli_query($con, $query);

		//After adding project
		if($result) {
			$result = addGroupProject($idu);

			echo $result;
		}

		else {
			echo $result;
		}
	}

	function openProject($pID) {
		global $con;
		$idu = $_SESSION['id'];

		$query = "SELECT idrole, idp FROM group_project WHERE idu = $idu AND idp = $pID LIMIT 1;";

		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$role = $row['idrole'];
			$_SESSION['idp'] = $row['idp'];

			if($role == 1) {
				echo 1;
			}

			else {
				echo 0;
			}
		}

		else {
			echo -1;
		}
	}

	function getProjectId($idu) {
		global $con;

    	$query = "SELECT idp FROM project WHERE idu = $idu AND idp NOT IN (SELECT idp FROM group_project WHERE idu = $idu) LIMIT 1;";

    	$result = mysqli_query($con,$query);

    	if(mysqli_num_rows($result) > 0) {
    		while ($row = mysqli_fetch_assoc($result)) {
    			return $pID = $row['idp'];
    		}
    	}

	}

	function addGroupProject ($idu) {
		global $con;

		$pID = getProjectId($idu);

		$query = "INSERT INTO group_project (idu, idp, idrole, idsv, idsa) VALUES ($idu, $pID, 1, 2, 3);";

		$result = mysqli_query($con,$query);

		if($result) {
			return 1;
		}

		else {
			return 0;
		}
	}

	function updateGroupProject() {

	}

	function setProjectStatus() {

	}

	function setStatusVote() {

	}

	function setStatusAgreement() {

	}

	function addStakeholder() {


		//After add stakeholder
		calculateTotalMembers();
	}

	function calculateTotalMembers() {

		//After calculate total members
		updateTotalMembers();
	}

	function updateTotalMembers() {

	}

	function updateProjectDetails() {

	}

	function getProjectName() {
		global $con;
		// $idu = $_SESSION['id'];
		$idp = $_SESSION['idp'];

		$query = "SELECT title FROM project WHERE idp = $idp;";

		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0) {
			while($data = mysqli_fetch_array($result)) {
				echo $data[0];
			}
		}

		else {
			echo -1;
		}
	}

	function fetchRequirement() {
		global $con;
		$idp = $_SESSION['idp'];

		$query = "SELECT name, rid, dateUpdated, idr FROM requirement WHERE idp = $idp;";

		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0) {
			$i = 1;

	   		while ($data = mysqli_fetch_assoc($result)): ?>

	        <tr data-id="<?php echo $data['idr'] ?>">
	        	<td><?php echo $i ?></td>
	            <td><?php echo $data['rid'] ?></td>
	            <td><?php echo $data['name'] ?></td>
	            <td><?php echo $data['dateUpdated'] ?></td>
	        </tr>

			<?php

			$i++;
			
			endwhile;

			require 'ajaxFunction.php';
		}

		else {
			echo 0;
		}
		
	}
	function addRequirement($rid,$rName) {
		global $con;
		$idp = $_SESSION['idp'];
		$idu = $_SESSION['id'];

		$query = "INSERT INTO requirement (idr, name, idpg, totalVote, statusGrouping, idp, rid, dateUpdated) VALUES (NULL, '$rName', 4, '', 0, $idp, '$rid', current_timestamp());";

		$result = mysqli_query($con,$query);

		//After adding requirement
		if($result) {
			$result = addVotedRequirement($idu,$idp);

			echo $result;
		}

		else {
			echo $result;
		}

	}

	function getRequirementID($idp) {
		global $con;

		$query = "SELECT idr FROM requirement WHERE idp = $idp AND idr NOT IN (SELECT idr FROM voted_requirement WHERE idp = $idp) LIMIT 1;";

    	$result = mysqli_query($con,$query);

    	if(mysqli_num_rows($result) > 0) {
    		while ($row = mysqli_fetch_assoc($result)) {
    			return $rID = $row['idr'];
    		}
    	}

    	else {
    		echo -1;
    	}
	}

	function addVotedRequirement($idu,$idp) {
		global $con;

		$rID = getRequirementID($idp);

		$query = "INSERT INTO voted_requirement (idu, idr, idp, vote) VALUES ($idu, $rID, $idp, '');";

		$result = mysqli_query($con,$query);

		if($result) {
			return 1;
		}

		else {
			return 0;
		}

	}

	function fetchRequirementData($rID) {
		global $con;

		$rid;
		$rName;

		$query = "SELECT rid, name FROM requirement WHERE idr = $rID LIMIT 1;";

		$result = mysqli_query($con, $query);

		if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$rid = $row['rid'];
			$rName = $row['name'];
		}

		else {
			$data['response'] = 0;

			echo json_encode($data);
		}

		$data['rid'] = $rid;
		$data['rName'] = $rName;
		$data['response'] = 1;

		echo json_encode($data);
	}

	function editRequirement($rID,$rid,$rName) {
		global $con;

		$query = "UPDATE requirement SET rid = '$rid', name = '$rName' WHERE idr = $rID;";

		$result = mysqli_query($con,$query);

		if($result) {
			echo 1;
		}

		else {
			echo 0;
		}
	}

	function deleteRequirement($rID) {
		global $con;

		$query = "DELETE FROM requirement WHERE idr = $rID;";

		$result = mysqli_query($con,$query);

		if($result) {
			echo 1;
		}

		else {
			echo 0;
		}
	}
?>