<?php
$db_name = "arrowintheknee_GO";
$mysql_username = "arrowintheknee_yw3";
$mysql_password = "Ab971118";
$server_name = "arrowintheknee.web.engr.illinois.edu";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
if($conn->connect_error) {
    die("connection error");
}

$email = $_POST["email"];
$password = $_POST["password"];
$username = $_POST["email"];

$mysql_qry = "INSERT INTO User (email, password, username) VALUES ('$email', '$password', '$username')";
if($conn->query($mysql_qry) === TRUE) {
    echo "Success";
}
else {
    echo "Fail";
}
$conn->close;
?>