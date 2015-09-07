<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />

		<link href="cow.css" type="text/css" rel="stylesheet" />
		<link href="images/favicon.ico" type="image/ico" rel="shortcut icon" />
	</head>

	<body>
		<div class="headfoot">
			<h1>
				<img src="images/logo.gif" alt="logo" />
				Remember<br />the Cow
			</h1>
		</div>

		<div id="main">
			<p>
				The best way to manage your tasks. <br />
				Never forget the cow (or anything else) again!
			</p>

			<p>
				Log in now to manage your to-do list. <br />
				If you do not have an account, one will be created for you.
			</p>

			<form id="loginform" action="login.php" method="post">
				<div><input name="name" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
				<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
				<div><input type="submit" value="Log in" /></div>
			</form>

			<p>
				<em>(last login from this computer was ???)</em>
			</p>
		</div>

		<div class="headfoot">
			<p>
				<q>Remember The Cow is nice, but it's a total copy of another site.</q> - PCWorld<br />
				All pages and content &copy; Copyright CowPie Inc.
			</p>

			<div id="w3c">
				<a href="http://validator.w3.org/check?uri=referer"><img src="images/w3c-html.png" alt="Valid HTML5" /></a>
				<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="images/vcss-blue.gif" alt="Valid CSS" /></a>
			</div>
		</div>
	</body>
</html>
