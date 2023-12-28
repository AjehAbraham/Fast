<?php  
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;
}



$verify = "SELECT * FROM Login_history WHERE User_id='$_SESSION[User]' ORDER BY id DESC LIMIT 1 ";


$verify_result = mysqli_query($conn,$verify);


$check_login = mysqli_fetch_assoc($verify_result);



if($check_login["Session_id"] === session_id()){



//DO NOTHING BECAUSE THE SESSION IS VALID//


}else{


//SESSION IS FAKE OR USER HAS LOGIN WITH ANOTHER BROWSER//

unset($_SESSION["User"]);

//header("Location: Refresh session");


}



$check_status = "SELECT * FROM Block_user_acct WHERE User_id='$_SESSION[User]'
ORDER BY id DESC LIMIT 1";


$block_status = mysqli_query($conn,$check_status);


if(mysqli_num_rows($block_status) > 0){



    $block_result = mysqli_fetch_assoc($block_status);


if($block_result["Status"] == "Block"){



    //die("Your account has been restricted for violating our Terms and Conditions,if you feel this was a mistake/Error
   // please contect us <a href='mailto:Ajehabraham51@gmail.com'>Here</a>.");

   header("Location: logout");
   exit;
}



}else{

//DO NOTHINH//


}
