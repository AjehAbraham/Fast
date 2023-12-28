<?php


   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

header('HTTP/1.0 403 Forbiddden',TRUE,403);
die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



$servername = "localhost";
$username = "root";
$password = "";
$database_name = "Fastshop_db";


$conn = mysqli_connect($servername,$username,$password,$database_name);

if (!$conn){

    die("error". mysqli_connect_error());
}else{
   /* echo "connected sucessfully";*/
}

