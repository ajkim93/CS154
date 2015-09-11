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
		file_put_contents("users.txt", $name . ":" . $password . "\n", FILE_APPEND | LOCK_EX);
		header("Location: todolist.php");
	} else {
		header("Location: start.php");
	}
?>
</body>
</html>

