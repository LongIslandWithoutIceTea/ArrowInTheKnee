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

  $email = $_POST['email'];
  $password = $_POST['password'];
	$username = $_POST['username'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];

	$query = "select * from User where email = '{$email}'";

	if ($conn->query($query)->num_rows !== 0) {
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
						<div class='mdl-typography--font-light mdl-typography--display-3-color-contrast'>E-mail Address</div>
						<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
						<div class='mdl-typography--font-light mdl-typography--display-3'>{$email}</div>
						<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
						<div class='mdl-typography--font-light mdl-typography--display-3-color-contrast'>Has Already been Registered</div>
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
	} else {
		$column_list = "(email, password, username, age, gender)";
		$value_list = "('{$email}', '{$password}', '{$username}', {$age}, '{$gender}')";
		$query = "INSERT INTO User ".$column_list." VALUES ".$value_list;
		$res = mysqli_query($conn, $query);
		if(! $res )
		{
  			die('failed to insert: ' . $conn->error);
		}
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
						<div class='mdl-typography--font-light mdl-typography--display-3-color-contrast'>Your Account</div>
						<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
						<div class='mdl-typography--font-light mdl-typography--display-3'>{$email}</div>
						<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
						<div class='mdl-typography--font-light mdl-typography--display-3-color-contrast'>Is Ready Please</div>
						<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
						<a class='mdl-typography--font-light mdl-typography--display-3-color-contrast' href='sign_in.html'>Sign In</a>
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
	}
?>
