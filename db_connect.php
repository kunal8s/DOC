<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "kunal";


$conn = mysqli_connect($server, $username, $password, $database);

if(!$conn) {
  die("Error Occured". mysqli_connect_error());
}

?>