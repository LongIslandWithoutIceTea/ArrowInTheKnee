<?php
	$servername = "arrowintheknee.web.engr.illinois.edu";
	$username = "arrowintheknee_chazhongcha";
	$password = "Ke971120";
	$dbname = "arrowintheknee_GO";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$email = $_POST["email"];
	//print($_POST["email"]);
	$new_password = $_POST["password"];
	$new_username = $_POST["username"];
	$new_avatar = $_POST["avatar"];
	//print($_POST["password"]);
	$query = "UPDATE User SET password='".$new_password."', username='".$new_username."', avatar='".$new_avatar."' WHERE email='".$email."'";
	//print($query);
	$res = mysqli_query($conn, $query);
	if(! $res )
	{
			die('failed to update: ' . $conn->error);
	}
	print("
	<!doctype html>
	<html lang='en'>
		<head>
			<meta charset='utf-8'>
			<meta http-equiv='X-UA-Compatible' content='IE=edge'>
			<meta name='description' content='A front-end template that helps you build fast, modern mobile web apps.'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0'>
			<title>User Profile</title>

			<!-- Add to homescreen for Chrome on Android -->
			<meta name='mobile-web-app-capable' content='yes'>
			<link rel='icon' sizes='192x192' href='images/android-desktop.png'>

			<!-- Add to homescreen for Safari on iOS -->
			<meta name='apple-mobile-web-app-capable' content='yes'>
			<meta name='apple-mobile-web-app-status-bar-style' content='black'>
			<meta name='apple-mobile-web-app-title' content='Material Design Lite'>
			<link rel='apple-touch-icon-precomposed' href='images/ios-desktop.png'>

			<!-- Tile icon for Win8 (144x144 + tile color) -->
			<meta name='msapplication-TileImage' content='images/touch/ms-touch-icon-144x144-precomposed.png'>
			<meta name='msapplication-TileColor' content='#3372DF'>

			<link rel='shortcut icon' href='images/favicon.png'>

			<!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
			<!--
			<link rel='canonical' href='http://www.example.com/'>
			-->

			<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en'>
			<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
			<link rel='stylesheet' href='https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css'>
			<link rel='stylesheet' href='css/styles_profile.css'>
			<link rel='stylesheet' href='css/styles.css'>
			<style>
			#view-source {
				position: fixed;
				display: block;
				right: 0;
				bottom: 0;
				margin-right: 40px;
				margin-bottom: 40px;
				z-index: 900;
			}
			input[type=text], select {
	    	width: 60%;
	    	padding: 12px 20px;
	    	margin: 8px 0;
	    	display: inline-block;
	    	border: 1px solid #ccc;
	    	border-radius: 4px;
	    	box-sizing: border-box;
			}
			</style>
		</head>
		<body>
			<div class='demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header'>
				<header class='demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600'>
					<div class='mdl-layout__header-row'>
						<span class='mdl-layout-title'>Profile Update</span>
						<div class='mdl-layout-spacer'></div>
					</div>
				</header>
				<div class='demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50'>
					<header class='demo-drawer-header'>
						<img src='{$new_avatar}' class='demo-avatar'>
						<div class='avatar-dropdown'>
							<span>{$new_username}</span>
							<div class='mdl-layout-spacer'></div>
						</div>
					</header>
					<nav class='demo-navigation mdl-navigation mdl-color--blue-grey-800'>
						<a class='mdl-navigation__link' href=''><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>home</i>Home</a>
						<div class='mdl-layout-spacer'></div>
					</nav>
				</div>
				<main class='mdl-layout__content mdl-color--grey-100'>
					<form action='update_profile.php' method='POST' enctype='multipart/form-data'>
						<div style='text-indent:25px'>
							<p></p>
							<span class='mdl-typography--font-light mdl-typography--title'>E-mail:{$email}</span>
							<input type='text' name='email' value='{$email}' style='display: none'></p>
							<p></p>
						</div>
						<div>
							<p></p>
							<span class='mdl-typography--font-light mdl-typography--title'>Current Password:{$new_password}</span>
							<p></p>
							<span class='mdl-typography--font-light mdl-typography--title'>New Password:</span><input type='text' name='password'>
							<p></p>
						</div>
						<div>
							<p></p>
							<span class='mdl-typography--font-light mdl-typography--title'>Current Username:{$new_username}</span>
							<p></p>
							<span class='mdl-typography--font-light mdl-typography--title'>New Username:</span><input type='text' name='username'>
							<p></p>
						</div>
						<div>
							<p></p>
							<span class='mdl-typography--font-light mdl-typography--title'>Current Avatar:{$new_avatar}</span>
							<p></p>
							<span class='mdl-typography--font-light mdl-typography--title'>New Avatar (URL):</span><input type='text' name='avatar'>
							<p></p>
						</div>
						<p></p>
						<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Confirm Update'>
					</form>
				</main>
			</div>
			<script src='https://code.getmdl.io/1.3.0/material.min.js'></script>
		</body>
	</html>
	");
	mysql_close($conn);
?>
