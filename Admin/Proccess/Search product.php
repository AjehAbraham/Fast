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


if(isset($_POST["Items"])){


if(empty($_POST["Items"])){



    die("Please enter item ID or Item name or User ID");

}else{



$item_ID = htmlspecialchars($_POST["Items"]);


$item_ID = stripcslashes($item_ID);

require_once "db_connection.php";

$item_ID = mysqli_real_escape_string($conn,$item_ID);


$fetch_item = "SELECT * FROM Items_product_table WHERE Hash_id ='$item_ID' OR id='$item_ID'";


$item_result = mysqli_query($conn,$fetch_item);


if(mysqli_num_rows($item_result) > 0){


//ITEMS HAS BEEN FOUND//

$item = mysqli_fetch_assoc($item_result);

$price ="₦". number_format($item["Product_price"]).".00";

$name = $item["Product_name"];

$hash_id = $item["Hash_id"];

$imageURL = "Items-image/". $item["Product_image"];



echo "

<div class='form-container-box'>

<p><img src='$imageURL' ></p>

<b>$name </b><br>
<b>$price</b><br>
<b>Rating <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> 
(600)</b><br>

<b>Total Purchase: 10</b>
<br>
<b>Failed Purchase: 2</b><br>
<b>Owner id: $item[Admin_id].Admin Status: . <br>Item ID: $hash_id<i class='fa fa-copy' style='cursor: pointer;'></i></b>

<br>
<br>
<p class='Edit-btn'><a href='Edit product?name=$hash_id'>Edit Item <i class='fa fa-edit'></i>
</a></p><br>
</div>

";


}else{



//ITEM WAS NOT FOUND TRY FETCHING ITEM USING THE PRODUCT NAME OR USER ID//

$fetch = "SELECT * FROM Items_product_table WHERE Product_name LIKE '%$item_ID%' OR Admin_id='$item_ID'";



$item_result = mysqli_query($conn,$fetch);

if(mysqli_num_rows($item_result) > 0){


//USE A WHILE LOOP HERE JUST INCASE THEY SERACH FOR ITEM USING USER ID SO IT WILL SHOW ALL THE USER ITEMS//
while($item = mysqli_fetch_assoc($item_result)){

    $price ="₦". number_format($item["Product_price"]).".00";
    
    $name = $item["Product_name"];
    
    $hash_id = $item["Hash_id"];
    
    $imageURL = "Items-image/". $item["Product_image"];
    
    
    
    echo "
    
    <div class='form-container-box'>
    
    <p><img src='$imageURL' ></p>
    
    <b>$name </b><br>
    <b>$price</b><br>
    <b>Rating <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> 
    (600)</b><br>
    
    <b>Total Purchase: 10</b>
    <br>
    <b>Failed Purchase: 2</b><br>
    <b>Owner id: $item[Admin_id].Admin Status: . <br>Item ID: $hash_id<i class='fa fa-copy' style='cursor: pointer;'></i></b>
    
    <br>
    <br>
    <p class='Edit-btn'><a href='Edit product?name=$hash_id'>Edit Item <i class='fa fa-edit'></i>
    </a></p><br>
    </div><br>
    
    ";




    }


}else{



    die("Item cannot be found please try Re-searching with another info");
}



}

}


    
}else{



    die("Invalid request type");
}



}else{



    header("Location: Error");
    exit;
}





