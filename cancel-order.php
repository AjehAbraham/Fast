<?php
session_start();

if(isset($_SESSION["cart_items"]) && !empty($_SESSION["cart_items"])){


unset($_SESSION["cart_items"]);

}

if(isset($_COOKIE["cart-items"])){
  
    setcookie("cart-items","", time() - 86400 * 7,"/");


}
header("Location: home");
exit;

?>