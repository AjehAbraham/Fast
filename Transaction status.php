<?php
require_once "sessionPage.php";

if(!isset($_SESSION['Tracking_no']) && !isset($_SESSION["Order_success"])){



  header("Location: home");
  exit;
}else{




 $trackingNO = $_SESSION['Tracking_no'] ;
    
$orderStatus =  $_SESSION["Order_success"];

}

?>

<!DOCTYPE html>
<html lang="eng_US">
  <head>
    <link rel="stylesheet" href="Css/Transaction-status.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
          <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>


<script src="https://kit.fontawesome.com/958aace4f6.js" crossorigin="anonymous"></script>
<title>Transaction status</title>

<!-- ajax and jquery link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src= "https://code.jquery.com/jquery-3.5.0.js"></script>

<!-- end of ajax link -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,300&family=Montserrat:ital,wght@1,300&family=Poppins:wght@300&family=Tilt+Prism&display=swap" rel="stylesheet">

      </head>
      <body>

      <div class="success-message-fluid">

        <p>Order has been placed successfully!</p>

        <p ><i class="fa fa-check-circle"></i></p>

        <p><b>Tracking no:</b> <i><?php echo $trackingNO; ?></i>  <b id='copy-btn'><i class="fa fa-copy" onclick='copyCode()'></i></b></p>
      

    <p><a href="order-detail?Tracking_no=<?php echo  $_SESSION['Tracking_no'];?>"><i class="fa fa-cart-arrow-down"></i> View Order</p></a>

       <p> <a href="home"><i class="fa fa-home"></i> Go back Home</p></a>
        <br>
      </div>
    </div>

    <input type='text' value='<?php echo $trackingNO; ?>' style='display: none;' id='TrackCode'>
    <?php 
    
    unset($_SESSION["Order_success"]);
    unset($_SESSION['Tracking_no']);
    ?>


<script src="Js/Transaction-status.js"></script>

</body>
</html>