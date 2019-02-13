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
$CID = $_POST["CID"];
$name = $_POST["name"];
$score = $_POST["score"];
$content = $_POST["content"];

$mysql_qry = "Insert INTO Comments (email, games, CID, score, content) VALUES ('$email', '$name', '$CID', '$score', '$content')";
$result = mysqli_query($conn, $mysql_qry) or die("query not executed");
if($result->num_rows > 0) {
    print("Success");
}
else {
    print("insert fail");
}
$conn->close;
?>