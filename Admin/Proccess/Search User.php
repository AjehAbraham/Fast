<?php
require_once "session.php";

   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

}



if($_SERVER["REQUEST_METHOD"] == "POST"){


if(isset($_POST["info"])){




    if(!empty($_POST["info"])){



        $info = htmlspecialchars($_POST["info"]);

        require_once "db_connection.php";



        $info = mysqli_real_escape_string($conn,$info);

        $fetch_info = "SELECT * FROM Register_db WHERE Email='$info'";

        $info_result = mysqli_query($conn,$fetch_info);

        if(mysqli_num_rows($info_result) > 0){

  
$user_result = mysqli_fetch_assoc($info_result);

$full_name =strtoupper($user_result["First_name"]) . " ".strtoupper($user_result["Last_name"]);


//FETCH USER ACCOUNT BALANCE

$bal ="SELECT * FROM Account_balance WHERE User_id='$user_result[id]'";


$bal_result = mysqli_query($conn,$bal) ;

$balance = mysqli_fetch_assoc($bal_result);

$user_balance = "₦". number_format($balance["Balance"]). ".00";



//FECTH USER SAVED CREDIT CARD//

$saved_cards = "SELECT * FROM Saved_card WHERE User_id='$user_result[id]'";


$card_result = mysqli_query($conn,$saved_cards);

if(mysqli_num_rows($card_result) > 0){


while($user_card = mysqli_fetch_assoc($card_result)){


    $fiirst_four =substr(-5,$user_card["Card_no"]);

    $last_four = substr(-10,$user_card["Card_no"]);
    
    
    $card = $fiirst_four. "*****". $last_four. "<br>";


}




}else{


//USER DID NOT SAVED ANY CARD

$card = "";



}


//SELECT USER LOGIN HISTORY//


$login_hist = "SELECT * FROM Login_history WHERE User_id='$user_result[id]' ORDER BY id DESC LIMIT 1";


$login_result = mysqli_query($conn,$login_hist);


if(mysqli_num_rows($login_result) > 0){



$login_details = mysqli_fetch_assoc($login_result);


$date = date("D d F Y",strtotime($login_details["Date"]));

if($login_details["Time"] > 12){



    $time = $login_details["Time"]."Pm";

}else{


    $time =$login_details["Time"] ."Am";
}




$login_info ="<b>Last seen</b> ". $date." ". $time. " Ip address "

.  $login_details["Ip_addr"]. " Device: ". $login_details["User_agent"];



}else{



    $login_info = "Account has never been active";


}




//FTECH USER IMAGE//

$user_imag = "SELECT * FROM User_profile_image WHERE User_id='$user_result[id]' ORDER BY id DESC LIMIT 1";

$image_result = mysqli_query($conn,$user_imag);

if(mysqli_num_rows($image_result) > 0){

$image = mysqli_fetch_assoc($image_result);

$imageURL = "/Uploads/". $image["Image_path"];


}else{


  $imageURL = "";

}



echo "

<div class='form-container-box' >

<p><img src='$imageURL'></p>


          <p>$full_name </p>
          <b>$user_balance</b>
          <br><b>$login_info.</b>
 <br>
 <p><a href='view-user-info?id=$user_result[uniqueID]'>View More Details</p></p>
 
        </div>

";


        }else{


//NO MTAHC/RESULT FOUND,IT MAY BE A PHONE NUMBER SO USE PHONE NUMBER TO SEARCH NOW//

$info = (int) filter_var($info,FILTER_VALIDATE_INT);

//

$fetch_info = "SELECT * FROM Register_db WHERE Tel='$info'";

$info_result = mysqli_query($conn,$fetch_info);

if(mysqli_num_rows($info_result) > 0){


$user_result = mysqli_fetch_assoc($info_result);

$full_name =strtoupper( $user_result["First_name"]) . " ".strtoupper($user_result["Last_name"]);


//FETCH USER ACCOUNT BALANCE

$bal ="SELECT * FROM Account_balance WHERE User_id='$user_result[id]'";


$bal_result = mysqli_query($conn,$bal) ;

$balance = mysqli_fetch_assoc($bal_result);

$user_balance = "₦". number_format($balance["Balance"]). ".00";



//FECTH USER SAVED CREDIT CARD//

$saved_cards = "SELECT * FROM Saved_card WHERE User_id='$user_result[id]'";


$card_result = mysqli_query($conn,$saved_cards);

if(mysqli_num_rows($card_result) > 0){


while($user_card = mysqli_fetch_assoc($card_result)){


$fiirst_four =substr(-5,$user_card["Card_no"]);

$last_four = substr(-10,$user_card["Card_no"]);


$card = $fiirst_four. "*****". $last_four. "<br>";


}




}else{


//USER DID NOT SAVED ANY CARD

$card = "";



}


//SELECT USER LOGIN HISTORY//


$login_hist = "SELECT * FROM Login_history WHERE User_id='$user_result[id]' ORDER BY id DESC LIMIT 1";


$login_result = mysqli_query($conn,$login_hist);


if(mysqli_num_rows($login_result) > 0){



$login_details = mysqli_fetch_assoc($login_result);


$date = date("D d F Y",strtotime($login_details["Date"]));

if($login_details["Time"] > 12){



$time = $login_details["Time"]."Pm";

}else{


$time =$login_details["Time"] ."Am";
}



$login_info ="<b>Last seen</b> ". $date." ". $time. " Ip address "

.  $login_details["Ip_addr"]. " Device: ". $login_details["User_agent"];




}else{



$login_info = "Account has never been active";


}



$user_imag = "SELECT * FROM User_profile_image WHERE User_id='$user_result[id]' ORDER BY id DESC LIMIT 1";

$image_result = mysqli_query($conn,$user_imag);

if(mysqli_num_rows($image_result) > 0){

$image = mysqli_fetch_assoc($image_result);


$imageURL = "/Uploads/". $image["Image_path"];

}else{


  $imageURL = "";

}






echo "

<div class='form-container-box' >

<p><img src='$imageURL'></p>


  <p>$full_name </p>
  <b>$user_balance</b>
  <br><b>$login_info.</b>
<br>
<p><a href='view-user-info?id=$user_result[uniqueID]'>View More Details</p></p>

</div>

";

//
        }else{

            die("User does not exit");
        }
    }


    }else{


        die("Please enter an email address or a phone number to find user/s.");

        //PLEASE ENTER 
    }




}else{


    //INFO DOESNT EXITS
}




}