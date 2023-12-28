<?php
require_once "sessionPage.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

}



if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST["payment_type"])){


//CHECK IF ITS CARD PAYMENT OR BALANCE PAYMENT OR SAVED CARD PAYMENT/
$payment_type = filter_var($_POST["payment_type"],FILTER_SANITIZE_STRING);


$payment_type = htmlspecialchars($payment_type);


if($payment_type == "Type_card"){


//USER IS USING A NEW DEBIT CARD TO MAKE PAYMENT//

echo "card";




}else if($payment_type == "Type_balance"){


//USER IS USING THEIR ACCOUNT BALANCE AS PAYMENT TYPE//




//echo "Balance";


$date = htmlspecialchars(date("Y/m/d H:i:s"));
$time = htmlspecialchars(date("H:i:s"));
$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);
//$User_agent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);



$isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"tablet"));


$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"mobile"));



$isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"windows"));


$isAndriod = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"andriod"));


$isIphone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"iphone"));


$isIpad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),"ipad"));


$isIos= $isIpad || $isIphone;



if($isMob){

if($isTab){

    $agent = "Tablet";

}else{


    $agent = "Mobile";
}

}else{

    $agent = "Desktop";
}

if($isIos){

    $user_agent = $agent. " Iphone IOS";
}else if($isAndriod){

$user_agent = $agent . " Andriod";

}else{

$user_agent = $agent. " Windows";

}




if(!isset($_SESSION['delivery_location'])){


    die("Please select a Delivery Location");
    
}



$payment_type = "Balance";
//PRCOCCESS PAYMENT FOR TESTING ONLY
$total = $_SESSION["TOTAL_price"];

$bal = "SELECT * FROM Account_balance WHERE User_id ='$_SESSION[User]'";


$bal_result = mysqli_query($conn,$bal);


if(mysqli_num_rows($bal_result) > 0){



    $balance = mysqli_fetch_assoc($bal_result);

$from = $balance["Balance"];

$tracking_no = rand();

$transaction_id =rand();

$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);




    if($balance["Balance"] >= $_SESSION["TOTAL_price"]){


        //USER BALANCE IS SUFFICIENT//


        //DEBIT USER BALANCE AND PLACE CUSTOMER ORDER//

        $new_balance = $balance["Balance"] - $_SESSION["TOTAL_price"];


        $to = $new_balance;

        if(isset($balance["Hash_id"])){

        
        $hash = $balance["Hash_id"];
        }else{

            $hash = rand();
            $hash = password_hash($hash,PASSWORD_DEFAULT);
        }
        //NOW UPDATE BALANCE AND PLACE ORDER//


        $update = "UPDATE Account_balance SET Balance='$new_balance' WHERE User_id ='$_SESSION[User]'";

        if(mysqli_query($conn,$update)){


//NOW UPDATE BALANCE HISTORY//

$insert = "INSERT INTO Account_balance_history(User_id,Balance,From_bal,To_bal,Hash_id,Date,Time)

VALUES('$_SESSION[User]','$balance[Balance]','$from','$to','$hash','$date','$time')
";


if(mysqli_query($conn,$insert)){

//INSERT INTO PAYMENT HISTORY SO THAT CUSTOMERS CAN SEE THEIR PAYMENTS


//NOW PLACE THE OTHER AND SEND ORDER REQUEST SO ADMIN CAN SEE ORDER//
$staus = "success";
$order_status = "confirm";

$pickup_date =date_create(date("Y/m/d"));

//$pickup_date = ($pickup_date);

//AUTOMATICALLY SCHEDULE PICKUP DATE IN FOUR DAYS TIME//

date_add($pickup_date,date_interval_create_from_date_string("4 day"));

$pickup_date = date_format($pickup_date,"Y-m-d");



$ORDERS = "INSERT INTO Customer_orders(
    User_id,Amount,payment_Type,Transation_id,Tracking_no,Status,Order_status,Items	
    ,Pickup_location,Pickup_date,Date,Time,Ip,User_agent)
    
    VALUES('$_SESSION[User]','$_SESSION[TOTAL_price]','$payment_type','$transaction_id','$tracking_no',
    '$staus'
    ,'$order_status','','$_SESSION[delivery_location]','$pickup_date','$date','$time','$ip','$user_agent'
    )
    ";

if(mysqli_query($conn,$ORDERS)){


//NOW INSERT INTO PAYMENT HISTORY TO FINALLY COMPLETE TRANSACTION//

$remark = "- Debit";
$seesion_id = session_id();

$payment = "INSERT INTO Payment_history(

User_id,Amount,Payment_provider,Admin_id,Remark,Status,Session_id,Date,Time,Ip_addr	
,User_agent,Payment_Type,Transaction_id
)
VALUES('$_SESSION[User]','$_SESSION[TOTAL_price]','Lazerwave','0','$remark','$staus',
'$seesion_id','$date','$time','$ip','$user_agent','$payment_type','$transaction_id')
";


if(mysqli_query($conn,$payment)){


    foreach($_SESSION['cart_items'] as $x => $x_value){
        
        $product_name = $x_value["Product_name"];
        
        $product_price =$x_value["Product_price"];
        
        $product_quantity = $x_value["Product_quantity"];
        
        $product_image = $x_value["Product_image"];
        
        $product_id = $x_value["Product_id"];
    
        
    $add_image = "INSERT INTO Items_order(
    
        User_id,Tracking_no,Item_name,Item_price,Image_path,Quantity,Date,Time	
        
        )
        VALUES('$_SESSION[User]','$tracking_no','$product_name','$product_price',
        '$product_image','$product_quantity','$date','$time')
        ";
    
    }
    
    //mysqli_multi_query
    
    if(mysqli_query($conn,$add_image)){
    
       
    //CLEAR CART ITEMS//

    unset($_SESSION["cart_items"]);

    $_SESSION['Tracking_no'] = $tracking_no;
    
    $_SESSION["Order_success"] ="success";

    die("success");
    
    
    }else{
    
    
        die("Error Proccessing your payment due to Network downtime,please try please try again");
    
    }





}else{


die("An unknown error has occured,Please try again");

}

}else{


    die("Failed to place order,please try again to contiune");


}


}else{



    die("Failed to complete payment due to an unknown Error,Please try again");


}

        }else{


            die("Error occur while trying to complete payment");
        }


    }else{

//PLACE ORDER BUT STORE RECORD AS A FAILED TRANSACTION JUST INCASE OF SYSTEM ERROR//


$staus = "Failed";

$order_status = "Cancel";
$payment_type = "Balance";


$ORDERS = "INSERT INTO Customer_orders(
    User_id,Amount,payment_Type,Transation_id,Tracking_no,Status,Order_status,Items	
    ,Pickup_location,Pickup_date,Date,Time,Ip,User_agent)
    
    VALUES('$_SESSION[User]','$_SESSION[TOTAL_price]','$payment_type','$transaction_id','$tracking_no',
    '$staus'
    ,'$order_status',' ','$_SESSION[delivery_location]','','$date','$time','$ip','$user_agent'
    )
    ";
    
    if(mysqli_query($conn,$ORDERS)){
    
    
$remark = "- Debit";
$seesion_id = session_id();

$payment = "INSERT INTO Payment_history(

User_id,Amount,Payment_provider,Admin_id,Remark,Status,Session_id,Date,Time,Ip_addr	
,User_agent,Payment_Type,Transaction_id
)
VALUES('$_SESSION[User]','$_SESSION[TOTAL_price]','Lazerwave','0','$remark','$staus',
'$seesion_id','$date','$time','$ip','$user_agent','$payment_type','$transaction_id')
";


if(mysqli_query($conn,$payment)){


//INSERT ITEMS TO SHOPPING LIST//




foreach($_SESSION['cart_items'] as $x => $x_value){

    //var_dump($x_value);
    
    $product_name = $x_value["Product_name"];
    
    $product_price =$x_value["Product_price"];
    
    $product_quantity = implode($x_value["Product_quantity"]);
    
    $product_image = $x_value["Product_image"];
    
    $product_id = $x_value["Product_id"];



    
   
   
$add_image = "INSERT INTO Items_order(

    User_id,Tracking_no,Item_name,Item_price,Image_path,Quantity,Date,Time	
    
    )
    VALUES('$_SESSION[User]','$tracking_no','$product_name','$product_price',
    '$product_image','$product_quantity','$date','$time')
    ";




}

if(mysqli_multi_query($conn,$add_image)){

    die("insufficent balance,Please topup.");


}else{


    die("Error caught please try please try again");

}



}else{


die("An unknown error has occured,Please try again");

}
      
       


    }else{
    
    
        die("Failed to place order,please try again to contiune");
    
    
    }






    }


}else{


    die("Error proccessing your payment");
}


}else{


if($payment_type == "Type_saved"){

//USER IS USING A SAVED CARD//


echo "saved";



}else{


die("<b style='color: red;'>Please select a payment type");



}






}




//END OF CHECK IF USER SELECT A PAYMENT METHOD//

    
    }else{


//USER CHANGE THE INPUT TYPE NAME//

die("<b style='color: red;'>Error loading payment method,please select a payment method.</b>");




    }








}


