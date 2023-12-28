<?php  
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

if (isset($_POST["email"])){

if(isset($_POST["password"])){


    $email =htmlspecialchars($_POST["email"]);

    $password = htmlspecialchars($_POST["password"]);

if(empty($email)){

//$message_status = "Email cannot be empty.";
//$reponse_message = "<i class='fa fa-refresh'></i> Refresh";

    //require_once __DIR__.("/failed.php");

    die("Email cannot be blank");


}else if (!filter_var ($_POST["email"],FILTER_VALIDATE_EMAIL)){


  //  $message_status = "Invalid email address.";
    //$reponse_message = "<i class='fa fa-refresh'></i> Refresh";

      //  require_once __DIR__.("/failed.php");
    
        die("Invalid Email address");
    



}


if(empty($password)){


    //$message_status = "Password cannot be blank.";
   // $reponse_message = "<i class='fa fa-refresh'></i> Refresh";
    
        //require_once __DIR__.("/failed.php");
    
        die("Please enter password");
    




}else if(!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",$password)){


        die("Password must contain at least one uppercase,one lowercase,one special character and at least 8 in length.");
    




}


if(isset($_POST["terms"])){

    $terms = filter_var($_POST["terms"],FILTER_SANITIZE_STRING);

$terms = htmlspecialchars($terms);


if(empty($terms)){



die("Agree to our terms");


}else if(!$terms == "Yes"){


die("Invalid Terms");




}else{




    $terms = htmlspecialchars($terms);
}




}else{

die("Please accept our Terms and Conditions.");


}


//CHECK IF USER EXITS//



require_once "database_connection.php";

$email = mysqli_real_escape_string($conn,$email);

$check = "SELECT * FROM Register_db WHERE Email='$email' ";




$result = mysqli_query($conn,$check);


if(mysqli_num_rows($result) > 0){


die("User already exits.Email <b>".$email ."</b> Already exits,please use another email.");



}else{

//DO NOTHING/



}



$date = htmlspecialchars(date("Y/m/d H:i:s"));

$time = htmlspecialchars(date("H:i:s"));

$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);

$status = "pending";

$name ="";

//$user_agent = $_SERVER["HTTP_USER_AGENT"];



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





$terms ="Yes";

$hash = password_hash($password,PASSWORD_DEFAULT);

$tel ="";

$address = "";
$date_edit = "";

require_once "database_connection.php";

$terms = mysqli_real_escape_string($conn,$terms);

$uniqueID = uniqid(). rand(123,1294). uniqid();

$insert = "INSERT INTO Register_db (

    First_name,Last_name,Email,Password,Terms,Date,Time,Ip_addr,Status,User_agent,Tel	
    ,Address,Date_edit,uniqueID)
    VALUES('$name','$name','$email','$hash','$terms','$date','$time','$ip','$status',
    '$user_agent','$tel','$address','$date_edit','$uniqueID')";
    


if (mysqli_query($conn,$insert)){

 die("success");


}else{

 die("Server error,please try again.");

}


}





}




mysqli_close($conn);


}

