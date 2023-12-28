<?php
require_once "sessionPage.php";



if($_SERVER["REQUEST_METHOD"] == "GET"){

    header("Location: Error");
    exit;
}else if ($_SERVER["REQUEST_METHOD"] == "POST"){


die("Payment Providers are currently unavliable at the moment,please try again shortly");



}else{



    header("Location: Error");
    exit;
}