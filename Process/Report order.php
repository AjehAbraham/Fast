<?php


require_once "sessionPage.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){


if(isset($_POST["tracking-code"]) && isset($_POST["complains"])){



if(empty($_POST["tracking-code"])){


    die("Tracking Number cannot be empty");
}else{



    $tracking_no = (int) filter_var($_POST["tracking-code"],FILTER_VALIDATE_INT);


    $tracking_no = stripcslashes($tracking_no);

    $tracking_no = htmlspecialchars($tracking_no);

}



if(empty($_POST["complains"])){


    die("Please select complain options");

}else{

$compain = htmlspecialchars($_POST["complains"]);

$compain = stripcslashes($compain);

}


require_once "database_connection.php";


$tracking_no = mysqli_real_escape_string($conn,$tracking_no);

$compain = mysqli_real_escape_string($conn,$compain);


$date = htmlspecialchars(date("Y/m/d H:i:s"));

$time = htmlspecialchars(date("H:i:s"));

$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);


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


$status = "Pending";

$ticket_id = rand();
$type = "Order complain";

$insert = "INSERT INTO Customers_complain(
User_id,Ticket_id,Tracking_no,Complain,Type,Status,Date,Time,Ip,User_agent
)
VALUES('$_SESSION[User]','$ticket_id','$tracking_no','$compain','$type','$status','$date','
$time','$ip','$user_agent'
)";

if(mysqli_query($conn,$insert)) {


    echo "success";
}else{

die("Error has occured,Please try again");

}

}else{


    die("Invalid Request");
}





}