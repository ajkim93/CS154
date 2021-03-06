<?php
	session_start();
	if (empty($_SESSION["userName"]) || !isset($_SESSION["userName"]) || $_SESSION["userName"] == "") {
		header("Location: start.php");
		die();
	}

	date_default_timezone_set("America/Los_Angeles");
	$userName = $_SESSION["userName"];
	$currentTime = date("D y M d, g:i:s a e");
	$sevenDays = time() + 60 * 60 * 24 * 7;
	setcookie("lastLogin", $currentTime, $sevenDays);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Remember the Cow</title>
		<link href="https://webster.cs.washington.edu/css/cow-provided.css" type="text/css" rel="stylesheet" />
		<link href="cow.css" type="text/css" rel="stylesheet" />
		<link href="https://webster.cs.washington.edu/images/todolist/favicon.ico" type="image/ico" rel="shortcut icon" />
	</head>

	<body>
		<div class="headfoot">
			<h1>
				<img src="https://webster.cs.washington.edu/images/todolist/logo.gif" alt="logo" />
				Remember<br />the Cow
			</h1>
		</div>

		<div id="main">
			<h2><?= $userName ?>'s To-Do List</h2>
			<?php
				$toDos = array();
				$userList = "todo_" . $userName . ".txt";
				$_SESSION["userList"] = $userList;
				if (file_exists($userList)) {
					$toDos = file($userList);
				}

			?>
			<ul id="todolist">
				<?php 
					$index = 0;
					foreach($toDos as $toDo) {
						$toDo = htmlspecialchars($toDo);
						?>
						<li>
							<form action="submit.php" method="post">
								<input type="hidden" name="action" value="delete" />
								<input type="hidden" name="index" value="<?= $index ?>" />
								<input type="submit" value="Delete" />
							</form>
							<?= $toDo ?>
						</li>
						<?php
						$index++;
					}
				?>	
				<li>
					<form action="submit.php" method="post">
						<input type="hidden" name="action" value="add" />
						<input name="item" type="text" size="25" autofocus="autofocus" />
						<input type="submit" value="Add" />
					</form>
				</li>
			</ul>

			<div>
				<a href="logout.php"><strong>Log Out</strong></a>
				<em>(logged in since <?= $currentTime ?>)</em>
			</div>

		</div>

		<div class="headfoot">
			<p>
				&quot;Remember The Cow is nice, but it's a total copy of another site.&quot; - PCWorld<br />
				All pages and content &copy; Copyright CowPie Inc.
			</p>

			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php">
					<img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php">
					<img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</div>
	</body>
</html>

