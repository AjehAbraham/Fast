<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

header("Location: Error");
exit;


}else if($_SERVER["REQUEST_METHOD"] == "GET"){


if(isset($_GET["key"])){

if(empty($_GET["key"])){

header("Location: Error");
exit;



}else{


    $key = htmlspecialchars($_GET["key"]);



require_once "db_connection.php";


$key = mysqli_real_escape_string($conn,$key);

$key  = stripcslashes($key);



$fetch = "SELECT * FROM Admin_Register_Temp WHERE Hash_id ='$key' AND NOW() <= 
DATE_ADD(Date,INTERVAL 30 MINUTE)";


$data = mysqli_query($conn,$fetch);

if(mysqli_num_rows($data) > 0){

$data_result = mysqli_fetch_assoc($data);

session_start();

session_regenerate_id();

$_SESSION["Log_hash"] = $data_result["Hash_id"];

$email = $data_result["Email"];

require_once "Complete-Admin-reg.php";

exit;


}else{

echo "<p style='color: red; text-align: center;'>Your link appears to have expired or is not valid.</p>";


}



}



mysqli_close($conn);


}else{



header("Location: Error");
exit;

}





}else{


header("Location: Error");
exit;

}