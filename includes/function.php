<?php	
	require "connection.php";
	session_start();

	if(isset($_GET['action'])) {
		if($_GET['action'] == "register") {
			sleep(2);

			if($_GET['fName'] != "" && $_GET['lName'] != "" && $_GET['email'] != "" && $_GET['pass'] != "" && $_GET['pass2'] != "") {
				$fName = $_GET['fName'];
				$lName = $_GET['lName'];
				$email = $_GET['email'];
				$pass = $_GET['pass'];
				$pass2 = $_GET['pass2'];
				registerUser($fName,$lName,$email,$pass,$pass2);
			}

			else 
			{
				$data['response'] = "empty";
				$data['comment'] = "All field must be entered";
				echo json_encode($data);
			}
		}

		if($_GET['action'] == "login") {
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

	}

	function registerUser($fName,$lName,$email,$pass,$pass2) {
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
			$query = "INSERT INTO user (first_name, last_Name, email, password) VALUES ('$fName','$lName','$email','$pass2')";

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
			$query = "SELECT idu, first_name, last_name, email, password FROM user WHERE email = '$email' AND password = '$pass' LIMIT 1";
			$result = mysqli_query($con, $query);

			if (mysqli_num_rows($result) == 1) {

				$row = mysqli_fetch_array($result);
				$_SESSION['id'] = $row['idu'];
				$_SESSION['fName'] = $row['first_name'];
				$_SESSION['lName'] = $row['last_name'];

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
?>