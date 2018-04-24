<?php
$db_name = "arrowintheknee_GO";
$mysql_username = "arrowintheknee_yw3";
$mysql_password = "Ab971118";
$server_name = "arrowintheknee.web.engr.illinois.edu";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
if($conn->connect_error) {
    die("connection error");
}

$semail = $_POST["semail"];
$remail = $_POST["remail"];
$content = $_POST["content"];
$time = $_POST["time"];
$viewed = $_POST["viewed"];

$mysql_qry = "INSERT INTO Message(semail, remail, content, time, viewed) VALUES ('$semail', '$remail', '$content', '$time', '$viewed')";
if($conn->query($mysql_qry) === TRUE) {
    echo "Success";
}
else {
    echo "Fail";
}
$conn->close;
?>