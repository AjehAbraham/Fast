<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){


if(isset($_POST["Track_code"])){



    if(empty($_POST["Track_code"])){


        die("Please enter your Tracking number");

    }else{


$tracking_no = (int) filter_var($_POST["Track_code"],FILTER_VALIDATE_INT);



$tracking_no = stripcslashes($tracking_no);


if(strlen($tracking_no)  <= 9){


    die("Tracking Number must be at least 10 in length");

}else{


require_once "database_connection.php";


$tracking_no = htmlspecialchars($tracking_no);

$tracking_no = mysqli_real_escape_string($conn,$tracking_no);


//FETCH DATAS//


$track_order = " SELECT * FROM Customer_orders WHERE Tracking_no ='$tracking_no'";

$orders_result = mysqli_query($conn,$track_order);


if(mysqli_num_rows($orders_result)  > 0){



    $result = mysqli_fetch_assoc($orders_result);


    $date = date("d D F Y",strtotime($result["Date"]));

    

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
    
    
    
    
    }else if($result["Order_status"] == "Order confirmed" or $result["Order_status"] == "success" or $result["Order_status"] == "confirm"){
    
    
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
    
        /*    $progress = "
            <div class='more-info'>
              <b style='color: red'>Order
              Confirm
               <i class='fa fa-check-circle'></i>
               </b>
               <i class='fa fa-arrows-h'></i>
              <b style='color: red;'> Shipped  <i class='fa fa-check-circle'></i></b>
              <i class='fa fa-arrows-h'></i>
                <b style='color: red;'>$result[Order_status]  <i class='fa fa-check-circle'></i></b>
            
                </div>";*/
    
    
    
    
    
        }
    
    
        }}
    
        $Order_date = date("d D F Y", strtotime($result["Date"]));

    echo "
    
    $progress
  
    
    <p class='close-order'><b>Tracking Number:</b> <i>$result[Tracking_no]</i></p>
    
    <p><b>Pickup Date:</b> $date<br> <b>Pickup station:</b> <i>$result[Pickup_location]</i></p>
    
  
    
    <p class='map-re-direct' onclick='error_f()'>Locate using Map <i class='fa fa-map'></i>
    ";
    




}else{



    die("Opps!,we coul not find your Order,please check your Tracking number properly");
}

}


    }


}else{


die("Error fetching data due to invalid request type");


}


mysqli_close($conn);

}else{


header("Location: Error");
exit;

}