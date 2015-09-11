<?php
	session_start();
	$userList = $_SESSION["userList"];
	$userListFile = file($userList);
	if ((!isset($_POST["action"]) || $_POST["action"] == "") ||
		($_POST["action"] == "add" && (!isset($_POST["item"]) || $_POST["item"] == "")) ||
		($_POST["action"] == "delete" && (!isset($_POST["index"]) || $_POST["index"] == "")) ||
		!preg_match("/\d*/", $_POST["index"]) || $_POST["index"] > count($userListFile) - 1) {
		echo "error";
		die();
	}

	$action = $_POST["action"];
	$item = $_POST["item"];
	$index = $_POST["index"];
	if ($action == "add") {
		file_put_contents($userList, $item . "\n", FILE_APPEND | LOCK_EX);
	} 

	else if ($action == "delete") {
		if (count($userListFile) == 1) {
			unlink($userList);
		} else {
			$toDos = "";
			for ($i = 0; $i < count($userListFile); $i++) {
				if ($i != $index) {
					$toDos .= $userListFile[$i];
				}

			}

			file_put_contents($userList, $toDos, LOCK_EX);
		}

	}

	header("Location: todolist.php");

?>