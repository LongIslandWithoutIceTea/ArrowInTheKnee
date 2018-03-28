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
	$password = $_POST["password"];
	//print($_POST["password"]);
	$query = "select * from User where email = '{$email}' and password = '{$password}'";
	if ($conn->query($query)->num_rows !== 0){
		$res = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($res, MYSQLI_NUM);
		$password = $row[1];
		$username = $row[2];
		$avatar = $row[3];
		// echo $row[3];
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
							<img src='{$avatar}' class='demo-avatar'>
							<div class='avatar-dropdown'>
								<span>{$username}</span>
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
								<span class='mdl-typography--font-light mdl-typography--title'>Current Password:{$password}</span>
								<p></p>
								<span class='mdl-typography--font-light mdl-typography--title'>New Password:</span><input type='text' name='password'>
								<p></p>
							</div>
							<div>
								<p></p>
								<span class='mdl-typography--font-light mdl-typography--title'>Current Username:{$username}</span>
								<p></p>
								<span class='mdl-typography--font-light mdl-typography--title'>New Username:</span><input type='text' name='username'>
								<p></p>
							</div>
							<div>
								<p></p>
								<span class='mdl-typography--font-light mdl-typography--title'>Current Avatar:{$avatar}</span>
								<p></p>
								<span class='mdl-typography--font-light mdl-typography--title'>New Avatar (URL):</span><input type='text' name='avatar'>
								<p></p>
							</div>
							<p></p>
							<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Confirm Update'>
						</form>
						<form action='delete_account.php' method='POST' enctype='multipart/form-data'>
							<div style='text-indent:25px'>
								<p></p>
								<input type='text' name='email' value='{$email}' style='display: none'></p>
								<p></p>
							</div>
							<p></p>
							<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red mdl-color-text--accent-contrast' type='submit' value='Delete Account'>
						</form>
					</main>
				</div>
				<script src='https://code.getmdl.io/1.3.0/material.min.js'></script>
			</body>
		</html>


		");
	} else {
    //////wrong email or password, retry
    print("
		<!doctype html>
		<!--
			Material Design Lite
			Copyright 2015 Google Inc. All rights reserved.

			Licensed under the Apache License, Version 2.0 (the 'License');
			you may not use this file except in compliance with the License.
			You may obtain a copy of the License at

					https://www.apache.org/licenses/LICENSE-2.0

			Unless required by applicable law or agreed to in writing, software
			distributed under the License is distributed on an 'AS IS' BASIS,
			WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
			See the License for the specific language governing permissions and
			limitations under the License
		-->

		<html lang='en'>
			<head>
				<meta charset='utf-8'>
				<meta http-equiv='X-UA-Compatible' content='IE=edge'>
				<meta name='description' content='Introducing Lollipop, a sweet new take on Android.'>
				<meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0'>
				<title>ArrowInTheKnee</title>

				<!-- Page styles -->
				<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en'>
				<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
				<link rel='stylesheet' href='https://code.getmdl.io/1.3.0/material.min.css'>
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
				</style>
			</head>
			<body>
				<div class='mdl-layout mdl-js-layout mdl-layout--fixed-header'>
					<a name='top'></a>
					<div class='android-header mdl-layout__header mdl-layout__header--waterfall'>
						<div class='mdl-layout__header-row'>
							<span class='android-title mdl-layout-title'>
								<a href='index.html'><img class='android-logo-image' src='images/logo_temp1.png'></a>
							</span>
							<div class='android-header-spacer mdl-layout-spacer'></div>
							<div class='android-navigation-container'>
								<nav class='android-navigation mdl-navigation'>
									<a class='mdl-navigation__link mdl-typography--text-uppercase' href='sign_in.html'>sign in</a>
									<a class='mdl-navigation__link mdl-typography--text-uppercase' href='register.html'>register</a>
								</nav>
							</div>
							<!-- <span class='android-mobile-title mdl-layout-title'>
								<img class='android-logo-image' src='images/logo_temp.png'>
							</span> -->
						</div>
					</div>

					<div class='container' align='center'>
						<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
						<div class='mdl-typography--font-light mdl-typography--display-3-color-contrast'>Wrong E-mail or Password</div>
						<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
						<a class='mdl-typography--font-light mdl-typography--display-3-color-contrast' href='sign_in.html'>Retry</a>
					</div>

						<footer class='android-footer-fixed mdl-mega-footer'>

							<div class='mdl-mega-footer--middle-section'>
								<p class='mdl-typography--font-light'>© 2018 ArrowInTheKnee</p>
							</div>

							<div class='mdl-mega-footer--bottom-section'>
								<a class='android-link android-link-menu mdl-typography--font-light' id='version-dropdown'>
									Contact Us
									<i class='material-icons'>arrow_drop_up</i>
								</a>
								<ul class='mdl-menu mdl-js-menu mdl-menu--top-left mdl-js-ripple-effect' for='version-dropdown'>
									<li class='mdl-menu__item'>chuangk2@illinois.edu</li>
									<li class='mdl-menu__item'>junkaic2@illinois.edu</li>
									<li class='mdl-menu__item'>yw3@illinois.edu</li>
								</ul>
							</div>
						</footer>
					</div>
				</div>
				<a href='https://github.com/LongIslandWithoutIceTea/ArrowInTheKnee' target='_blank' id='view-source' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast'>View on Github</a>
				<script src='https://code.getmdl.io/1.3.0/material.min.js'></script>
				<script src='js/slideshow.js'></script>
			</body>
		</html>
");
    //////
}
mysql_close($conn);
?>
