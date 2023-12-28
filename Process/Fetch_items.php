<?php
session_start();
   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

}




if(isset($_SESSION["cart_items"])){


    if(!empty($_SESSION["cart_items"])){


     echo "
     
<table>
<tr>
 <th>Item Image</th>
 <th>Item Name</th>
 <th>Price</th>
 <th>Quantity</th>
 <th>Remove</th>
</tr>

     
     ";   

     
foreach($_SESSION['cart_items'] as $x => $x_value){

    //var_dump($x_value);

$product_name = $x_value["Product_name"];

$product_price ="₦". number_format($x_value["Product_price"]) .".00";

$product_quantity = $x_value["Product_quantity"];


$product_image ="Admin/items-image/" . $x_value["Product_image"];

$product_id = $x_value["Product_id"];





echo "

<tr> 
<td><img src='$product_image' width='120px'></td>
<td>$product_name  </td>
<td>$product_price</td>
<td>$product_quantity</td>
<td>
<form  id='$product_id' class='RemoveForm'><input type='number' 
style='display: none;' name='cartID' value='$product_id'>
<input type='submit' value='Remove Item'></form>
</td>
</tr>
";




$total_price += intval($x_value["Product_price"]);

}
echo "</table>

<p>Total Price: ₦". number_format($total_price). ".00 </p>

";
echo '
<p class="procced-checkout" onclick="Procced_checkout()">
<i class="fa fa-shield"></i> Procced to checkout</p>

<p class="clear-cart-items" onclick="clear_cart_items()"><i class="fa fa-minus">
</i> clear cart items</p>';





    }

}else{



    if(isset($_COOKIE["cart-items"]) && !empty($_COOKIE["cart-items"])){


        //CHECK IF USER HAS SAVED ITEM IN OUT DATABASE//

        $SessionID = htmlspecialchars($_COOKIE["cart-items"]);
        $SessionID = trim($SessionID);


        require_once "database_connection.php";

        $SessionID = mysqli_real_escape_string($conn,$SessionID);

        $select = "SELECT * FROM Save_cart_items WHERE User_id='$SessionID'  AND Status=NULL";

        $Result = mysqli_query($conn,$select);

 if(mysqli_num_rows($Result) > 0){

    echo "
     
    <table>
    <tr>
     <th>Item Image</th>
     <th>Item Name</th>
     <th>Price</th>
     <th>Quantity</th>
     <th>Remove</th>
    </tr>
    
         
         ";  

   while( $Items = mysqli_fetch_assoc($Result)){



$product_image ="Admin/items-image/". $Items["Product_image"];
$product_name = $Items["Item_name"];
$product_id = $Items["Product_id"];
$product_quantity = $Items["Quantity"];
$product_price ="₦" .number_format($Items["Item_price"]).".00";
$total_price += intval($Items["Item_price"]);
    echo "

    <tr> 
    <td><img src='$product_image' width='120px'></td>
    <td>$product_name  </td>
    <td>$product_price</td>
    <td>$product_quantity</td>
    <td>
    <form  id='$product_id' class='RemoveForm'><input type='number' 
    style='display: none;' name='cartID' 
    value='$product_id'><input type='submit' value='Remove Item'></form></td>
    </tr>
    ";
    
    
    
    
    
    }
    echo "</table>
    
    <p>Total Price: ₦". number_format($total_price). ".00 </p>
    ";
    
echo '
<p class="procced-checkout" onclick="Procced_checkout()">
<i class="fa fa-shield"></i> Procced to checkout</p>

<p class="clear-cart-items" onclick="clear_cart_items()"><i class="fa fa-minus">
</i> clear cart items</p>';

    

    //START SESSION AND ADD ALL ITEMS RETRIVE FROM DATABASE TO SESSION CART ITEMS
    

    $_SESSION["cart_items"] = [];
$items = array("Product_id" => $product_id,"Product_name" => $product_name,"Product_price" => $product_price,

"Product_quantity" => $product_quantity,"Product_image" => $product_image,"Product_id" => $product_id);

$item = array_push($_SESSION["cart_items"],$items);

    
 }else{

    die("Cart is empty");

    }   

    }else{

die("No item has been added");



}



}


?>

