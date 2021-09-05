<?php

//session started
session_start();


//Create constant for Non Repeating values
define('SITEURL','http://localhost/food_order/');//Create constant for home URL
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD)or die(mysqli_error());//Database Connection
$db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());//Selecting database

?>