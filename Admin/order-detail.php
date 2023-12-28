<?php
require_once "session.php";


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



if($_SERVER["REQUEST_METHOD"] == "GET"){


if(isset($_GET["Tracking_no"]) && !(empty($_GET["Tracking_no"]))){


  require_once "Loader.php";


$tracking_no  = htmlspecialchars($_GET["Tracking_no"]);

$tracking_no = stripcslashes($tracking_no);


$select = "SELECT * FROM Customer_orders WHERE Tracking_no='$tracking_no' ";


$results = mysqli_query($conn,$select);


if(mysqli_num_rows($results) > 0){


$item = mysqli_fetch_assoc($results);


$amount = number_format($item["Amount"]).".00";

$date = date("d D F Y",strtotime($item["Date"]));

$delivery_date = date("d D F Y",strtotime($item["Pickup_date"]));

if($item["Time"] > 12){

$time = $item["Time"]."PM";

}else{

$time = $item["Time"]. "AM";
}

/*
if($item["Status"] == "Cancel"){


$status_color= "style='color: red;'";

}else if($item["Status"] == "success"){

$status_color = "style='color: mediumseasgreen;'";

}else{

  $status_color = "style='color: yellow;'";

}*/



if($item["Order_status"] == "Cancel"){

  $progress = "
  
  <div class='more-info'>
    <b style='color: red;'>Order
    Confirm
     <i class='fa fa-check-circle'></i>
     </b>
     <i class='fa fa-arrows-h'></i>
    <b style='color: red;'> Shipped  <i class='fa fa-check-circle'></i></b>
    <i class='fa fa-arrows-h'></i>
      <b style='color: red;'>$item[Order_status]  <i class='fa fa-check-circle'></i></b>
  
      </div>";
  
  }else if($item["Order_status"] == "Pending"){
  
      $progress = " 
      <div class='more-info'>
        <b style='color: orange;'>Order
        Confirm
         <i class='fa fa-check-circle'></i>
         </b>
         <i class='fa fa-arrows-h'></i>
        <b style='color: orange;'> Shipped  <i class='fa fa-check-circle'></i></b>
        <i class='fa fa-arrows-h'></i>
          <b style='color: orange;'>$item[Order_status]  <i class='fa fa-check-circle'></i></b>
      
          </div>";
  
  }else{
  
  
      if($item["Order_status"] == "Shipped"){
  
  
  
          $progress = "
          <div class='more-info'>
            <b style='color: mediumseagreen;'>Order
            Confirm
             <i class='fa fa-check-circle'></i>
             </b>
             <i class='fa fa-arrows-h'></i>
            <b style='color: mediumseagreen;'> Shipped  <i class='fa fa-check-circle'></i></b>
            <i class='fa fa-arrows-h'></i>
              <b style='color: red;'>$item[Order_status]  <i class='fa fa-check-circle'></i></b>
          
              </div>";
  
  
  
      }else if($item["Order_status"] == "Ready for pickup"){
  
          $progress = "
          <div class='more-info'>
            <b style='color: mediumseagreen;'>Order
            Confirm
             <i class='fa fa-check-circle'></i>
             </b>
             <i class='fa fa-arrows-h'></i>
            <b style='color: mediumseagreen;'> Shipped  <i class='fa fa-check-circle'></i></b>
            <i class='fa fa-arrows-h'></i>
              <b style='color: mediumseagreen;'>$item[Order_status]  <i class='fa fa-check-circle'></i></b>
          
              </div>";
  
  
  
  
          
      }else{
  
  
  if($item["Order_status"] == "Order Delivered"){
  
      $progress = "
      <div class='more-info'>
        <b style='color: mediumseagreen;'>Order
        Confirm
         <i class='fa fa-check-circle'></i>
         </b>
         <i class='fa fa-arrows-h'></i>
        <b style='color: mediumseagreen;'> Shipped  <i class='fa fa-check-circle'></i></b>
        <i class='fa fa-arrows-h'></i>
          <b style='color: mediumseagreen'>$result[Order_status]  <i class='fa fa-check-circle'></i></b>
      
          </div>";
  
  
  
  
  }else if($item["Order_status"] == "Order confirmed" or $item["Order_status"] == "confirm"){
  
  
      $progress = " 
      <div class='more-info'>
        <b style='color: mediumseagreen;'>Order
        Confirm
         <i class='fa fa-check-circle'></i>
         </b>
         <i class='fa fa-arrows-h'></i>
        <b style='color: mediumseagreen;'> Shipped  <i class='fa fa-check-circle'></i></b>
        <i class='fa fa-arrows-h'></i>
          <b style='color: mediumseagreen;'>$item[Order_status]  <i class='fa fa-check-circle'></i></b>
      
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
              <b style='color: red;'>$item[Order_status]  <i class='fa fa-check-circle'></i></b>
          
              </div>";
  
  
  
  
  
      }
  
  
      }}


echo "



<div class='order-container'>
        <p>Order Details<br>Date Ordered $date $time</p>

$progress


      




";






$Orders = "SELECT * FROM Items_order WHERE Tracking_no ='$tracking_no'";


$user_orders = mysqli_query($conn,$Orders);


if(mysqli_num_rows($user_orders) > 0){


while($order_result = mysqli_fetch_assoc($user_orders)){

$imageURL = "items-image/". $order_result["Image_path"];

$item_amount = number_format($order_result["Item_price"]) . ".00";

$delivery_date = date("d D F Y",strtotime($item["Pickup_date"]));

echo "


<div class='order-items-container'>
<img src='$imageURL '>
<p>$order_result[Item_name]  ₦$item_amount</p>
<p>Quanitty$order_result[Quantity] </p>
<p><a href='Remove order item?Tracking_no=$order_result[Tracking_no]'>Remove Item</a></p>
</div>

<br><br>


";



  
}




}else{


  echo "<p>No items avaliable</p>";

}


if($item["Pickup_date"] == ""){
  $delivery_date = "";
    
        }else{
          
          $delivery_date = date("d D F Y",strtotime($item["Pickup_date"]));
  
        }


//ORDER STATUS PERMISSION FOR EACH CATEGORY
if($result["Status"] == "Master"){


$master = '
<option>Cancel</option>
<option>Shipped</option>
<option>Ready for pickup</option>
<option>Order Delivered</option>
<option>Order confirmed</option>
<option>Pending</option>';
}elseif ($result["Status"]== "Pickup Agent"){
$master = '
<option>Ready for pickup</option>
<option>Order Delivered</option>';

}else{

  $master = '';
}
echo "

<div class='container-fliud'>
  
<p>Order Status: <b>$item[Order_status]</b></p>
<p>Pick date: $delivery_date</p>
<p>Pickup location : <i>$item[Pickup_location].</i></p>
       <p>Total price: ₦$amount </p>
       <p>Tracking Number: $item[Tracking_no]<input type='text' style='display: none;' value='$item[Tracking_no]' id='Track_no'>
        <i class='fa fa-copy' style='cursor: pointer;' onclick='copy_no()'></i> <b class='copy-message'></b></p>
       <p>Payment Type: $item[payment_Type]</p>

       
      <p class='open-transaction-pin' onclick='Open_pin_box()'>change order status</a></p></a>
    
  </div>
   </div>

   
</div>


<div class='transaction-pin-overlay'>

<p><i class='fa fa-close' id='close-pin-btn' onclick='Close_pin_box()'></i></p>


<form id='update-form'>
<lable><b>Input your secret key</b></label><br>

<br>
<input type='number' name='secert-key' inputmode='numeric' style='-webkit-text-security: disc;' placeholder='Input your secret key'><br>
<input type='text' name='order-ID' value='$item[Tracking_no]' style='display: none;'>
<br>
<select name='status'>
<option></option>
<option>$item[Order_status](Current status)</option>
$master
</select>

<br><br>

<input type='submit' value='update'><br>
</form>

<p class='remove_error_message' style='color: red;'></p>
</div>



";

}


}else{


header("Location: Error");
exit;


}



}else{

  header("Location: Error");
  exit;
}


?>

<script src="Js/order-details.js"></script>
</body>
</html>