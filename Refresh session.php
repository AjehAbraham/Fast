<?php
session_start();


if(isset($_SESSION["User"])){


header("Location: home");



}else{




    if(isset($_COOKIE["Ray_id"])){

        if(!empty($_COOKIE["Master_id"])){
        
        
        if(!empty($_COOKIE["Ray_id"])){
        
        
        //CHECK IS COOKIE VALUES MATCH//
        
        $userId = (int) filter_var($_COOKIE["Master_id"],FILTER_VALIDATE_INT);



        
        if(empty($userId)){
        
        
        //USER HAS TEMPER WITH COOKIE SO UNSET IT//
        
        
        
        
        }else{
        
        
        
        $userId = htmlspecialchars($userId);
        
        
        $hash =htmlspecialchars($_COOKIE["Ray_id"]);
        
        
        
        require_once "database_connection.php";


$check_record = "SELECT * FROM Register_db WHERE id='$userId'";


$results = mysqli_query($conn,$check_record);



if(mysqli_num_rows($results) > 0){

 $result = mysqli_fetch_assoc($results);   

$email =$result["Email"];

$name = $result["First_name"];

$_SESSION["Refresh-session"] = rand();

require_once "Login.php";



}else{



    header("Location: Home");
    exit;


}


        

        }
    }
}
    }



//header("Location: Home");
//exit;

}
