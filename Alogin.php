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
print($_POST["email"]);
$password = $_POST["password"];
print($_POST["password"]);
$mysql_qry = "select * from User where email = '$email' and password = '$password'";
$result = mysqli_query($conn, $mysql_qry) or die("query not executed");
if($result->num_rows > 0) {
    print("Success");
}
else {
    print("wrong username/password");
}
$conn->close;
?>