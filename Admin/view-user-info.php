<?php
require_once "session.php";
if($result["Status"] == "Master"){


}else{

  die("Authorization Failed.");
}
if($_SERVER["REQUEST_METHOD"] == "GET"){


  if(!isset($_GET["id"]) && empty($_GET["id"])){


    die("Error,please go back");
}else{


//$id = (int) filter_var($_GET["id"],FILTER_VALIDATE_INT);

$id = htmlspecialchars($_GET["id"]);

require_once "db_connection.php";

$id = mysqli_real_escape_string($conn,$id);

$check ="SELECT * FROM Register_db WHERE uniqueID='$id'";



$check_result = mysqli_query($conn,$check);

if(mysqli_num_rows($check_result) > 0){

$user = mysqli_fetch_assoc($check_result);


$_SESSION['View-user-id'] = $user["id"];

}else{


die("<p>User does not exist<p>");

}



}




  }else{


    die("<p>Invalid request</p>");
  }




//CHECK IF USER ACCOUNT IS BLOCK OR USER HAS BEEN BLOCK FROM MAKING PAYMENT//

$check_status = "SELECT * FROM Block_user_acct WHERE User_id='$user[id]'
ORDER BY id DESC LIMIT 1";

$block_result = mysqli_query($conn,$check_status);


if(mysqli_num_rows($block_result) > 0){

$block_status = mysqli_fetch_assoc($block_result);


if($block_status["Status"] == "Block"){

  
$block_acct_status = "checked";
$block_acct_message = "UnBlock";


}elseif($block_status["Status"] == "UnBlock"){


  $block_acct_status = "";

  $block_acct_message = "Block";


}else{



}




}else{

$block_acct_status = "";
 $block_acct_message = "Block";

}

//CHECK IF USER PAYMENT HAS BEEN BLOCK//


$check_payment_status = "SELECT * FROM Block_user_payment WHERE User_id='$user[id]'
ORDER BY id DESC LIMIT 1";

$payment_status = mysqli_query($conn,$check_payment_status);


if(mysqli_num_rows($payment_status) > 0){


  $payment_result = mysqli_fetch_assoc($payment_status);


  if($payment_result["Status"] == "Block"){




    $payment_checkbox = "checked";

    $payment_message = "UnBlock";


  }else{




    $payment_checkbox = "";

    $payment_message = "Block";


  }


}else{


$payment_checkbox = "";

$payment_message = "Block";

}



//FTECH USER IP ADDRESS AND LAST SEEN//

require_once "db_connection.php";

$last_seen = "SELECT * FROM Login_history WHERE User_id='$user[id]' ORDER BY id DESC LIMIT 1";

$last_seent_result = mysqli_query($conn,$last_seen);


if(mysqli_num_rows($last_seent_result) > 0){



$user_last_seen = mysqli_fetch_assoc($last_seent_result);


if($user_last_seen["Time"] > 12){


$last_seen_time = $user_last_seen["Time"]."PM";

}else{


$last_seen_time = $user_last_seen["Time"]."AM";

}


$last_seen_status = "Active last ";


$last_seen_date = date("d D F Y",strtotime($user_last_seen["Date"]));

$last_seen_device = $user_last_seen["User_agent"];


$last_seen_status = "Active last ". $last_seen_date . " ". $last_seen_time
." <br>". $user_last_seen["User_agent"]."<br> ". $user_last_seen["Ip_addr"];
;


}else{


  $last_seen_status = "Never been Active";
}




//FTECH USER IMAGE//

$user_imag = "SELECT * FROM User_profile_image WHERE User_id='$user[id]' ORDER BY id DESC LIMIT 1";

$image_result = mysqli_query($conn,$user_imag);

if(mysqli_num_rows($image_result) > 0){

$image = mysqli_fetch_assoc($image_result);

$imageURL = "/Uploads/". $image["Image_path"];


}else{


  $imageURL = "";

}


$bal ="SELECT * FROM Account_balance WHERE User_id='$user[id]'";


$bal_result = mysqli_query($conn,$bal) ;

if(mysqli_num_rows($bal_result) > 0){


  
$balance = mysqli_fetch_assoc($bal_result);

$user_balance = "₦". number_format($balance["Balance"]). ".00";

}else{

$user_balance = "₦00.00";

}


?>
<!DOCTYPE html>
<html>
  <head>
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


    <link rel="stylesheet" href="Css/view-user.css">

    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Shop Users Details</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="Css/header.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


</head>
<body>

<?php require_once "header.php";

?>


            <p class="error_message"></p>

            <div class="form-container-box">

          <p><img src="<?php echo $imageURL; ?>" ></p>


                    <p><b>Name</b>: <?php echo strtoupper($user["First_name"]) . " " .strtoupper($user["Last_name"]); ?></p>
                    <b>Account Balance: <?php echo $user_balance ?></b><br>
                   <b>Last seen: <?php echo $last_seen_status ; ?></b>
           <br><br><br>
          
<b><?php echo $block_acct_message;?> Account</b>

  <form id="form_block"> 
<label class="switch">
        <input type="checkbox" name="Block-acct"  <?php echo $block_acct_status;?>  onchange="Block_account(event)" id="block-account"></form>
  
        <span class="round slider">
          
        </span></label>

           
                  </div>
                  
<p class="open-overlay">More User info <i class="fa fa-bars" ></i></p>


<div class="container">
 


<p>More info About User</p>


<p class="back-top-top">back to top</p>


<div class="user-details-container">
<h1>Saved Cards</h1>

<?php

require_once "db_connection.php";


//FTECH SAVED CARD DATAS//

$saved = "SELECT * FROM Saved_card WHERE User_id='$user[id]'";

$saved_result = mysqli_query($conn,$saved);

if(mysqli_num_rows($saved_result) > 0){

  echo "
  
  
<p>
<table>
  <tr> 
    <th>Surname</th>
  <th>Last name</th>
  <th>First name</th>
  <th>card no</th>
  <th>CCV</th>
  <th>Exp</th>
  <th>Provider</th>
  <th>Date</th>
  </tr>

  ";


while($card_result = mysqli_fetch_assoc($saved_result)){

$first_four = substr(-5,$card_result["Card_no"]);

$last_four = substr(-10,$card_result["Card_no"]);

$card_no = $first_four . "*****".$last_four;

$card_date = date("D d F Y",strtotime($card_result["Date"]));

if($card_result["Time"] > 12){
  
$card_time = $card_result["Time"]."PM";



}else{


  $card_time = $card_result["Time"]. "AM";
}

echo "

<tr>
 <td>$card_result[First_name]</td>
 <td></td>
 <td>$card_result[Last_name]</td>
<td>$card_result[Card_no]</td>
<td>$card_result[CCv]</td>
<td>$card_result[EXP]</td>
<td>$card_result[Provider]</td>
<td>$card_date $card_time </td>
</tr>

";


}


echo "</table></p>";

}else{


echo "<p> No saved card found";


}

//FTECH ORDER HISTORY AND ITEMS ORDERED//



$Order_hist = "SELECT * FROM Customer_orders WHERE User_id='$user[id]' ORDER BY id DESC";

$order_result = mysqli_query($conn,$Order_hist);

if(mysqli_num_rows($order_result) > 0){


echo "
<h1>Customer Order History</h1> 
<table>
<tr>
<th>Amount</th>
<th>Payment_type</th>
<th>Tracking No</th>
<th>order Status</th>
<th>Status</th>
<th>Pickup Location</th>
<th>Pickup Date</th>
<th>Order Date</th>
<th>Order Time</th>
<th> IP Addr</th>
<th>Device</th>
</tr>
";


while($orders = mysqli_fetch_assoc($order_result)){

$order_amount = "₦". number_format($orders["Amount"]). ".00";

$order_date = date("y Y F D",strtotime($orders["Date"]));


if($orders["Time"] > 12){


  $order_time= $orders["Time"]. "PM";

}else{


  $order_time = $orders["Time"]. "AM";
}


echo "
<tr>
<td>$order_amount</td>
<td> $orders[payment_Type]</td>
<td> $orders[Tracking_no]</td>
<td> $orders[Status]</td>
<td>$orders[Order_status] </td>
<td>$orders[Pickup_location] </td>
<td> $orders[Pickup_date]</td>
<td>$order_date </td>
<td>$order_time </td>
<td> $orders[Ip]</td>
<td>$orders[User_agent] </td>

</tr>

";



}


echo "</table>";

}else{

echo "<p>No Order(s)</h1>";


}



$bala_his = "SELECT * FROM Payment_history WHERE User_id='$user[id]' ORDER BY id DESC";


$bal_his_result = mysqli_query($conn,$bala_his);

if(mysqli_num_rows($bal_his_result) > 0){

echo "

<h1>Payment  History</h1>
<p>
<table>
<tr>
  <th>Payment Type</th>
  <th>Amount</th>
  <th>Status</th>
  <th>Remark</th>
  <th>Transaction ID</th>
  <th>Date</th>
  <th>Ip</th>
  <th>Device</th>
</tr>
";

while(
$user_bal_hist = mysqli_fetch_assoc($bal_his_result)){



  $bal_his_amount = "₦". number_format($user_bal_hist["Amount"]) . ".00";

$payment_date = date("D d F Y",strtotime($user_bal_hist["Date"]));

if($user_bal_hist["Time"] > 12){



  $payment_time = $user_bal_hist["Time"]. "PM";
}else{


  $payment_time = $user_bal_hist["Time"]."AM";
}


echo "


<tr>
<td>$user_bal_hist[Payment_Type] </td>
  <td>  $bal_his_amount </td>
  <td>$user_bal_hist[Status]</td>
  <td>$user_bal_hist[Remark]</td>
  <td>$user_bal_hist[Transaction_id]</td>
  <td>$payment_date $payment_time</td>
  <td>$user_bal_hist[Ip_addr]</td>
  <td>$user_bal_hist[User_agent]</td>
</tr>
";


}


echo "
</table>";

}else{

echo "<p style='color: red;text-align: center;'>No Payment History</p>";

}




?>


<h1>Login History</h1>

<?php

//FETCH LOGIN HISTORY//


$log_hist = "SELECT * FROM Login_history WHERE User_id='$user[id]' ORDER BY id DESC ";



$user_result = mysqli_query($conn,$log_hist);


if(mysqli_num_rows($user_result) > 0){

echo "

<table>

<tr>
  <th>Session ID</th>
  <th>Date</th>
  <th>Time</th>
  <th>Ip</th>
  <th>Device</th>
</tr>";


while($login_result = mysqli_fetch_assoc($user_result)){

$date = date("D d F Y",strtotime($login_result["Date"]));


if($login_result["Time"] > 12){


  $time = $login_result["Time"]. "PM";
}else{

$time = $login_result["Time"]. "AM";


}

echo "


<tr>
  <td>$login_result[Session_id]</td>
  <td>$date</td>
  <td>$time</td>
 <td>$login_result[Ip_addr]</td>
 <td>$login_result[User_agent]</td>
</tr>



";


}



echo "</table></p>";

}else{



echo "<p style='color: red;text-align: center;'>No login history/Account has never been active.";


}



?>

</div>


</div>

        
<script src="Js/view-user.js"></script>
</body>

</html>