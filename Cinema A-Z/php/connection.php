<?php

/**
 * It connects to the DB by parsing 
 * Username,password of localhost
 */
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_sample_db";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)) {
	die("failed to connect!"); 
}
?>