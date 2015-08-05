<?php
include ('DBFunctions.php');

if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];
 
    $dbFunctions = new DBFunctions();
 
    // response Array
    $response = array("tag" => $tag, "error" => FALSE);
	
	//Login the user
	if ($tag == 'login') {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$result = $dbFunctions->login($username, $password);
		if ($result) {
			$response["error"] = FALSE;
			$response["user"]["username"] = $username;
			$response["user"]["password"] = $password;
			echo json_encode($response);
		}
		else {
			$response["error"] = TRUE;
			$response["error_msg"] = "Incorrect username or password";
			echo json_encode($response);
		}
	}
	//Register the user
	else if ($tag == 'register') {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if ($dbFunctions->isUserExist($username)) {
			$response["error"] = TRUE;
			$response['error_msg'] = "User already exist";
			echo json_encode($response);
		}
		else {
			$result = $dbFunctions->register($username, $password);
			if ($result) {
				$response['error'] = FALSE;
				$response['user']['username'] = $username;
				$response['user']['password'] = $password;
				echo json_encode($response);
			}
			else {
				$response['error'] = TRUE;
				$response['error_msg'] = 'An error occured during registration';
				echo json_encode($response);
			}
		}
	}
	
}
?>