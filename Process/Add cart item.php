<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){


    if(isset($_POST["Ray_id"]) && !empty($_POST["Ray_id"])){

$hashID = htmlspecialchars($_POST["Ray_id"]);
$hashID = trim($hashID);

    }else{

        die("Invalid request");
    }

if(isset($_POST["cart-item"]) && !empty($_POST["cart-item"])){

    $cartID = (int) filter_var($_POST["cart-item"],FILTER_VALIDATE_INT);

    $cartID = htmlspecialchars($cartID);

    $cartID = trim($cartID);
    
}else{


    die("Invalid request type");
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




//NOW SEARCH IF iTEMS EXIST IN DATABASE//

//require_once "database_connection.php";

$servername = "localhost";
$username = "root";
$password = "";
$database_name = "Fastshop_db";


$conn = mysqli_connect($servername,$username,$password,$database_name);

if (!$conn){

    die("error". mysqli_connect_error());
}else{
   /* echo "connected sucessfully";*/
}

$hashID = mysqli_real_escape_string($conn,$hashID);
$cartID = mysqli_real_escape_string($conn,$cartID);
//VERIFY ITEMS//

$verifyItem = "SELECT * FROM Items_product_table WHERE Hash_id='$hashID' AND id='$cartID'";

$ItemResult = mysqli_query($conn,$verifyItem);

if(mysqli_num_rows($ItemResult) > 0){

//ITEM WAS FOUND IN DATABASE//

//NOW CHECK IF SAVE ITEM COOKIE ACTAULL EXITS OF NOT//

$results = mysqli_fetch_assoc($ItemResult);

$product_id = $results["id"];

$product_name = $results["Product_name"];

$product_price = $results["Product_price"];

$product_image = $results["Product_image"];
$product_quantity = "1";


if(isset($_COOKIE["cart-items"])){
    //DO NOTHING BECAUSE COOKIE HAS BEEN SET
//FETCH COOKIE DATA/ID

$cookieValue = htmlspecialchars($_COOKIE["cart-items"]);
$cookieValue = trim($cookieValue);
$cookieValue = stripslashes($cookieValue);
$cookieValue = mysqli_real_escape_string($conn,$cookieValue);
}else{


    //COOKIE HAS NOT BEEN SET SO SET COOKIE

    $cookieName = "cart-items";
    $cookieValue =rand(194,4245). uniqid() . rand(12904,740123);
//SET COOKIE FOR AT LEAST ONE WEEK//
    setcookie($cookieName,$cookieValue, time() + 86400 * 7, "/");
}

//NOW CHECK IF ITEM ALREADY EXITS IN SESSION CART ITEMS//
if(isset($_SESSION["cart_items"]) && !empty($_SESSION["cart_items"])){
//SESSION CART EXIST ,NOW CHECK IF ITEM EXIST IN SESSION CART
//STARTING MY FOR LOOOP//
foreach($_SESSION['cart_items'] as $x => $x_value){
        
    if(array_search($cartID,array_column($_SESSION["cart_items"],'Product_id')) !== FALSE){
    //ITEM EXIST IN SESSION CART//
        $Key = array_search($cartID,array_column($_SESSION["cart_items"],'Product_id'));


        //NOW FETCH ITEMS FROM TEH LOOP KEY//

    $OldItems = $_SESSION["cart_items"][$Key];

//FETCH THE QUANTITY AND PRICE THEN INCREASE IT BY ONE ON EVERY REQUEST//

$newQuantity = (int) $OldItems["Product_quantity"];

$newQuantity++;

$OldPrice = (int) $product_price;

$NewPrice = $OldPrice * $newQuantity;

$NewItemArray = array("Product_id" => $product_id,"Product_name" => $product_name,"Product_price" => $NewPrice,

"Product_quantity" => $newQuantity,"Product_image" => $product_image);


//NOW ADD/REPLACE ARRAY WITH THE NEW DATAS 
$_SESSION["cart_items"][$Key] = $NewItemArray;


//NOW CHECK IF ITEMS EXITS IN DATABASE(SAVE CART ITEMS).THAT IS IF
// CART ITEM HAS  BEEN SAVED IN DATABASE WITH THIS COOKIE VALUE SO YOU CAN UPDATE IT

$select = "SELECT * FROM Save_cart_items WHERE User_id='$cookieValue' 
AND Product_id='$cartID' AND Status=NULL or Status !='clear'";

$checkerResult = mysqli_query($conn,$select);

if(mysqli_num_rows($checkerResult) > 0){

//ITEM WAS FOUND IN DATABASE SO UPDATE IT IN DATABASE// 

$ResultID = mysqli_fetch_assoc($checkerResult);

$update = "UPDATE Save_cart_items SET Item_price='$NewPrice',Quantity='$newQuantity' 
WHERE User_id='$cookieValue' AND Product_id='$cartID' AND Status=''";

if(mysqli_query($conn,$update)){


}else{


}

//print_r($NewItemArray);
die("ok");

}else{


    //ITEM WAS NOT FOUND IN DATABASE SO INSERT THE ITEMS //

//NOW INSERT ITEMS TO DATABASE//


$insert = "INSERT INTO Save_cart_items(User_id,Item_name,Item_price,Quantity,
Product_id,Product_image,Status,Date,Time,User_agent,Ip)

VALUES('$cookieValue','$product_name','$NewPrice','$newQuantity',
'$cartID','$product_image','','$date','$time','$user_agent','$ip')
";

if(mysqli_query($conn,$insert)){


}else{

    die("Error occured,please try again");
}



die("success");

}


    }else{

//ITEM DOES NOT EXIST IN SESSION_CART //

$items = array("Product_id" => $product_id,"Product_name" => $product_name,"Product_price" => $product_price,

"Product_quantity" => $product_quantity,"Product_image" => $product_image);

$item = array_push($_SESSION["cart_items"],$items);

$insert = "INSERT INTO Save_cart_items(User_id,Item_name,Item_price,Quantity,
Product_id,Product_image,Status,Date,Time,User_agent,Ip)

VALUES('$cookieValue','$product_name','$product_price','$product_quantity',
'$cartID','$product_image','','$date','$time','$user_agent','$ip')
";

if(mysqli_query($conn,$insert)){


}else{

    die("Error occured,please try again");
}

die("success");


    }

}
//END OF FOR LOOP

}else{


    //SESSION CART ITEMS DOES NOT EXITS//

//NOW ADD ITEM TO SESSION CART AND DATABASE//


//ITEM DOES NOT EXIST IN SESSION_CART //

$_SESSION["cart_items"]= [];

$items = array("Product_id" => $product_id,"Product_name" => $product_name,"Product_price" => $product_price,

"Product_quantity" => $product_quantity,"Product_image" => $product_image);

$item = array_push($_SESSION["cart_items"],$items);

//UPDATE DATABASE JUST INCASE THIS DATA EXIST IN DATABASE JUST TO BE SURE YOU'RE 
//NOT MAKING ERROR LIKE INSERTING SAME STUFF TWICE

$updates = "UPDATE Save_cart_items SET Status='clear' WHERE User_id='$cookieValue' AND Product_id='$product_id'";


$insert = "INSERT INTO Save_cart_items(User_id,Item_name,Item_price,Quantity,
Product_id,Product_image,Status,Date,Time,User_agent,Ip)

VALUES('$cookieValue','$product_name','$product_price','$product_quantity',
'$cartID','$product_image','','$date','$time','$user_agent','$ip')
";

if(mysqli_query($conn,$insert)){


}else{

    die("Error occured,please try again");
}

die("success");


}




}else{


    //ITEM COULD NOT BE FOUND IN DATABASE//

    die("Error couured fetching Item");

}


}else{


    header("Location: Error");
    exit;
}