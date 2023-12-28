<?php
require_once "sessionPage.php";

   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



if($_SERVER["REQUEST_METHOD"] == "POST"){

$first_name = $last_name = $address = $tel ="";

if(isset($_POST["First_name"])){

if(isset($_POST["Last_name"])){


if(isset($_POST["Tel"])){

$first_name = filter_var($_POST["First_name"],FILTER_SANITIZE_STRING);

$last_name = filter_var($_POST["Last_name"],FILTER_SANITIZE_STRING);

$tel =(int) filter_var($_POST["Tel"],FILTER_VALIDATE_INT);

if(empty($first_name)){


die("Please enter your first name");



}else if(!preg_match("/^[A-Za-z-']*$/",$first_name)){


    die("Only letter are allowed for first name,please remove spaces,
    number or special character.");


}else{


$first_name = htmlspecialchars($first_name);


}


if(empty($last_name)){


    die("Please enter your last name");
    
    
    
    }else if(!preg_match("/^[A-Za-z-']*$/",$last_name)){
    
    
        die("Only letter are allowed for Last name,please remove spaces,
        number or special character.");
    
    
    }else{
    
    
    $last_name = htmlspecialchars($last_name);
    
    
    }
    
    


    if(empty($tel)){


        die("Please enter your Phone number or format is invalid");
        
        
        
        }else if(strlen($tel) < 9){
        
        
            die("Your phone number cannot be less than 10 digit.");
        
        
        }else{
        
        
if(strlen($tel) >= 11){


    die("Phone number cannot be greater than 10");


}else{


    $tel = htmlspecialchars($tel);
        


}


        
        }
        
        






if(isset($_POST["Address"])){


    $addrs = htmlspecialchars($_POST["Address"]);

//REMMEBER ADDREESS IS OPTIONAL//


if(!preg_match("/^[A-Za-z0-9,']*$/",$addrs)){
  

die("Only letters,numbers and comas(,)  are allowed.");

    
    }else{


  
    
        $addrs = htmlspecialchars($addrs);
    



    }
    

    
}


require_once "database_connection.php";

$first_name = mysqli_real_escape_string($conn,$first_name);

$last_name = mysqli_real_escape_string($conn,$last_name);

$tel = mysqli_real_escape_string($conn,$tel);

$addrs = mysqli_real_escape_string($conn,$addrs);

$date = htmlspecialchars(date("Y/m/d"));


$update = "UPDATE Register_db SET First_name='$first_name', Last_name ='$last_name',
 Tel='$tel', Address='$addrs' ,Date_edit ='$date' WHERE id='$_SESSION[User]'";


if(mysqli_query($conn,$update)){



    die("ok");



}else{


die("Server error");



}






}else{


//REMMEBER ADDREESS IS OPTIONAL


//die("okk");



}




}




}




}




