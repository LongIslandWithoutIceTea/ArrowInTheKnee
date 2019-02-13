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

	$query = "SELECT * FROM User WHERE email = '{$email}'";
	$res = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($res, MYSQLI_NUM);
	$password = $row[1];
	$username = $row[2];
	$avatar = $row[3];

	print("
	<!doctype html>
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
			#wrapper {
				display: table;
			}

			#search_box {
				display: table-cell;
				vertical-align: middle;
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
	<div id='wrapper'>
				<div id='search_box' align='center'>
					 <form action='explore_as_user2.php' method='POST' enctype='multipart/form-data'>
						 <input type='text' name='email' value='{$email}' style='display: none'>
						 <div>
							 <p></p>
							 <span class='mdl-typography--font-light mdl-typography--subhead'>Name</span>
							 <input type='text' name='query_name'>
							 <p></p>
						 </div>
						 <div>
							 <p></p>
							 <span class='mdl-typography--font-light mdl-typography--subhead'>Developer</span>
							 <input type='text' name='query_developer'>
							 <p></p>
						 </div>
						 <div>
							 <p></p>
							 <span class='mdl-typography--font-light mdl-typography--subhead'>Genre</span>
							 <select name='genre'>
	    			 			<option value='Adventure'>Adventure</option>
	    	 					<option value='Role-playing(RPG)'>RPG</option>
	    						<option value='Shooter'>Shooter</option>
									<option value='Puzzle'>Puzzle</option>
									<option value='Tactical'>Tactical</option>
									<option value='Plaform'>Plaform</option>
									<option value='Pinball'>Pinball</option>
									<option value='Sport'>Sport</option>
									<option value='Simulator'>Simulator</option>
									<option value='Racing'>Racing</option>
									<option value='Point-and-click'>Point-and-click</option>
									<option value='Strategy'>Strategy</option>
									<option value='Indie'>Indie</option>
									<option value='Turn-based stratehy(TBS)'>TBS</option>
									<option value='Fighting'>Fighting</option>
									<option value='Real Time Strategy(RTS)'>RTS</option>
									<option value='Arcade'>Arcade</option>
									<option value='Hack and slash/Beat 'em up'>Beat 'em up</option>
	  					</select>
							 <p></p>
						 </div>
						 <div>
							 <p></p>
							 <span class='mdl-typography--font-light mdl-typography--subhead'>Theme</span>
							 <select name='theme'>
	    			 			<option value='Action'>Action</option>
	    	 					<option value='Fantasy'>Fantasy</option>
									<option value='Historical'>Historical</option>
									<option value='Open world'>Open World</option>
									<option value='Science Fiction'></option>
									<option value='Horror'>Horror</option>
									<option value='Stealth'>Stealth</option>
									<option value='Survival'>Survival</option>
									<option value='Drama'>Drama</option>
									<option value='Mystery'>Mystery</option>
									<option value='Sandbox'>Sandbox</option>
									<option value='Comedy'>Comedy</option>
									<option value='Thriller'>Thriller</option>
									<option value='Warfare'>Warfare</option>
									<option value='Non-fiction'>Non-fiction</option>
							</select>
							 <p></p>
						 </div>
						 <div>
							 <p></p>
							 <span class='mdl-typography--font-light mdl-typography--subhead'>Min Rating(0-100)</span>
							 <input type='text' name='query_rating'>
							 <p></p>
						 </div>
						 <p></p>
						 <input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Search'>
					 </form>
				</div>
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

	mysql_close($conn);
?>
