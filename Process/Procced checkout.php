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

if(isset($_POST["checkout"]) && !empty($_POST["checkout"])){


$checkout = filter_var($_POST["checkout"],FILTER_SANITIZE_STRING);

if($checkout == "procced"){

    if(isset($_SESSION["cart_items"]) && !empty($_SESSION["cart_items"])){


die("ok");




}else{

    if(isset($_COOKIE["cart-items"]) && !empty($_COOKIE["cart-items"])){


        $seeisonID = htmlspecialchars($_COOKIE["cart-items"]);

        $_SESSION = trim($seeisonID);
        require_once "database_connection.php";

        $select = "SELECT * FROM Save_cart_items WHERE User_id='$seeisonID' AND Status=NULL OR Status=''";

        $Result = mysqli_query($conn,$select);

        if(mysqli_num_rows($Result) > 0){


die("ok");

        }else{

            die("Your cart is empty");
        }

    }


    die("<b style='color: red;'>Cart it empty,Please select an items to procced.</b>");




}







}else{


die("<b style='color: red;'>Cart it empty</b>");


}






}else{

//FROM HAS BEEN EDITED//




}




}


