<?php
$db_name = "arrowintheknee_GO";
$mysql_username = "arrowintheknee_yw3";
$mysql_password = "Ab971118";
$server_name = "arrowintheknee.web.engr.illinois.edu";
$conn = new mysqli($server_name, $mysql_username, $mysql_password, $db_name);
if($conn->connect_error) {
    die("connection error");
}
$email = $_POST["email"];
$new_password = $_POST["password"];
$new_username = $_POST["username"];
$new_avatar = $_POST["avatar"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$other = $_POST["other_information"];
$mysql_qry = "UPDATE User SET password='$new_password', username='$new_username', avatar='$new_avatar', age = '$age', gender='$gender', other_information='$other' WHERE email='$email'";
$result = mysqli_query($conn, $mysql_qry) or die("query not executed");
if($conn->query($mysql_qry) === TRUE) {
    echo "Success";
}
else {
    echo "Fail";
}
$conn->close;
?>