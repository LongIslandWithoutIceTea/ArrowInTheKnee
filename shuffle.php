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

$random_q = "select name, graph from Game where name not in (select name from likes where email = '{$email}') order by rand() limit 6";
$result = mysqli_query($conn, $random_q);
$random = array();
while ($row = mysqli_fetch_assoc($result)) $random[] = $row;


$query = "select * from User where email = '{$email}'";
if ($conn->query($query)->num_rows !== 0) {
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($res, MYSQLI_NUM);
    $password = $row[1];
    $username = $row[2];
    $avatar = $row[3];
}

//print($email);
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
            .zebra td, .zebra th {
            padding: 10px;
            border-bottom: 1px solid #f2f2f2;
        }

        .zebra tbody tr:nth-child(even) {
            background: #f5f5f5;
            -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;
            -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;
            box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;
        }

        .zebra th {
            text-align: left;
            text-shadow: 0 1px 0 rgba(255,255,255,.5);
            border-bottom: 1px solid #ccc;
            background-color: #eee;
            background-image: -webkit-gradient(linear, left top, left bottom, from(#f5f5f5), to(#eee));
            background-image: -webkit-linear-gradient(top, #f5f5f5, #eee);
            background-image:    -moz-linear-gradient(top, #f5f5f5, #eee);
            background-image:     -ms-linear-gradient(top, #f5f5f5, #eee);
            background-image:      -o-linear-gradient(top, #f5f5f5, #eee);
            background-image:         linear-gradient(top, #f5f5f5, #eee);
        }

        .zebra th:first-child {
            -moz-border-radius: 6px 0 0 0;
            -webkit-border-radius: 6px 0 0 0;
            border-radius: 6px 0 0 0;
        }

        .zebra th:last-child {
            -moz-border-radius: 0 6px 0 0;
            -webkit-border-radius: 0 6px 0 0;
            border-radius: 0 6px 0 0;
        }

        .zebra th:only-child{
            -moz-border-radius: 6px 6px 0 0;
            -webkit-border-radius: 6px 6px 0 0;
            border-radius: 6px 6px 0 0;
        }

        .zebra tfoot td {
            border-bottom: 0;
            border-top: 1px solid #fff;
            background-color: #f1f1f1;
        }

        .zebra tfoot td:first-child {
            -moz-border-radius: 0 0 0 6px;
            -webkit-border-radius: 0 0 0 6px;
            border-radius: 0 0 0 6px;
        }

        .zebra tfoot td:last-child {
            -moz-border-radius: 0 0 6px 0;
            -webkit-border-radius: 0 0 6px 0;
            border-radius: 0 0 6px 0;
        }

        .zebra tfoot td:only-child{
            -moz-border-radius: 0 0 6px 6px;
            -webkit-border-radius: 0 0 6px 6px
            border-radius: 0 0 6px 6px
        }
            </style>
          </head>
          <body>
            <div class='demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header'>
              <header class='demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600'>
                <div class='mdl-layout__header-row'>
                  <span class='mdl-layout-title'>SHUFFLE!</span>
                  <div class='mdl-layout-spacer'></div>

									<form action='explore_as_user1.php' method='POST' enctype='multipart/form-data'>
											<input type='text' name='email' value='{$email}' style='display: none'></p>
										<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='search'>
									</form>

                </div>
              </header>
              <div class='demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50'>
                <header class='demo-drawer-header'>
                  <img src='{$avatar}' class='demo-avatar'>
                  <div class='demo-avatar-dropdown'>
                    <span>{$email}</span>
                    <div class='mdl-layout-spacer'></div>
										<form action='sign_in.php' method='POST' enctype='multipart/form-data'>
												<input type='text' name='email' value='{$email}' style='display: none'>
												<input type='text' name='password' value='{$password}' style='display: none'>
											<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--grey-100 mdl-color-text--accent-contrast' type='submit' value='Back to Profile'>
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
<div class='demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid'>
	<table class=\"zebra\" style='width:500px'>
<thead>
<tr>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th></th>

</tr>
</thead>
<tbody>
<tr>

    ");
    for ($i = 0; $i < 6; $i++) {
        print("<td>{$random[$i]['name']}</td>");
    }
    print("</tr><tr>");
    for ($i = 0; $i < 6; $i++) {
        print("<td><img src={$random[$i]['graph']} height='150' width='105'/></td>");
    }
    print("</tr><tr>");
    for ($i = 0; $i < 6; $i++) {
        print("
				<td width='70'>
				<form action='add_like_from_shuffle.php' method='POST' enctype='multipart/form-data'>
						<input type='text' name='email' value='{$email}' style='display: none'>
						<input type='text' name='name' value='{$random[$i]['name']}' style='display: none'>
					<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Add+'>
				</form>
				</td>");
    }

    print("
</tr>
</tbody>
</table>
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


?>
