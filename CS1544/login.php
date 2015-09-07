<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
</head>
<body>
<?php
	if ($_POST["name"] == "" || $_POST["password"] == "") {
		header("Location: error.php");
		die();
	}

	$name = htmlspecialchars(trim($_POST["name"]));
	$password = htmlspecialchars(trim($_POST["password"]));
	$users = file("users.txt");

	/*
	Would use, but would cause a runtime of O(N^2)
	# Returns if the username exists. 
	function username_exists($name) {
		foreach ($users as $user) {
			$userName = trim(explode(":", $user)[0]);
			$userPassword = trim(explode(":", $user)[1]);
			if ($name == $userName) {
				return true;
			}

		}

		return false;

	}

	# Returns if the password is correct for the given username. 
	function correct_password($name, $password) {
		foreach ($users as $user) {
			$userName = trim(explode(":", $user)[0]);
			$userPassword = trim(explode(":", $user)[1]);
			if ($name == $userName && $password == $userPassword) {
				return true;
			}

		}

		return false;

	}
	*/
	
	$userName = "";
	$userPassword = "";
	foreach ($users as $user) {
		$userName = trim(explode(":", $user)[0]);
		$userPassword = trim(explode(":", $user)[1]);
		if ($name == $userName) {
			if ($password == $userPassword) {
				session_start();
				$_SESSION["userName"] = $userName;
				$_SESSION["userPassword"] = $userPassword;
				header("Location: todolist.php");
				die();
			} 

			else {
				header("Location: start.php");
				die();
			}

		}

	}


	echo "No user \n";
	
	// New user
	// Validate information
	if (preg_match("/[a-z0-9]{3,8}/", $name) && preg_match("/^\d.{4,10}\D$/", $password)) {
		//echo "valid new user info";
		file_put_contents("users.txt", $name . ":" . $password . "\n", FILE_APPEND | LOCK_EX);
		//echo file_get_contents("users.txt");
		header("Location: todolist.php");
	} else {
		header("Location: start.php");
	}
?>
</body>
</html>

