<?php
require_once "sessionPage.php";


if(isset( $_SESSION["delivery_location"])){

  unset( $_SESSION["delivery_location"]);

  
}


if(isset($_SESSION["cart_items"]) && !empty($_SESSION["cart_items"])){


  foreach($_SESSION['cart_items'] as $x => $x_value){

    //var_dump($x_value);
    
    $product_name = $x_value["Product_name"];
    
    $product_price ="₦". number_format($x_value["Product_price"]) .".00";
    
    $product_quantity = $x_value["Product_quantity"];
    
    $product_image ="Admin/items-image/" . $x_value["Product_image"];
    
    $product_id = $x_value["Product_id"];


  }


}else{

  echo "<p style='color: red;text-align: center;'>Cart is empty</p>

  <p style='text-align: center;'><a href='home'>Home</a></p>
  ";
  
  die();

  if(isset($_COOKIE["cart-items"]) && !empty($_COOKIE["cart-items"])){


    //CHECK IF USER HAS SAVED ITEM IN OUT DATABASE//

    $SessionID = htmlspecialchars($_COOKIE["cart-items"]);
    $SessionID = trim($SessionID);


    require_once "database_connection.php";

    $SessionID = mysqli_real_escape_string($conn,$SessionID);

    $select = "SELECT * FROM Save_cart_items WHERE User_id='$SessionID' AND Status=NULL OR Status=''";

    $Result = mysqli_query($conn,$select);

if(mysqli_num_rows($Result) > 0){

while( $Items = mysqli_fetch_assoc($Result)){



$product_image ="Admin/items-image/". $Items["Product_image"];
$product_name = $Items["Item_name"];
$product_id = $Items["Product_id"];
$product_quantity = $Items["Quantity"];
$product_price ="₦" .number_format($Items["Item_price"]).".00";

$total_price += intval($Items["Item_price"]);

$masterDog ="
<div class='items-container'>
<img src=' $product_image' width='160px'>
<br>
<b>$product_price</b>
<br>
<b>$product_name</b>
<b>Quantity: $product_quantity</b><br>

<form class='FormDatas' id='$product_id'>
<input type='text' name='cartID' style='display:none;' value='$product_id'>
<input type='submit' value='Remove Item'>
</form>
</div>
";

echo "<br>";



}


}else{

  
echo "<p style='color: red;text-align: center;'>Cart is empty</p>

<p style='text-align: center;'><a href='home'>Home</a></p>
";

die();
}


}else{

  echo "<p style='color: red;text-align: center;'>Cart is empty</p>

  <p style='text-align: center;'><a href='home'>Home</a></p>
  ";

  die();



}


}



$bal ="SELECT * FROM Account_balance WHERE User_id ='$_SESSION[User]'";



$bal_result = mysqli_query($conn,$bal);


if(mysqli_num_rows($bal_result) > 0){


$bals = mysqli_fetch_assoc($bal_result);

$acct = "₦".number_format($bals["Balance"]). ".00";


}else{


$acct ="0.00";



}



?>


<!DOCTYPE html>
<html lang="eng_US">
  <head>
    
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="Css/checkout.css">

       <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300&family=Island+Moments&family=Oswald:wght@200&family=PT+Serif:wght@700&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">


<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>
<title>checkout</title>



<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->

      </head>
      <body>

<?php require_once "Loader.php";
require_once "success.php";
?>

<div class="top-nav-bar">
  <a href="Home">
<i class="fa fa-home"></i></a>
<i class="fa fa-close" id="Order_permision_btn"></i>

</div>

<div class="Warning-danger">


<p>Are you sure you want to cancel this order?</p>


<p><a href="cancel-order">Yes</a></p>
  
<p><a href='home'>No,save and exit</a></p>

<p><i class="fa fa-close" onclick="closeOrder_permision()"></i></p>
  </div>



<div class="checkout-container">
  <h1>Checkout</h1>
  
  
  <h3>Order details </h3>

  <?php


if(isset($_SESSION["cart_items"])){
foreach($_SESSION['cart_items'] as $x => $x_value){

  //var_dump($x_value);
  
  $product_name = $x_value["Product_name"];
  
  $product_price ="₦". number_format($x_value["Product_price"]) .".00";
  
  $product_quantity = $x_value["Product_quantity"];
  
  $product_image ="Admin/items-image/" . $x_value["Product_image"];
  
  $product_id = $x_value["Product_id"];


  echo " 
  <div class='items-container'>
  <img src=' $product_image' width='160px'>
  <br>
  <b>$product_price</b>
  <br>
  <b>$product_name</b>
  <b>Quantity: $product_quantity</b><br>
  <form class='FormDatas' id='$product_id'>
  <input type='text' name='cartID' style='display:none;' value='$product_id'>
  <input type='submit' value='Remove Item'>
  </form>
  </div>
  ";

echo "<br>";
}


}else{

  echo $masterDog;

}

?>
<p class="error_messages"></p>

  
  
  <div class="order-info">
    
  <h3>Order Info</h3>
  
  <p><b>Delivery Locations</b></p>
  <?php

$state = "SELECT * FROM Delivery_state  WHERE Status ='Avaliable'";

$state_result = mysqli_query($conn,$state);


if(mysqli_num_rows($state_result) > 0){


  echo "
  <p>
  <form id='Locations_form'>
  <select onchange='fetch_address(event)' name='Delivery_location'>
  <option></option>";

  while($state_results = mysqli_fetch_assoc($state_result)){


    echo "

    <option>$state_results[State]</option>
   ";
   
   



  }

  echo "
  </select>
 
  <br>
  <br>
  <b class='address_error_message'></b>
</select>
  
  <br>
  <br>
  <b class='Main_address_error_message'></b>
  </select>
  </p>
  

  </form>";

}else{

echo "<b style='color:red;'>No state found.</b>";



}

if(isset($_SESSION["cart_items"])){
foreach($_SESSION['cart_items'] as $x => $x_value){

  $sub_price += $x_value["Product_price"];

  $product_id = $x_value["Product_id"];

 
}
}else{


  $sub_price = $total_price;

}


$shippin_fee = 760.00;

$tax = $sub_price/100 * 10;


$total = $shippin_fee + $tax + $sub_price;

$_SESSION["TOTAL_price"] = $total;

$total = number_format($total).".00";

$tax = number_format($tax).".00";

$sub_price = number_format($sub_price) .".00";


if($acct < $_SESSION["TOTAL_price"]){

$balance_color = "style='color: red;border: 2px solid red;'";
$balance_message = "Insufficient";

}else if($acct >= $_SESSION["TOTAL_price"]){


 $balance_color ="";
 $balance_message =""; 

}else{

  $balance_color ="";
  $balance_message =""; 


}


?>
  
  <p>Sub Total ₦<?php echo $sub_price; ?></p>
  <p>Shipping fee ₦<?php echo $shippin_fee; ?>.00</p>
  <p>Tax fee(VAT 5%) ₦<?php echo $tax; ?></p>
  <p style="color: black;font-size: 20px;">Total ₦<?php echo $total ?></p>
  </div>
  
  
  
  <h3 class="open-payment" onclick="OpenPayment_method()">Select Payment Method </h3>
  
  <div class="form-container">
   
  <?php

$fetch_saved_card ="SELECT * FROM Saved_card WHERE User_id='$_SESSION[User]'ORDER BY id DESC ";

$card = mysqli_query($conn,$fetch_saved_card);


if(mysqli_num_rows($card) > 0){


$card_result =mysqli_fetch_assoc($card);

echo "

<p class='saved-cards-details' onclick='closeCard()''><i class='fa fa-flash'></i>
<input type='text' name='saved_number' style='display: none;'>
$card_result[Card_no]
<br>
$card_result[First_name] $card_result[Last_name]
</p>

";


}else{


echo "<p class='saved-cards-details'>No  card found<br>Please add card info</p>";



}


  ?>

  
  <p class="account-balance" <?php ; ?> onclick="Bal_payment()">Balance Payment<br><?php echo "₦" .$acct." ". $balance_message; ?></p>
  <p class="credit-card" onclick="OpenCard()">Credit card<br><i class="fa fa-flash"></i></p>
  
  <div class="credit-card-container">
  
    <form id="form">

    <input type="radio" name="payment_type" value="Type_card" id="Type_card" style="display: none;">
  <input type="radio"name="payment_type" value="Type_balance" id="Type_balance"style="display: none;">
<input type="radio" name="payment_type" value="Type_saved" id="Type_saved"style="display: none;">
  


    <label><b>Card Number</b></label><br>
   
    <input type="text" inputmode="numeric" autocomplete='off' name="card_number"
    oninput="Validate_card(event)" maxlength="15" placeholder="**** **** **** ***">
  <br>  <p class="card_error_message"></p>
    <br>
  
    <label><b>Expiration date</b></label> 
    <label id="ccv-text" ><b>Security Code</b></label>
  <br>
    <input type="text" name="Exp" id="exp" maxlength="4" 
    inputmode="numeric" autocomplete='off' placeholder="08/23">
  
    
    <input type="text" name="ccv" id="ccv" style="-webkit-text-security: disc;" 
    inputmode="numeric" autocomplete='off' placeholder="CCv" maxlength="3">
  
    <br>
    <label><b>Pin</b></label>
    <br>   
  
    <input type="text" name="card_pin" id="pin" inputmode="numeric" 
    style="-webkit-text-security: disc;" autocomplete='off' placeholder="****" maxlength="4">
  
    <b class="Save-payment" >
      <label class="switch">
      <input type="checkbox" value="Yes" id="terms" name="save_card">
      <span class="round slider">
        
      </span></label>   <b style="position: absolute; 
      margin-top: 2px;margin-left: 5px; color: rgb(0,102,123);"> Save card</b></b>
  
  </div>
  
  
  <!--p  class="Save-payment"><input type="checkbox">Save payment method</p-->


  <p class="Balance_display" style="text-align: center; display: none;" <?php echo $balance_color;?>>Balance <?php echo $acct ." ". $balance_message; ?></p>
  <p  class="seletec_card_pin" style="text-align: center; display: none;">
    <b>Card pin:</b><input type="text" name="saved_pin" inputmode="Numeric" placeholder="card pin...."
    style="-webkit-text-security: disc;width: 20%;"> </p>

    <p style="text-align: center;color: red;" class="error_message"></p>
    <input type="submit" onclick="Submit_payment(event)" value="Confirm and continue">
  </form>
  </div>
  

  <p>Supported cards  <i class="fa fa-flash" style='color:  red;'></i></p>
  </div>


  <?php require_once "Loader.php"; ?>
<script src="Js/checkout.js"></script>
   
</body>
</html>


