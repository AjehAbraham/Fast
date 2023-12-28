<?php
session_start();
if(isset($_SESSION["cart_items"]) && !empty($_SESSION["cart_items"])){


if(isset($_POST["cartID"])){

    $cartID = htmlspecialchars($_POST["cartID"]);

    
    if(array_search($cartID,array_column($_SESSION["cart_items"],'Product_id')) !== FALSE){
        //ITEM EXIST IN SESSION CART//
            $Key = array_search($cartID,array_column($_SESSION["cart_items"],'Product_id'));


          //  $keys = $_SESSION["cart_items"][$Key];

if($Key == 0){

   // unset($_SESSION["cart_items"]);
   $count = count($_SESSION["cart_items"]);

   if($count <= 1){

    unset($_SESSION["cart_items"]);

   }

}else{
            
     unset($_SESSION["cart_items"][$Key]);

}

            if(isset($_COOKIE["cart-items"])){

                $sessionID = htmlspecialchars($_COOKIE["cart-items"]);

                require_once "database_connection.php";

                $update = "UPDATE Save_cart_items SET Status='clear' WHERE User_id='$sessionID' AND Product_id='$cartID' ";

                if(mysqli_query($conn,$update)){



                }else{

                    die("Error cocured updating cart");

                }
            }

die("success");

    }else{
//ITEM DPES NOT EXIST IN ARRAY//

        die("Error compeleting request");
    }
    



}else{

    die("Unknown request");

}


}