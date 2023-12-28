<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_SESSION["cart_items"]) && !empty($_SESSION["cart_items"])){

$DataDOG = count($_SESSION["cart_items"]);

die("(".$DataDOG.")");


        }else{


            if(isset($_COOKIE["cart-items"])){


                //CHECK IF USER HAS SAVED ITEM IN OUT DATABASE//
        
                $SessionID = htmlspecialchars($_COOKIE["cart-items"]);
                $SessionID = trim($SessionID);
        
        
                require_once "database_connection.php";
        
                $SessionID = mysqli_real_escape_string($conn,$SessionID);
        
                $select = "SELECT * FROM Save_cart_items WHERE User_id='$SessionID'  AND Status=NULL";
        
                $Result = mysqli_query($conn,$select);

if(mysqli_num_rows($Result) > 0){

    $DataDOG = mysqli_num_rows($Result);
    die("(".$DataDOG.")");
}else{

    die("(0)");
}
            }

        }
 
die("(0)");
}else{


    die("");
}

