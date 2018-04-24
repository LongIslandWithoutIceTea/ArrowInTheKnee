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
	$name = $_POST["name"];

	$query = "SELECT * FROM User WHERE email = '{$email}'";
	$res = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($res, MYSQLI_NUM);
	$password = $row[1];
	$username = $row[2];
	$avatar = $row[3];

	$query = "SELECT * FROM Game WHERE name = '{$name}'";
	$res = mysqli_query($conn, $query);
	if ($conn->query($query)->num_rows == 0){
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
								<form action='sign_in.php' method='POST' enctype='multipart/form-data'>
										<input type='text' name='email' value='{$email}' style='display: none'>
										<input type='text' name='password' value='{$password}' style='display: none'>
									<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='{$username}'>
								</form>
								</nav>
							</div>
							<!-- <span class='android-mobile-title mdl-layout-title'>
								<img class='android-logo-image' src='images/logo_temp.png'>
							</span> -->
						</div>
					</div>

					<div class='container' align='center'>
						<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
						<div class='mdl-typography--font-light mdl-typography--display-3-color-contrast'>Sorry we find NOTHING!</div>
						<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
						<form action='explore_as_user1.php' method='POST' enctype='multipart/form-data'>
								<input type='text' name='email' value='{$email}' style='display: none'>
							<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Retry'>
						</form>
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
	$row = mysqli_fetch_array($res, MYSQLI_NUM);
	$website = $row[1];
	$release_date = $row[2];
	$developer = $row[3];
	$our_rating = $row[4];
	$network_rating = $row[5];
	$graph = $row[6];
	//print($name);

	$query = "SELECT genres FROM genre_of WHERE games = '{$name}'";
	$res_genres = mysqli_query($conn, $query);

	$query = "SELECT themes FROM theme_of WHERE games = '{$name}'";
	$res_themes = mysqli_query($conn, $query);

	$query = "SELECT * FROM Comments WHERE games = '{$name}'";
	$res_comments = mysqli_query($conn, $query);

	if ($conn->query($query)->num_rows !== 0) {
		$query = "SELECT AVG(score) FROM Comments WHERE games = '{$name}'";
		$res_avg_score = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($res_avg_score, MYSQLI_NUM);
		$avg = (int)$row[0];
	}else {
		$avg = -1;
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
	    	width: 80%;
	    	padding: 12px 20px;
	    	margin: auto;
	    	display: inline-block;
	    	border: 1px solid #ccc;
	    	border-radius: 4px;
	    	box-sizing: border-box;
			}
			textarea{
				height:400px;
				width: 80%;
	    	padding: 12px 20px;
	    	margin: auto;
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
								<form action='sign_in.php' method='POST' enctype='multipart/form-data'>
										<input type='text' name='email' value='{$email}' style='display: none'>
										<input type='text' name='password' value='{$password}' style='display: none'>
									<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='{$username}'>
								</form>
							</nav>
						</div>
						<!-- <span class='android-mobile-title mdl-layout-title'>
							<img class='android-logo-image' src='images/logo_temp.png'>
						</span> -->
					</div>
				</div>

				<div class='mdl-grid demo-content'>
	          <div class='demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-grid''>
							<div id='search_box' align='center'>
								<form action='add_comment.php' method='POST' enctype='multipart/form-data'>
								<input type='text' name='email' value='{$email}' style='display: none'>
								<input type='text' name='games' value='{$name}' style='display: none'>
								 <div>
									 <span class='mdl-typography--font-light mdl-typography--subhead'>Rating(0-100)</span>
									 <input type='text' name='rating'>
								 </div>
								 <div>
									 <span class='mdl-typography--font-light mdl-typography--subhead'>Comments</span>
									 <p></p>
									 <textarea name='content' cols='40' rows='5'></textarea>
									 <p></p>
								 </div>
								 <p></p>
								 <input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Submit'>
							 </form>
							</div>
	          </div>
	          <div class='demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--4-col' >");


						while($row = mysqli_fetch_array($res_comments, MYSQLI_NUM)){
							$query_temp = "SELECT * FROM User WHERE email = '{$row[3]}'";
							$res_temp = mysqli_query($conn, $query_temp);
							$row_temp = mysqli_fetch_array($res_temp, MYSQLI_NUM);

							print("

						<div class='demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop mdl-grid'>
							<div class='mdl-card__supporting-text mdl-color-text--grey-600'>
								<img src='{$row_temp[3]}' style='width:50px'>
								<h5 class='mdl-card__title-text'>{$row_temp[2]}</h5>
									Rating: {$row[2]}<br />
									Comment: {$row[4]}
									<div class='mdl-card__actions mdl-card--border'></div>
									<form action='add_friend_from_com.php' method='POST' enctype='multipart/form-data'>
											<input type='text' name='email1' value='{$email}' style='display: none'>
											<input type='text' name='name' value='{$name}' style='display: none'>
											<input type='text' name='email2' value='{$row[3]}' style='display: none'>
										<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Add Friend'>
									</form>
							</div>
            </div>
							");
						}
						print('<br />');

print("

	          </div>
	          <div class='demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-grid' >
	              <div class='mdl-card__title mdl-card--expand mdl-grid'>
								 	<img src='{$graph}' stype='width:90px'><br />
	              </div>

								<div class='mdl-card__title mdl-card--expand'>
								 	<h2 class='mdl-card__title-text'>{$name}</h2>
	              </div>
	              <div class='mdl-card__supporting-text mdl-color-text--grey-600'>
									Network Rating: {$network_rating}<br />
									ArrowInTheKnee Rating:
									");
									if($avg < 0){
										print("not yet ready<br />");
									}else{
										print("{$avg}<br />");
									}

					 print("Release Date: {$release_date}<br />
	                Developer: {$developer}<br />
									Themes: ");


									while($row = mysqli_fetch_array($res_themes, MYSQLI_NUM)){
										print("{$row[0]} ");
									}
									print('<br />');

print("
									Genres: ");


									while($row = mysqli_fetch_array($res_genres, MYSQLI_NUM)){
										print("{$row[0]} ");
									}
									print('<br />');

print("
	              </div>
	              <div class='mdl-card__actions mdl-card--border'>

								<table>
								<tr>
								<td>
								<a href='{$website}' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--indigo-900 mdl-color-text--accent-contrast'>Learn More</a></br>
								</td>
								<td>
								<form action='add_like.php' method='POST' enctype='multipart/form-data'>
										<input type='text' name='email' value='{$email}' style='display: none'>
										<input type='text' name='name' value='{$name}' style='display: none'>
									<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Add to Favorite'>
								</form>
								</td>
								</tr>
								</table>
	              </div>

	          </div>
	        </div>
				</div>
			</div>
			<a href='https://github.com/LongIslandWithoutIceTea/ArrowInTheKnee' target='_blank' id='view-source' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast'>View on Github</a>
			<script src='https://code.getmdl.io/1.3.0/material.min.js'></script>
			<script src='js/slideshow.js'></script>
		</body>
	</html>




	");

	mysql_close($conn);
?>
