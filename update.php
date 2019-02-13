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
	$password = $_POST["password"];
	$query = "select * from User where email = '{$email}'";
	$res = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($res, MYSQLI_NUM);
	$password = $row[1];
	$username = $row[2];
	$avatar = $row[3];

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
		    <meta name='description' content='A front-end template that helps you build fast, modern mobile web apps.'>
		    <meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0'>
		    <title>Material Design Lite</title>

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
		          <span class='mdl-layout-title'>Settings</span>
		          <div class='mdl-layout-spacer'></div>


							<form action='explore_as_user1.php' method='POST' enctype='multipart/form-data'>
									<input type='text' name='email' value='{$email}' style='display: none'></p>
								<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='search'>
							</form>

		        </div>
		      </header>
		      <div class='demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50'>
		        <header class='demo-drawer-header'>
		          <img src='{$avatar}' class='demo-avatar' align='center'>
		          <div class='demo-avatar-dropdown'>
		            <span>{$email}</span>
		            <div class='mdl-layout-spacer'></div>
								<form action='sign_in.php' method='POST' enctype='multipart/form-data'>
										<input type='text' name='email' value='{$email}' style='display: none'>
										<input type='text' name='password' value='{$password}' style='display: none'></p>
									<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--grey-50 mdl-color-text--accent-contrast' type='submit' value='Back to Profile'>
								</form>
		          </div>
							<!-- <div id='result'></div> -->
		        </header>
		        <nav class='demo-navigation mdl-navigation mdl-color--blue-grey-800'>
		        	<a class='mdl-navigation__link'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>home</i>Home</a>

							<!-- <form action='sign_in.php' method='POST' enctype='multipart/form-data'>
								<div>
									<input type='text' name='email' value='{$email}' style='display: none'></p>
								</div>
								<input class='mdl-navigation__link' type='submit' value='Likes'>
							</form> -->
		          <!-- <a class='mdl-navigation__link' href='profile_likes.html'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>favorite</i>Likes</a>
							<a class='mdl-navigation__link' href='profile_friends.html'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>contacts</i>Friends</a>
							<a class='mdl-navigation__link' href='profile_settings.html'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>settings</i>Settings</a> -->
		          <div class='mdl-layout-spacer'></div>
		          <a class='mdl-navigation__link' href='index.html'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>navigate_before</i>Log out</span></a>
		        </nav>
		      </div>
		      <main class='mdl-layout__content mdl-color--grey-100'>
		        <div class='mdl-grid demo-content'>
							<div class='demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col'>
							<div class='col s12 avatar-part'>
							<h5>Profile Update</h5>
							<div class='mdl-card__actions mdl-card--border'></div>
							<p></p>
								</div>
								<form action='update_profile.php' method='POST' enctype='multipart/form-data'>
									<div>
										<span class='mdl-typography--font-light mdl-typography--title'>E-mail:{$email}</span>
										<input type='text' name='email' value='{$email}' style='display: none'></p>
									</div>
									<div>
										<span class='mdl-typography--font-light mdl-typography--title'>Current Password:{$password}</span>
										<div class='mdl-layout-spacer'></div>
										<span class='mdl-typography--font-light mdl-typography--title'>New Password:</span><input type='text' name='password'>
									</div>
									<div>
										<span class='mdl-typography--font-light mdl-typography--title'>Current Username:{$username}</span>
										<div class='mdl-layout-spacer'></div>
										<span class='mdl-typography--font-light mdl-typography--title'>New Username:</span><input type='text' name='username'>
									</div>
									<div>
										<span class='mdl-typography--font-light mdl-typography--title'>Current Avatar:{$avatar}</span>
										<div class='mdl-layout-spacer'></div>
										<span class='mdl-typography--font-light mdl-typography--title'>New Avatar (URL):</span><input type='text' name='avatar'>
									</div>
									<p></p>
									<div class='mdl-card__actions mdl-card--border'>
									<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Confirm Update'>

								</form>
						  </div>
		        </div>
						<div class='demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col'>
							<form action='delete_account.php' method='POST' enctype='multipart/form-data' style='text-align:center'>
									<input type='text' name='email' value='{$email}' style='display: none'></p>
								<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red mdl-color-text--accent-contrast' type='submit' value='Delete Account'>
							</form>
						</div>
		      </main>
		    </div>
		      <a href='https://github.com/LongIslandWithoutIceTea/ArrowInTheKnee' target='_blank' id='view-source' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast'>View on Github</a>
		    <script src='https://code.getmdl.io/1.3.0/material.min.js'></script>
				<script>
				// Check browser support
				if (typeof(Storage) !== 'undefined') {
					// Store
					localStorage.setItem('curr_email', '{$email}');
				// Retrieve
					document.getElementById('result').innerHTML = localStorage.getItem('curr_email');
				} else {
					document.getElementById('result').innerHTML = 'Sorry, your browser does not support Web Storage...';
				}
				</script>
		  </body>
		</html>



		");
    //////
mysql_close($conn);
?>
