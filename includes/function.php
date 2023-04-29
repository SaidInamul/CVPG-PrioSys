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

		else if($_GET['action'] == 'search') {
			$inputSearch = stripslashes($_GET['inputSearch']);
			$inputSearch = mysqli_real_escape_string($con,$inputSearch);
			sleep(2);
			searchProject($inputSearch);
		}

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

		$query = "SELECT project.title, project.descp, project.idp FROM project JOIN group_project ON project.idp = group_project.idp WHERE idu = $idu;";

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

	function searchProject($inputSearch) {
		global $con;
		$idu = $_SESSION['id'];

		$query = "SELECT project.title, project.descp, project.idp FROM project JOIN group_project ON project.idp = group_project.idp WHERE idu = $idu AND project.title LIKE '%$inputSearch%';";

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
?>