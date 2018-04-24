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
		$query = "SELECT User.email, User.avatar, User.username FROM User, friend_with WHERE friend_with.email1 = '{$email}' AND User.email = friend_with.email2";
		if($conn->query($query)->num_rows !== 0){
			$res_friends = mysqli_query($conn, $query);
		}else{
			$res_friends = 0;
			//print("wtf");
		}
		$query = "SELECT Game.name, Game.graph FROM Game JOIN likes ON likes.name = Game.name WHERE email = '{$email}'";
		if($conn->query($query)->num_rows !== 0){
			$res_likes = mysqli_query($conn, $query);
		}else{
			$res_likes = 0;
			//print("wtf");
		}

		$query = "SELECT * FROM Comments WHERE email = '{$email}'";
		if($conn->query($query)->num_rows !== 0){
			$res_comments = mysqli_query($conn, $query);
		}else{
			$res_comments = 0;
			//print("wtf");
		}

		// while($row = mysqli_fetch_array($res_likes, MYSQLI_NUM)){
		// 	print("{$row[0]},{$row[1]}");
		// }
		// while($row = mysqli_fetch_array($res_friends, MYSQLI_NUM)){
		// 	print("{$row[0]},{$row[1]},{$row[2]}<p></p>");
		// }

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
		          <span class='mdl-layout-title'>Home</span>
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
								<form action='update.php' method='POST' enctype='multipart/form-data'>
										<input type='text' name='email' value='{$email}' style='display: none'>
									<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--grey-50 mdl-color-text--accent-contrast' type='submit' value='Settings'>
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
		          <div class='demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--5-col'>
							<div class='col s12 avatar-part'>
							<h5>Friends</h5>
							<div class='mdl-card__actions mdl-card--border'></div>
							<p></p>
							<ul class='demo-list-three mdl-list'>
							");

						if($res_friends == 0) {
								print("
								<li class='mdl-list__item mdl-list__item--three-line'>
								<span class='mdl-list__item-primary-content'>
									<span class='mdl-typography--font-light mdl-typography--subhead'>Your list of friends is currently empty</span></br>
									<span class='mdl-typography--font-light mdl-typography--subhead'>What about starting with SHUFFLE?</span>
								</span>
								</li>
								");
						}else{

							while($row = mysqli_fetch_array($res_friends, MYSQLI_NUM)){
								print("
								<li class='mdl-list__item mdl-list__item--three-line'>
							    <span class='mdl-list__item-primary-content'>
							      <img src='{$row[1]}' class='mdl-list__item-avatar'>
							      <span>{$row[2]}</span>
							    </span>
							    <span class='mdl-list__item-secondary-content'>
									<form action='delete_friend.php' method='POST' enctype='multipart/form-data'>
											<input type='text' name='email1' value='{$email}' style='display: none'>
											<input type='text' name='email2' value='{$row[0]}' style='display: none'>
										<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-A700 mdl-color-text--accent-contrast' type='submit' value='Delete'>
									</form>
							    </span>
							  </li>
								");
							}
						}
		print("
								</ul>
								</div>
								<p></p>
								<div class='mdl-card__actions mdl-card--border'>
								<form action='find_friend.php' method='POST' enctype='multipart/form-data'>
									<div>
										<input type='text' name='email' value='{$email}' style='display: none'></p>
									</div>
									<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Find More Friends!'>
								</form>
	              </div>
						  </div>
							<div class='demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--7-col'>
							<div class='col s12 avatar-part'>
							<h5>Likes</h5>
							<div class='mdl-card__actions mdl-card--border'></div>
							<ul class='demo-list-three mdl-list'>
							<p></p>
							");

						if($res_likes == 0) {
							print("
									<li class='mdl-list__item mdl-list__item--three-line'>
										<span class='mdl-list__item-primary-content'>
											<span class='mdl-typography--font-light mdl-typography--subhead'>Your list of favorite is currently empty</span></br>
											<span class='mdl-typography--font-light mdl-typography--subhead'>What about starting with SHUFFLE?</span>
										</span>
									</li>
									");
						}else{

							while($row = mysqli_fetch_array($res_likes, MYSQLI_NUM)){
								print("

								<li class='mdl-list__item mdl-list__item--three-line'>
									<span class='mdl-list__item-primary-content'>
										<img src='{$row[1]}' class='mdl-list__item-avatar'>
										<span>{$row[0]}</span>
									</span>
									<span class='mdl-list__item-secondary-content'>
									<table>
									<tr>
									<td>
									<form action='game_detail.php' method='POST' enctype='multipart/form-data'>
											<input type='text' name='email' value='{$email}' style='display: none'>
											<input type='text' name='name' value='{$row[0]}' style='display: none'>
										<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Detail'>
									</form>
									</td>
									<td>
									<form action='delete_like.php' method='POST' enctype='multipart/form-data'>
											<input type='text' name='email' value='{$email}' style='display: none'>
											<input type='text' name='name' value='{$row[0]}' style='display: none'>
										<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-A700 mdl-color-text--accent-contrast' type='submit' value='Delete'>
									</form>
									</td>
									</tr>
									</table>
									</span>
								</li>
								");
							}
						}
print("
							</ul>
								</div>
								<p></p>
								<div class='mdl-card__actions mdl-card--border'>

								<table>
								<tr>
								<td>
								<form action='shuffle.php' method='POST' enctype='multipart/form-data'>
										<input type='text' name='email' value='{$email}' style='display: none'></p>
									<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--purple-A700 mdl-color-text--red-contrast' type='submit' value='SHUFFLE'>
								</form>
								</td>
								<td>
								<form action='find_game.php' method='POST' enctype='multipart/form-data'>
										<input type='text' name='email' value='{$email}' style='display: none'></p>
									<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='FIND MORE GAMES!'>
								</form>
								</td>
								</tr>
								</table>

	              </div>
							</div>
							<div class='demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col'>
							<div class='col s12 avatar-part'>
							<h5>Comments</h5>
							<div class='mdl-card__actions mdl-card--border'></div>
							<p></p>
							");

						if($res_comments == 0) {
								print("
								<span class='mdl-list__item-primary-content'>
									<span class='mdl-typography--font-light mdl-typography--subhead'>You haven't commented any game yet!</span>
								</span>
								");
						}else{

							while($row = mysqli_fetch_array($res_comments, MYSQLI_NUM)){
								$query_temp = "SELECT * FROM Game WHERE name = '{$row[1]}'";
								$res_temp = mysqli_query($conn, $query_temp);
								$row_temp = mysqli_fetch_array($res_temp, MYSQLI_NUM);

								print("

							<div class='demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop mdl-grid'>
								<div class='mdl-card__supporting-text mdl-color-text--grey-600'>
									<img src='{$row_temp[6]}' style='width:50px'>
									<h5 class='mdl-card__title-text'>{$row[1]}</h5>
										Rating: {$row[2]}<br />
										Comment: {$row[4]}
										<div class='mdl-card__actions mdl-card--border'></div>
										<form action='delete_com.php' method='POST' enctype='multipart/form-data'>
												<input type='text' name='email' value='{$email}' style='display: none'>
												<input type='text' name='CID' value='{$row[0]}' style='display: none'>
											<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-A700 mdl-color-text--accent-contrast' type='submit' value='Delete'>
										</form>
								</div>
	            </div>
								");
							}
							print('<br />');
						}
		print("
								</div>
								<p></p>
						  </div>
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
