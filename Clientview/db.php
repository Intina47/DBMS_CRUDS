<?php
$host ="silva.computing.dundee.ac.uk";
$username = "22ac3u10";
$password = "cba123";
$database = "22ac3d10";

$mysql = mysqli_connect($host, $username, $password,$database);
if(mysqli_connect_errno()){
    printf("Sorry Unable to establish a connection with the database: %s\n", mysqli_connect_errno());
}
?>
