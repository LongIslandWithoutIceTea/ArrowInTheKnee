<?php
$db_name = "arrowintheknee_GO";
$mysql_username = "arrowintheknee_yw3";
$mysql_password = "Ab971118";
$server_name = "arrowintheknee.web.engr.illinois.edu";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
if($conn->connect_error) {
    die("connection error");
}

$email1 = $_POST["email1"];
$email2 = $_POST["email2"];

$mysql_qry = "INSERT INTO friend_with (email1, email2) VALUES ('$email1', '$email2')";
if($conn->query($mysql_qry) === TRUE) {
    echo "Success";
}
else {
    echo "Fail";
}
$conn->close;
?>