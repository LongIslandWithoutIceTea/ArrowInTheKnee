<?php
$db_name = "arrowintheknee_GO";
$mysql_username = "arrowintheknee_yw3";
$mysql_password = "Ab971118";
$server_name = "arrowintheknee.web.engr.illinois.edu";
$conn = new mysqli($server_name, $mysql_username, $mysql_password, $db_name);
if($conn->connect_error) {
    die("connection error");
}
$name = $_POST["name"];
$mysql_qry = "select * from Game where name = '$name'";
$result = mysqli_query($conn, $mysql_qry) or die("query not executed");
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data_array = $row;
    }
    print(json_encode($data_array));
}
else {
    print("bad query");
}
$conn->close;
?>