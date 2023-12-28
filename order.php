<?php
require_once "sessionPage.php";

?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/Order.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Orders</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&family=Montserrat:ital,wght@1,300&family=Poppins:wght@300&family=Tilt+Prism&display=swap" rel="stylesheet">

</head>
<body>



<div class="order-container">
        <p>All Order Details</p>

        </div>

<?php


require_once "database_connection.php";

$fetch_orders = "SELECT * FROM Customer_orders WHERE User_id='$_SESSION[User]' ORDER BY id DESC";



$orders_result = mysqli_query($conn,$fetch_orders);

if(mysqli_num_rows($orders_result) > 0){

while($orders = mysqli_fetch_assoc($orders_result)){

$date = date("d D F Y ",strtotime($orders["Date"]));


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
  
  
  
  
  }else if($orders["Order_status"] == "Order confirmed" or  $orders["Order_status"] == "confirm"){
  
  
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

      if($orders["Pickup_date"] == ""){
$pickup_date = "";
  
      }else{
        
      $pickup_date = date("d D F Y",strtotime($orders["Pickup_date"]));

      }


      if($orders["Status"] == "Failed"){

        $status_color = "'color: red;'";

      }else{
      
      $status_color = "'color: mediumseagreen'";
      
      }


      echo "

      $progress
      
      
        <p style='text-align: center'>
          
          Pickup date: $pickup_date  <br>Order Status: <b style=$status_color>$orders[Order_status]</b></p>
        <p class='View-more'><a href='order-detail?Tracking_no=$orders[Tracking_no]'>View Details</a></p>
        <br><br><br><br>
      
      <p class='close-order'>Tracking Number $orders[Tracking_no]</p>
      
";      




}





}else{


  echo "<p style='text-align:: center; color: red;'>You have no Order(s)</p>";

}

mysqli_close($conn);

require_once "Network.php";
?>
   
</body>
</html>


