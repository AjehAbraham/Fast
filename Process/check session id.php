<?php
  
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

header('HTTP/1.0 403 Forbiddden',TRUE,403);
die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



$verify = "SELECT * FROM Login_history WHERE User_id='$_SESSION[User]' ORDER BY id DESC LIMIT 1 ";


$verify_result = mysqli_query($conn,$verify);


$check_login = mysqli_fetch_assoc($verify_result);



if($check_login["Session_id"] === session_id()){



//DO NOTHING BECAUSE THE SESSION IS VALID//


}else{


//SESSION IS FAKE OR USER HAS LOGIN WITH ANOTHER BROWSER//

unset($_SESSION["User"]);

//header("Location: Home");


}

