<?php
session_start();
   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



if($_SERVER["REQUEST_METHOD"] == "POST"){

//CHECK IF COOKIE IS SET THEN DELETE ITEMS IN DATABASE OR UPDATE IT//

if(isset($_COOKIE["cart-items"])){



require_once  'database_connection.php';

$cookieValue = htmlspecialchars($_COOKIE["cart-items"]);

$cookieValue = trim($cookieValue);
$cookieValue = mysqli_real_escape_string($conn,$cookieValue);

$update = "UPDATE Save_cart_items SET Status='clear' WHERE User_id='$cookieValue'";

if(mysqli_query($conn,$update)){

    setcookie("cart-items","", time() - 86400 * 7,"/");
    
    if(isset($_SESSION["cart_items"])){

        unset($_SESSION["cart_items"]);
    }

    die("Cart has been cleared ");

}else{

    setcookie("cart-items","", time() - 86400 * 7,"/");
    
    if(isset($_SESSION["cart_items"])){

        unset($_SESSION["cart_items"]);
    }


    die("Error occured clearing your cart item(s),please try again");
}


}else{

    if(isset($_SESSION["cart_items"])){

        unset($_SESSION["cart_items"]);
    }


die("<b style='color: red;'>Your cart is empty already.</b>");

}



}




?>