<?php
$server = "localhost";
$username = "root";
$passwprd = "";
$database = "users";
$conn = mysqli_connect($server, $username, $passwprd, $database);
if($conn){
    //echo "data base connected successfully";
}
else{
    die("failed to connect".mysqli_connect_error());
}


?>