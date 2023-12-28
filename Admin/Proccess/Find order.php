<?php

require_once "session.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

///header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){



if(isset($_POST["search"]) && !empty($_POST["search"])){


$tracking_no = (int) filter_var($_POST["search"],FILTER_VALIDATE_INT);

$tracking_no = stripslashes($tracking_no);


$tracking_no = htmlspecialchars($tracking_no);


if(strlen($tracking_no) <= 9){


die("Tracking number cannot be less than 10");

}else{


require_once "db_connection.php";

$tracking_no = mysqli_real_escape_string($conn,$tracking_no);


$fetch_no = "SELECT * FROM Customer_orders WHERE Tracking_no='$tracking_no'";

$results = mysqli_query($conn,$fetch_no);


if(mysqli_num_rows($results)  > 0){


$result = mysqli_fetch_assoc($results);



$amount = number_format($result["Amount"]).".00";

$date = date("d D F Y",strtotime($result["Date"]));

$delivery_date = date("d D F Y",strtotime($result["Pickup_date"]));

if($result["Time"] > 12){

$time = $result["Time"]."PM";

}else{

$time = $result["Time"]. "AM";
}


if($result["Order_status"] == "Cancel"){

$progress = "
<div class='more-info'>
  <b style='color: red;'>Order
  Confirm
   <i class='fa fa-check-circle'></i>
   </b>
   <i class='fa fa-arrows-h'></i>
  <b style='color: red;'> Shipped  <i class='fa fa-check-circle'></i></b>
  <i class='fa fa-arrows-h'></i>
    <b style='color: red;'>$result[Order_status]  <i class='fa fa-check-circle'></i></b>

    </div>";

}else if($result["Order_status"] == "Pending"){

    $progress = "
    <div class='more-info'>
      <b style='color: orange;'>Order
      Confirm
       <i class='fa fa-check-circle'></i>
       </b>
       <i class='fa fa-arrows-h'></i>
      <b style='color: orange;'> Shipped  <i class='fa fa-check-circle'></i></b>
      <i class='fa fa-arrows-h'></i>
        <b style='color: orange;'>$result[Order_status]  <i class='fa fa-check-circle'></i></b>
    
        </div>";

}else{


    if($result["Order_status"] == "Shipped"){



        $progress = "
        <div class='more-info'>
          <b style='color: mediumseagreen;'>Order
          Confirm
           <i class='fa fa-check-circle'></i>
           </b>
           <i class='fa fa-arrows-h'></i>
          <b style='color: mediumseagreen;'> Shipped  <i class='fa fa-check-circle'></i></b>
          <i class='fa fa-arrows-h'></i>
            <b style='color: red;'>$result[Order_status]  <i class='fa fa-check-circle'></i></b>
        
            </div>";



    }else if($result["Order_status"] == "Ready for pickup"){

        $progress = "
        <div class='more-info'>
          <b style='color: mediumseagreen;'>Order
          Confirm
           <i class='fa fa-check-circle'></i>
           </b>
           <i class='fa fa-arrows-h'></i>
          <b style='color: mediumseagreen;'> Shipped  <i class='fa fa-check-circle'></i></b>
          <i class='fa fa-arrows-h'></i>
            <b style='color: mediumseagreen;'>$result[Order_status]  <i class='fa fa-check-circle'></i></b>
        
            </div>";




        
    }else{


if($result["Order_status"] == "Order Delivered"){

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




}else if($result["Order_status"] == "Order confirmed" or "confirm"){


    $progress = "
    <div class='more-info'>
      <b style='color: mediumseagreen;'>Order
      Confirm
       <i class='fa fa-check-circle'></i>
       </b>
       <i class='fa fa-arrows-h'></i>
      <b style='color: mediumseagreen;'> Shipped  <i class='fa fa-check-circle'></i></b>
      <i class='fa fa-arrows-h'></i>
        <b style='color: mediumseagreen;'>$result[Order_status]  <i class='fa fa-check-circle'></i></b>
    
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
            <b style='color: red;'>$result[Order_status]  <i class='fa fa-check-circle'></i></b>
        
            </div>";





    }


    }}

    
    if($result["Pickup_date"] == ""){
      $delivery_date = "";
        
            }else{
              
              $delivery_date = date("d D F Y",strtotime($result["Pickup_date"]));
      
            }

echo "

$progress

    <p style='text-align: center'>
      
      Pickup date: $delivery_date <br>Status: $result[Order_status]</p>
    <p class='View-more'><a href='order-detail?Tracking_no=$result[Tracking_no]'>View Details</a></p>
    <br><br><br><br>

<p class='close-order'>Tracking Number $result[Tracking_no]</p>

<p style='padding: 10px 10px; background-color: red;color: white; text-align: cemter;'>End of search</p>
";





}else{


    die("Invalid Tracking no");
}

}


}



}else{



    header("Location: Error");
    exit;
}

