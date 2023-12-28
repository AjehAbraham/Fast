<?php
  
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Main\Error");
    exit;
}



$servername = "localhost";
$username = "root";
$password = "";
$database_name = "Fastshop_db";


$conn = mysqli_connect($servername,$username,$password,$database_name);

if (!$conn){

    die("Server Error");

}else{

   /* echo "connected sucessfully";*/
   
}


?>

