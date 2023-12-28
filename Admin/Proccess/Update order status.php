<?php
require_once "session.php";

   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

header('HTTP/1.0 403 Forbiddden',TRUE,403);
die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){




    if(isset($_POST["secert-key"]) && isset($_POST["order-ID"]) && isset($_POST["status"])){




if(empty($_POST["secert-key"])){


die("Please enter your secret key");

}else{


$secret_key = (int) filter_var($_POST["secert-key"]);


}



if(empty($_POST["order-ID"])){

die("Opp! something is missing");



}else{

$tracking_no = htmlspecialchars($_POST["order-ID"]);


}



if(empty($_POST["status"])){


die("Please enter Order status");



}else{

$order_status = filter_var($_POST["status"],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);


    $order_status = htmlspecialchars($order_status);
}



require_once "db_connection.php";


$order_status = stripslashes($order_status);

$tracking_no = stripcslashes($tracking_no);

$secret_key = stripcslashes($secret_key);


$order_status = mysqli_real_escape_string($conn,$order_status);

$secret_key = mysqli_real_escape_string($conn,$secret_key);

$tracking_no = mysqli_real_escape_string($conn,$tracking_no);



$admin_secrey_key = "SELECT * FROM Admin_Register_db WHERE id='$_SESSION[Admin_id]'";


$pin_result = mysqli_query($conn,$admin_secrey_key);


$admin_pin = mysqli_fetch_assoc($pin_result);



if(password_verify($secret_key,$admin_pin["Pin"]) == "password_hash"){


$update = "UPDATE Customer_orders SET Order_status='$order_status' WHERE Tracking_no='$tracking_no'";


if(mysqli_query($conn,$update)){


    die("success");
    
}else{


die("Fail to update order status");



}




}else{



die("Invalid Secret key");


}


$pickup_date = date("Y-m-d");

date_add($pickup_date,date_interval_create_from_date_string("4 days"));

$pickup_date = date_format($pickup_date,"Y-m-d");




    }else{



        die("Invalid request");
    }



}else{

    header("Location: Error");
    exit;
}