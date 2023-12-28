<?php
require_once "sessionPage.php";

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/order-details.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Order Details</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&family=Montserrat:ital,wght@1,300&family=Poppins:wght@300&family=Tilt+Prism&display=swap" rel="stylesheet">

</head>
<body>


<?php


require_once "Network.php";

require_once "Loader.php";


if($_SERVER["REQUEST_METHOD"] == "GET"){


  if(isset($_GET["Tracking_no"])){



if(empty($_GET["Tracking_no"])){


die("<p style='color: red;text-align:center;'>Error,please reload page or go back</p>");


}else{

$tracking_no = (int) filter_var($_GET["Tracking_no"],FILTER_VALIDATE_INT);

 $tracking_no = stripcslashes($tracking_no);

 $tracking_no = htmlspecialchars($tracking_no);

  require_once "database_connection.php";

  $tracking_no = mysqli_real_escape_string($conn,$tracking_no);

  $fetch_orders = "SELECT * FROM Customer_orders WHERE Tracking_no='$tracking_no' AND User_id='$_SESSION[User]'";
   
  
  $orders_result = mysqli_query($conn,$fetch_orders);
  
  if(mysqli_num_rows($orders_result) > 0){
  
  $orders = mysqli_fetch_assoc($orders_result);
  
  $date = date("d D F Y ",strtotime($orders["Date"]));
  
$amount = number_format($orders["Amount"]);


if($orders["Time"] > 12){


  $time = $orders["Time"] ."PM";
}else{


  $time = $orders["Time"]."AM";
}

/*
if($orders["Status"] == "Failed"){

$progress = "
<div class='more-info'>
  <b style='color: red;'>Order
  Confirm
   <i class='fa fa-check-circle' style='color: red;'></i>
   </b>
   <i class='fa fa-arrows-h' style='color: red;'></i>
  <b style='color: red;'> Shipped  <i class='fa fa-check-circle' style='color: red;'></i></b>
  <i class='fa fa-arrows-h' style='color: red;'></i>
    <b style='color: red;'>Ready for Pickup  <i class='fa fa-check-circle' style='color: red;'></i></b>

    </div>";


}


echo"
<div class='order-container'>
        <p>Order Details<br>Date Ordered $date $time</p>


    $progress
      

";
*/


if($orders["Order_status"] == "Cancel"){

  $progress = "
  
  <div class='more-info'>
    <b style='color: red;'>Order
    Confirm
     <i class='fa fa-check-circle'></i>
     </b>
     <i class='fa fa-arrows-h'></i>
    <b style='color: red;'> Shipped  <i class='fa fa-check-circle'></i></b>
    <i class='fa fa-arrows-h'></i>
      <b style='color: red;'>$orders[Order_status]  <i class='fa fa-check-circle'></i></b>
  
      </div>";
  
  }else if($orders["Order_status"] == "Pending"){
  
      $progress = " 
      <div class='more-info'>
        <b style='color: orange;'>Order
        Confirm
         <i class='fa fa-check-circle'></i>
         </b>
         <i class='fa fa-arrows-h'></i>
        <b style='color: orange;'> Shipped  <i class='fa fa-check-circle'></i></b>
        <i class='fa fa-arrows-h'></i>
          <b style='color: orange;'>$orders[Order_status]  <i class='fa fa-check-circle'></i></b>
      
          </div>";
  
  }else{
  
  
      if($orders["Order_status"] == "Shipped"){
  
  
  
          $progress = "
          <div class='more-info'>
            <b style='color: mediumseagreen;'>Order
            Confirm
             <i class='fa fa-check-circle'></i>
             </b>
             <i class='fa fa-arrows-h'></i>
            <b style='color: mediumseagreen;'> Shipped  <i class='fa fa-check-circle'></i></b>
            <i class='fa fa-arrows-h'></i>
              <b style='color: red;'>$orders[Order_status]  <i class='fa fa-check-circle'></i></b>
          
              </div>";
  
  
  
      }else if($orders["Order_status"] == "Ready for pickup"){
  
          $progress = "
          <div class='more-info'>
            <b style='color: mediumseagreen;'>Order
            Confirm
             <i class='fa fa-check-circle'></i>
             </b>
             <i class='fa fa-arrows-h'></i>
            <b style='color: mediumseagreen;'> Shipped  <i class='fa fa-check-circle'></i></b>
            <i class='fa fa-arrows-h'></i>
              <b style='color: mediumseagreen;'>$orders[Order_status]  <i class='fa fa-check-circle'></i></b>
          
              </div>";
  
  
  
  
          
      }else{
  
  
  if($orders["Order_status"] == "Order Delivered"){
  
      $progress = "
      <div class='more-info'>
        <b style='color: mediumseagreen;'>Order
        Confirm
         <i class='fa fa-check-circle'></i>
         </b>
         <i class='fa fa-arrows-h'></i>
        <b style='color: mediumseagreen;'> Shipped  <i class='fa fa-check-circle'></i></b>
        <i class='fa fa-arrows-h'></i>
          <b style='color: mediumseagreen'>$orders[Order_status]  <i class='fa fa-check-circle'></i></b>
      
          </div>";
  
  
  
  
  }else if($orders["Order_status"] == "Order confirmed" or $orders["Order_status"] == "confirm"){
  
  
      $progress = " 
      <div class='more-info'>
        <b style='color: mediumseagreen;'>Order
        Confirm
         <i class='fa fa-check-circle'></i>
         </b>
         <i class='fa fa-arrows-h'></i>
        <b style='color: mediumseagreen;'> Shipped  <i class='fa fa-check-circle'></i></b>
        <i class='fa fa-arrows-h'></i>
          <b style='color: mediumseagreen;'>$orders[Order_status]  <i class='fa fa-check-circle'></i></b>
      
          </div>";
  
  
  
      }else{
  
          $progress = " 
          <div class='more-info'>
            <b style='color: red'>Order
            Confirm
             <i class='fa fa-check-circle'></i>
             </b>
             <i class='fa fa-arrows-h'></i>
            <b style='color: red;'> Shipped  <i class='fa fa-check-circle'></i></b>
            <i class='fa fa-arrows-h'></i>
              <b style='color: red;'>$orders[Order_status]  <i class='fa fa-check-circle'></i></b>
          
              </div>";
  
  
  
  
  
      }
  
  
      }}
  



      echo"
      <div class='order-container'>
              <p>Order Details<br>Date Ordered $date $time</p>
      
      
          $progress
            
      
      ";


//FETCH ITEMS SINGLE AND PRICE//



$items = "SELECT * FROM Items_order WHERE  Tracking_no='$tracking_no'";


$items_result = mysqli_query($conn,$items);


if(mysqli_num_rows($items_result)   > 0){

while($shopping_items = mysqli_fetch_assoc($items_result)){

$image_path = "Admin/items-image/". $shopping_items["Image_path"];


$price = "". number_format($shopping_items["Item_price"]).".00";

//$sub_price = $shopping_items["Item_price"] * $shopping_items["Quantity"];

  echo "
  
  <div class='order-items-container'>
  <img src='$image_path'>
  <p>$shopping_items[Item_name] $price</p>
  <p>Quanitty $shopping_items[Quantity]</p>
 

</div>

<br><br>
  
  ";

  
}

}else{

//echo "Nothin was found";


}



if($orders["Status"] == "Failed"){


  $status_color = "'color: red;'";
}else{


  $status_color = "'color: mediumseagreen'";
}
/*

$pickup_date = date("d D F Y",strtotime($orders["Pickup_date"]));

*/

if($orders["Pickup_date"] == ""){
  $pickup_date = "";
    
        }else{
          
        $pickup_date = date("d D F Y",strtotime($orders["Pickup_date"]));
  
      // $pickup_date = $orders["Pickup_date"];
        }


echo "



    <div class='container-fliud'>
  
    <p>Order Status:<b style= $status_color>  $orders[Order_status]</b></p>
    <p>Pickup date: $pickup_date</p>
    <p>Pickup location : <i>$orders[Pickup_location].</i></p>
           <p>Total price: ₦$amount.00</p>
           <p>Tracking Number: $orders[Tracking_no] <i class='fa fa-copy' onclick='copy_no()' style='cursor: pointer'></i>
            <b class='copy-message'></b></p>
           <input type='hidden' value='$orders[Tracking_no]' id='Track_no'>
           <p>Payment Type: $orders[payment_Type]</p>
    
           <p class='close-page' onclick='window.history.back()'>Go back</p>
           <p class='close-page' id='open-btn'>Report Order</p>
       </div>




    
";


echo "



<div class='Report-order-container'>

  <form id='Report-order'>
  <label><b>Tracking Number</b></label>

<br>
  <input type='number' value='$orders[Tracking_no]' name='tracking-code' readonly>
  <br>

  <label><b>Complain Options</b></label><br>
  <select name='complains'>
  <option></option>
  <option>Failed but Debited</option>
  <option>Cancled but has not been Credited</option>
  <option>successful but package has not arrive yet</option>
  <option>Wrong pickup/Delivery Location</option>
  </select>
  <br><br>

  <input type='submit' value='Lodge complain'> 
</form>
<br>

<b class='error_message'></b>



<p><a href='Live-chat' target='_blank'> Livechat <i class='fa fa-envelope'></i></a></p>
<br>
<p> <a href='mailto:Ajehabraham51@gmail.com'>Send Email</a></p>

<br><br>
<b class='close-btn'><i class='fa fa-close'></i></b>
</div>


";
  

  }






  
mysqli_close($conn);


}


  }else{


die("<p style='color: red;text-align:center;'>Error caught,please go back</p>");

  }



}else{


  header("Location: Error");
  exit;
}

?>
  <script src="Js/order-details.js"></script>

</body>
</html>