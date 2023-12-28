<?php
require_once "database_connection.php";

//CRON JOB FILE THAT AUTOMATICALLY UPDATE USER ORDER STATUS TO READY FOR PICKUP//
//Cron-jobs/update-order-status;
$date = htmlspecialchars(date("Y/m/d"));

$orderStstus = "Ready for pickup";

$update = "UPDATE Customer_orders SET Order_status='$orderStstus' WHERE Status='success'
 AND NOW() >= $date";


if(mysqli_query($conn,$update)){

echo "success";

//NOW CHANGE PENDING ORDER DATE TO NEXT FOUR DAYS THEN REMOVE/CANCEL AND REMOVE PICKUPDATE FOR OTHER TYHAT HAS BEEN CANCELED//
$orderStatus = "Pending";

$pickup_date =date_create(date("Y/m/d"));

//$pickup_date = ($pickup_date);

//AUTOMATICALLY SCHEDULE PICKUP DATE IN FOUR DAYS TIME//

date_add($pickup_date,date_interval_create_from_date_string("4 day"));

$pickup_date = date_format($pickup_date,"Y-m-d");


$update2 = "UPDATE Customer_orders SET Pickup_date='$pickup_date' 
WHERE Order_status='$orderStatus' AND NOW() >= $date";

if(mysqli_query($conn,$update2)){

    echo " Ok ";

}else{

    echo " Error occured ";

}


//REMOVE PCIKUPDATE FROM ORDER THAT HAS BEEN CANCELD MAYBE DUE TO PAYMENT ERROR OR REASONS BEST KWNOS TO ADMIN//


$update3 = "UPDATE Customer_orders SET Pickup_date='' WHERE Status='Cancel' or Status='cancel'";


if(mysqli_query($conn,$update3)){

    echo " success ";
}else{


    echo " Error occured ";
}

}else{

die("Error caught ");

}