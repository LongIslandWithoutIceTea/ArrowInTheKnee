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
	$query = "DELETE FROM User WHERE email = '{$email}'";
	$res = mysqli_query($conn, $query);
    $query = "DELETE FROM friend_with WHERE email1 = '{$email}' OR email2 = '{$email}'";
    $res = mysqli_query($conn, $query);
    $query = "DELETE FROM likes WHERE email = '{$email}'";
	$res = mysqli_query($conn, $query);
	$query = "DELETE FROM Comments WHERE email = '{$email}'";
	$res = mysqli_query($conn, $query);
	mysql_close($conn);
	header("location: index.html");
	exit;
?>
