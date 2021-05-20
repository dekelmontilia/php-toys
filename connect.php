<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "toys_project";


$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_error()) {

  die("cant connect");
}

$conn->query("SET NAMES 'utf8'");

