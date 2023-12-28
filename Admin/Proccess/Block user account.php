<?php
require_once "session.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){


header("Location: Error");
exit;

}elseif ($_SERVER["REQUEST_METHOD"] == "POST"){



    $date = htmlspecialchars(date("Y/m/d H:i:s"));

    $time = htmlspecialchars(date("H:i:s"));
    
    //$user_agent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);
    
    
    
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
    
    
    
    $ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);
    
//CHECK IF USER_ID IS SET//

if(!isset($_SESSION['View-user-id'])){


die("Invalid request type,reload page.");

}else{


    //$user_id = stripslashes($_SESSION['View-user-id']);

    $user_id = htmlspecialchars($_SESSION['View-user-id']);
}
/*
echo $user_id . "";

die();*/




if(isset($_POST["Block-acct"]) /* && !empty($_POST["Block-payment"])*/){



if($_SESSION["Admin_status"] == "Master" && $_SESSION["Admin_permit"] == "Granted"){

$user_id = $_SESSION['View-user-id'];

require_once "db_connection.php";

$check_status_b = "SELECT * FROM Block_user_acct  WHERE User_id='$user_id' ORDER BY id DESC LIMIT 1";



$block_result = mysqli_query($conn,$check_status_b);

if(mysqli_num_rows($block_result) > 0){


    $user_block_status = mysqli_fetch_assoc($block_result);

    if($user_block_status["Status"] == "Block"){


        $status_r = "UnBlock";

    }else{


        $status_r = "Block";
    }


}else{

//RESULT NOT FOUND SO BLOCK USER ACCOUNT//

$status_r = "Block";

}


    $insert = "INSERT INTO Block_user_acct(User_id,Status,Date,Time,Ip_addr,User_agent)
    VALUES('$user_id','$status_r','$date','$time','$ip','$user_agent')
    ";


if(mysqli_query($conn,$insert)){

    die($status_r);
    
    }else{
    
    
    die("Error completing your request,please try again shortly");
    
    }
}



}elseif(isset($_POST["Block-payment"]) /*&& !empty($_POST["Block-payment"])*/){


    if(!$_SESSION["Admin_status"] == "Master" && !$_SESSION["Admin_permit"] == "Granted"){

die("Authorization Failed.");

    }

    $user_id = $_SESSION['View-user-id'];

    $check_status = "SELECT * FROM Block_user_payment WHERE User_id='$user_id'
    ORDER BY id DESC LIMIT 1";
    
    
    $result = mysqli_query($conn,$check_status);
    
    
    if(mysqli_num_rows($result) > 0){
    
    
    
        $results = mysqli_fetch_assoc($result);
    
    
        if($results["Status"] == "Block"){
    
    
            $status = "UnBlock";

        }else if ($results["Status"] == "UnBlock"){
    
            $status = "Block";
        }
    
    }else{
    
    
        $status = "Block";
    }
    


    $insert = "INSERT INTO Block_user_payment(User_id,Status,Admin_id,Date,Time,Ip_addr,User_agent)
   VALUES('$user_id','$status','11208','$date','$time','$ip','$user_agent')
    ";

if(mysqli_query($conn,$insert)){

die($status);

}else{


die("Error completing your request,please try again shortly");

}




}else{


   // header("Location: Error");
   // exit;
}



}else{



    header("Location: Error");
    exit;
}