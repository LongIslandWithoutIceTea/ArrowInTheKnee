<?php
/**
 * Created by PhpStorm.
 * User: cheng
 * Date: 2018/4/20
 * Time: 上午2:33
 */

/*-----------------------------------------------------------
This file is to find the recommended friend based on the number of games you both like.
$rcmd is the email of the recommended friend.
-------------------------------------------------------------*/

$servername = "arrowintheknee.web.engr.illinois.edu";
$username = "arrowintheknee_junkaicheng";
$password = "cjkdqzx129!";
$dbname = "arrowintheknee_GO";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$email = '123@';
$email = $_POST["email"];
//all the users
$users_q = "select email from User";
$result = mysqli_query($conn, $users_q);
$users = array();
while ($row = mysqli_fetch_assoc($result)) array_push($users, array_pop($row));

//all the friends
$friends_q = "select email2 from friend_with where email1 = '{$email}'";
$result = mysqli_query($conn, $friends_q);
$friends = array();
while ($row = mysqli_fetch_assoc($result)) array_push($friends, array_pop($row));

//games the current user likes
$game_like_q = "select name from likes where email = '{$email}'";
$result = mysqli_query($conn, $game_like_q);
$game_like = array();
while ($row = mysqli_fetch_assoc($result)) array_push($game_like, array_pop($row));

$common = array();
for ($i = 0; $i < count($users); $i++) {
    $value = 0;
    if ($users[$i] == $email || in_array($users[$i], $friends)) {
        array_push($common, 0);
        continue;
    }
    $sql = "select name from likes where email = '{$users[$i]}' ";
    $result = mysqli_query($conn, $sql);
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) array_push($arr, array_pop($row));
    for ($j = 0; $j < count($arr); $j++) {
        if (in_array($arr[$j], $game_like)) {
            $value++;
        }
    }
    array_push($common, $value);
}
$sort = $common;
natsort($sort);
end($sort);

//find strangers
$strangers_q = "select email from User where email <> '{$email}' and email NOT IN (SELECT email2 from friend_with where email1 = '{$email}')";
$result = mysqli_query($conn, $strangers_q);
$strangers = array();
while ($row = mysqli_fetch_assoc($result)) $strangers[]= array_pop($row);

//features
$features_q = "(select distinct genres from genre_of ) UNION  (select distinct themes from theme_of)";
$result = mysqli_query($conn, $features_q);
$features = array();
while ($row = mysqli_fetch_assoc($result)) array_push($features, array_pop($row));

$values = array();
for ($i = 0; $i < count($strangers); $i++) {
    $game_like_q = "select name from likes where email = '{$strangers[$i]}'";
    $result = mysqli_query($conn, $game_like_q);
    $game_like = array();
    while ($row = mysqli_fetch_assoc($result)) array_push($game_like, array_pop($row));


    $num_like = count($game_like);
    $sql = "(select genres from likes, genre_of where email = '{$strangers[$i]}' and name = games) UNION ALL (select themes from likes, theme_of where email = '{$strangers[$i]}' and name = games)";
    $result = mysqli_query($conn, $sql);
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) array_push($arr, array_pop($row));
    $count = array_count_values($arr);
    $n = count($count);
    $ratio = $count;
    for ($j = 0; $j < $n; $j++) {
        $ratio[key($ratio)] = $ratio[key($ratio)] / $num_like;
        next($ratio);
    }
    $values[] = $ratio;
}

$game_like_q = "select name from likes where email = '{$email}'";
$result = mysqli_query($conn, $game_like_q);
$game_like = array();
while ($row = mysqli_fetch_assoc($result)) array_push($game_like, array_pop($row));
$num_like = count($game_like);
$sql = "(select genres from likes, genre_of where email = '{$email}' and name = games) UNION ALL (select themes from likes, theme_of where email = '{$email}' and name = games)";
$result = mysqli_query($conn, $sql);
$arr = array();
while ($row = mysqli_fetch_assoc($result)) array_push($arr, array_pop($row));
$count = array_count_values($arr);
$n = count($count);
$ratio = $count;
for ($i = 0; $i < $n; $i++) {
    $ratio[key($ratio)] = $ratio[key($ratio)] / $num_like;
    next($ratio);
}

$difference = array();
for ($i = 0; $i < count($strangers); $i++) {
    $k = 0;
    for ($j = 0; $j < count($features); $j++){
        if (array_key_exists($features[$j], $values[$i]) && array_key_exists($features[$j], $ratio)){
            $k = $k + pow($ratio[$features[$j]]-$values[$i][key($ratio)],2);
        }
        elseif (array_key_exists($features[$j], $values[$i]) && !array_key_exists($features[$j], $ratio)){
            //$k = $k + pow($values[$i][key($ratio)],2);
            $k = $k + 1;
        }
        elseif (!array_key_exists($features[$j], $values[$i]) && array_key_exists($features[$j], $ratio)){
            //$k = $k + pow($ratio[$features[$j]],2);
            $k = $k + 1;
        }
    }
    /*
    for ($j = 0; $j < count($ratio); $j++){
        if (array_key_exists(key($ratio), $values[$i])){
            $k = $k + pow(current($ratio)-$values[$i][key($ratio)],2);
        }
        else $k = $k + pow(current($ratio),2);
        next($ratio);
    }
    reset($ratio);
    */
    $difference[]=$k;
}


$rcmd = $strangers[array_search(min($difference), $difference)];


$query = "select * from User where email = '{$email}'";
if ($conn->query($query)->num_rows !== 0) {
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($res, MYSQLI_NUM);
    $password = $row[1];
    $username = $row[2];
    $avatar = $row[3];
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
                  <span class='mdl-layout-title'>Friend Recommendation</span>
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
<h5>Based on same like</h5>
<div class='mdl-card__actions mdl-card--border'></div>
	<table class=\"zebra\" style='width:500px'>
<thead>
<tr>
<th>#</th>
<th></th>
<th>name</th>
<th></th>
<th>Add</th>

</tr>
</thead>
<tbody>
    ");
for ($i = 1; $i <= count($common) ; $i++) {
    if ($i == 11) break;
    if (current($sort) == 0) break;
    $r_name = $users[key($sort)];
    $r_num = current($sort);
    $avatar_r = "select avatar from User where email = '{$r_name}'";
    $curr_avatar = array_pop(mysqli_fetch_assoc(mysqli_query($conn, $avatar_r)));
    print("

		<tr>
				<td>{$i}</td>
				<td><img src={$curr_avatar} height=\"30\" width=\"30\"/></td>
				<td width='100'>{$r_name}</td>
				<td width='300'>You like {$r_num} same games.</td>
				<td width='70'>
				<form action='add_friend.php' method='POST' enctype='multipart/form-data'>
						<input type='text' name='email1' value='{$email}' style='display: none'>
						<input type='text' name='email2' value='{$r_name}' style='display: none'>
					<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Add+'>
				</form>
				</td>
		</tr>
		</tbody>
    ");

    prev($sort);
}

print("
</table>

</div>

<div class='demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid'>
<h5>Based on genre and theme</h5>
<div class='mdl-card__actions mdl-card--border'></div>
	<table class=\"zebra\" style='width:500px'>
<tbody>
    ");

$query = "SELECT * FROM User WHERE email = '{$rcmd}'";
$res = mysqli_query($conn, $query);
$row = mysqli_fetch_array($res, MYSQLI_NUM);

    print("

		<tr>
				<td><img src={$row[3]} height=\"30\" width=\"30\"/></td>
				<td width='100'>{$row[0]}</td>
				<td width='300'></td>
				<td width='70'>
				<form action='add_friend.php' method='POST' enctype='multipart/form-data'>
						<input type='text' name='email1' value='{$email}' style='display: none'>
						<input type='text' name='email2' value='{$rcmd}' style='display: none'>
					<input class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast' type='submit' value='Add+'>
				</form>
				</td>
		</tr>
		</tbody>
    ");

print("
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
