<?php
$host = "silva.computing.dundee.ac.uk";
$username = "22ac3u10";
$password = "cba123";
$database = "22ac3d10";
$mysql = new PDO("mysql:host=" . $host . ";dbname=" . $database, $username, $password);
