<?php
require_once "sessionPage.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($_POST["Delivery_location"])){

if(empty($_POST["Delivery_location"])){


    die("<b style='color: red;'>Please select a location</b>");



}else{


$LGA = filter_var($_POST["Delivery_location"],FILTER_SANITIZE_STRING);

$LGA =htmlspecialchars($LGA);

    require_once "database_connection.php";


$fetch_LGA = "SELECT * FROM Delivery_LGA WHERE State='$LGA' AND Status='Avaliable'";


$results = mysqli_query($conn,$fetch_LGA);


if(mysqli_num_rows($results) > 0){

    echo "

    <select name='Location' onchange='fetch_delivery_point(event)'>
    
    <option></option>
    ";



while($lga = mysqli_fetch_assoc($results)){
    
    echo "<option>$lga[LGA]</option>
    ";
    
   




}




}else{



    die("<b style='color: red;'>No location found in ". $LGA. ".</b>");


}



}


}


//mysqli_close($conn);
}