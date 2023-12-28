<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if($_SERVER["REQUEST_METHOD"] =="POST"){


if(!isset($_POST["search-bar"]) && empty($_POST["search-bar"])){


die("<b style='color: red; text-align: center;'>Search is empty,please enter search.</b>");



}else{



    $search = filter_var($_POST["search-bar"],FILTER_SANITIZE_STRING);


    $search = htmlspecialchars($search);



if(strlen($search) < 3){

die("<b style='color: red; text-align: center;'>Search too short,must be at least four word.</b>");



}else{



require_once "database_connection.php";


$search = mysqli_real_escape_string($conn,$search);
$search = stripslashes($search);
$search = htmlspecialchars($search);
$search = preg_replace("/[^A-Za-z0-9. -]/", ' ',$search);


$search = stripcslashes($search);

$fetch_search = "SELECT * FROM Items_product_table WHERE
 Product_name LIKE '%$search%' OR  Product_name ='$search' ORDER BY id DESC";

$search_result = mysqli_query($conn,$fetch_search);

if(mysqli_num_rows($search_result) > 0){


while(
    $items = mysqli_fetch_assoc($search_result)){

        $product_name =    $items["Product_name"];

        $product_price = "₦". number_format($items["Product_price"]). ".00";

        $product_image = "Admin/items-image/" . $items["Product_image"];

        $items_hash = $items["Hash_id"];
        $rand = rand();
echo " 
<div class='items-container'>
<a href='view-items?Item_id=$items[Hash_id]'>
<img src=' $product_image' width='120px'>
<br>
<b>$product_price</b>
<br>
<b>$product_name</b><br>
</a>
<form id='$items[Hash_id]' class='FormData'><input type='text' value='$items_hash' name='Ray_id' style='display: none;'>
<input type='text' value='$items[id]' name='cart-item'  style='display: none;' >

<input type='submit' value='Add to cart' ></form></div><br>
";

    }



}else{


die("<b style='color: red; text-align: center;'>No result found for ". $search."</b>");

    
}






}






}


}else{


header("Location: Error");
exit;



}

