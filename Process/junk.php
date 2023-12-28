<?php
session_start();
   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

}



if ($_SERVER["REQUEST_METHOD"] == "POST"){
$cart_id = $hash_id ="";


if(isset($_POST["Ray_id"])){


    if(isset($_POST["cart-item"])){


        $cart_id = (int) filter_var($_POST["cart-item"],FILTER_VALIDATE_INT);

    $hash_id = htmlspecialchars($_POST["Ray_id"]);

if(empty($hash_id)){


    if(empty($cart_id)){



die("Invalid request");


    }


}


$date = htmlspecialchars(date("Y/m/d H:i:s"));
$time = htmlspecialchars(date("H:i:s"));
$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);
//$User_agent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);
$session_id = session_id();




$isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"tablet"));


$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"mobile"));



$isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"windows"));


$isAndriod = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"andriod"));


$isIphone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"iphone"));


$isIpad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"ipad"));


$isIos= $isIpad || $isIphone;



if($isMob){

if($isTab){

    $agent = "Tablet";

}else{


    $agent = "Mobile";
}

}else{

    $agent = "Desktop";
}

if($isIos){

    $user_agent = $agent. " Iphone IOS";
}else if($isAndriod){

$user_agent = $agent . " Andriod";

}else{

$user_agent = $agent. " Windows";

}





require_once "database_connection.php";


$fetch_item = "SELECT * FROM Items_product_table WHERE Hash_id='$hash_id' AND id='$cart_id'";



$result = mysqli_query($conn,$fetch_item);


if(mysqli_num_rows($result) > 0){

//ITEM FOUND IN DATABASE//

$results = mysqli_fetch_assoc($result);

$product_id = $results["id"];

$product_name = $results["Product_name"];

$product_price = $results["Product_price"];

$product_image = $results["Product_image"];
$product_quantity = "1";
//SET COOKIE TO SAVE CART USING UNIQUE ID AND THEN SAVING IT TO DATABASE FOR 1WEEK

//CHECK IF COOKIE EXITS ELSE CREATE COOKIE,iF COOKIE EXITS YOU CAN FETCH COOKIE VALUE AND USE TO INSERT TO DATABASE//


if(!isset($_COOKIE["cart-items"])){

$cookieName = "cart-items";

$cookieValue = uniqid(). rand(12093,128643);

setcookie($cookieName,$cookieValue, time() + 86400 * 7,"/");

}else{

$cookieValue = htmlspecialchars($_COOKIE["cart-items"]);

$cookieValue = mysqli_real_escape_string($conn,$cookieValue);
$cookieValue = trim($cookieValue);

}


//CHECK IF ITEM EXITS IN DATABASE AND HAS NOT BEEN CLEARED //
$check = "SELECT * FROM Save_cart_items WHERE Product_id='$cart_id' AND 
User_id='$cookieValue'  AND Status !='clear'";

$Result = mysqli_query($conn,$check);

if(mysqli_num_rows($Result) > 0){

    $position = mysqli_fetch_assoc($Result);

    $loger = $position["id"];

}else{

    $loger = "0";
    //INSERT TO DATABASE AND SAVE FOR USER//
    
$insert = "INSERT INTO Save_cart_items(User_id,Item_name,Item_price,Quantity,
Product_id,Product_image,Status,Date,Time,User_agent,Ip)

VALUES('$cookieValue','$product_name','$product_price','$product_quantity',
'$product_id','$product_image','','$date','$time','$user_agent','$ip')
";

if(mysqli_query($conn,$insert)){


}else{

    die("Error occured,please try again");
}


}


//unset($_SESSION["cart_items"]);
if(isset($_SESSION["cart_items"])){


    foreach($_SESSION['cart_items'] as $x => $x_value){
        
if(array_search($cart_id,array_column($_SESSION["cart_items"],'Product_id')) !== FALSE){

    $Key = array_search($cart_id,array_column($_SESSION["cart_items"],'Product_id'));

$OriginalArray = $_SESSION["cart_items"][$Key];

$Quantity = $OriginalArray["Product_quantity"];

$Quantity++;

$Quantity = (int) $Quantity;

$NewPrice =(int) $product_price * $Quantity;

    $NewWuantity = array("Product_id" => $product_id,"Product_name" => $product_name,"Product_price" => $NewPrice,

    "Product_quantity" => $Quantity,"Product_image" => $product_image);



if(isset($_COOKIE["cart-items"]) or $_SESSION["User"]){


    $sessionID = htmlspecialchars($_COOKIE["cart-items"]);
    if($loger >= 1){

$update = "UPDATE Save_cart_items SET Quantity='$Quantity',Item_price='$NewPrice' WHERE id='$position[id]'
 AND Status !='clear' AND Product_id='$cart_id' AND User_id='$cookieValue'";

if(mysqli_query($conn,$update)){

   // DO NOTHING


}else{


    //DO NOTHING
}
    }

}else{

    //DO NOTHING
}


   $_SESSION["cart_items"][$Key] = $NewWuantity;

    print_r($NewWuantity ). "    <br>";


    die("ok");


}else{

    //die("Not found");

}


    }



$product_id = $results["id"];

$product_name = $results["Product_name"];

$product_price = $results["Product_price"];

$product_image = $results["Product_image"];
$product_quantity = "1";


$items = array("Product_id" => $product_id,"Product_name" => $product_name,"Product_price" => $product_price,

"Product_quantity" => $product_quantity,"Product_image" => $product_image);

$item = array_push($_SESSION["cart_items"],$items);


//CHECK IF COOKIE EXITS ELSE CREATE COOKIE,iF COOKIE EXITS YOU CAN FETCH COOKIE VALUE AND USE TO INSERT TO DATABASE//

//CHECK IF COOKIE EXITS ELSE CREATE COOKIE,iF COOKIE EXITS YOU CAN FETCH COOKIE VALUE AND USE TO INSERT TO DATABASE//


if(!isset($_COOKIE["cart-items"])){

 
    $cookieName = "cart-items";
$cookieValue = uniqid(). rand(12093,128643);

setcookie($cookieName,$cookieValue, time() + 86400 * 7,"/");

}else{

$cookieValue = htmlspecialchars($_COOKIE["cart-items"]);

$cookieValue = mysqli_real_escape_string($conn,$cookieValue);
$cookieValue = trim($cookieValue);

}
    //INSERT TO DATABASE AND SAVE FOR USER//
    
    $insert = "INSERT INTO Save_cart_items(User_id,Item_name,Item_price,Quantity,
    Product_id,Product_image,Status,Date,Time,User_agent,Ip)
    
    VALUES('$cookieValue','$product_name','$product_price','$product_quantity',
    '$product_id','$product_image','','$date','$time','$user_agent','$ip')
    ";
    
    if(mysqli_query($conn,$insert)){
    
    
    }else{
    
        die("Error occured,please try again");
    }
    

die("really");
die("success");

}else{


    $product_id = $results["id"];

    $product_name = $results["Product_name"];
    
    $product_price = $results["Product_price"];
    
    $product_image = $results["Product_image"];
    $product_quantity = "1";


    $_SESSION["cart_items"] = array(array("Product_id" => $product_id,"Product_name" => $product_name,"Product_price" => $product_price,

    "Product_quantity" => $product_quantity,"Product_image" => $product_image));


//CHECK IF COOKIE EXITS ELSE CREATE COOKIE,iF COOKIE EXITS YOU CAN FETCH COOKIE VALUE AND USE TO INSERT TO DATABASE//


if(!isset($_COOKIE["cart-items"])){

    $cookieName = "cart-items";

    $cookieValue = uniqid(). rand(12093,128643);

setcookie($cookieName,$cookieValue, time() + 86400 * 7,"/");

}else{

$cookieValue = htmlspecialchars($_COOKIE["cart-items"]);

$cookieValue = mysqli_real_escape_string($conn,$cookieValue);
$cookieValue = trim($cookieValue);

}
//CHECK IF ITEM EXITS IN DATABASE AND HAS NOT BEEN CLEARED //
$check = "SELECT * FROM Save_cart_items WHERE User_id='$cookieValue' 
 AND Product_id='$cart_id' AND Status=Null or Status !='clear'";

$Result = mysqli_query($conn,$check);

if(mysqli_num_rows($Result) > 0){

    $position = mysqli_fetch_assoc($Result);

    $loger = $position["id"];



    
}else{

    $loger = "0";
    //INSERT TO DATABASE AND SAVE FOR USER//
    
$insert = "INSERT INTO Save_cart_items(User_id,Item_name,Item_price,Quantity,
Product_id,Product_image,Status,Date,Time,User_agent,Ip)

VALUES('$cookieValue','$product_name','$product_price','$product_quantity',
'$product_id','$product_image','','$date','$time','$user_agent','$ip')
";

if(mysqli_query($conn,$insert)){


}else{

    die("Error occured,please try again");
}


}
die("Yehhh");
die("success");

}




}






}





    }
    




}






?>