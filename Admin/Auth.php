<?php
session_start();
if(isset($_SESSION{"Admin_key"})){


    header("Location: Home");
    exit;
}else{

    session_regenerate_id();



    if(isset($_COOKIE["Remember-admin"]) && isset($_COOKIE["Admin_hash_key"])){

        if(!empty($_COOKIE["Remember-admin"]) && !empty($_COOKIE["Admin_hash_key"])){
        
        

$admin_id = (int) filter_var($_COOKIE["Remember-admin"],FILTER_VALIDATE_INT);
$admin_id = htmlspecialchars($admin_id);

$hash = htmlspecialchars($_COOKIE["Admin_hash_key"]);

$admin_id = stripslashes($admin_id);
$hash = stripslashes($hash);


require_once "db_connection.php";

$admin_id = mysqli_real_escape_string($conn,$admin_id);

$hash = mysqli_real_escape_string($conn,$hash);


$check_db = "SELECT * FROM Admin_Auth_table WHERE Admin_id='$admin_id'  ORDER BY id DESC LIMIT 1";

$result = mysqli_query($conn,$check_db);


if(mysqli_num_rows($result) > 0){

$results = mysqli_fetch_assoc($result);

if($results["Expire"] >= 1){

    //UNSET COOKIE/AUTH KEY HAS BEEN USED BEFORE AND YOU NEED TO UNSET IT//


    unset($_COOKIE["Remember-admin"]);
    unset($_COOKIE["Admin_hash_key"]);
    
    setcookie("Remember-admin","", time() - 86400,"/");
    
    setcookie("Admin_hash_key","", time() - 86400,"/");

    //YOU CAN INFORM USER OF LOGIN ATTEMPT OR FAILED LOGIN ATTEMPTS//


    
header("Location: Login");
exit;    


}

if(password_verify($hash,$results["Hash_id"]) == "password_hash" && $results["Cookie_hash"] == $hash){


    $_SESSION["Admin_key"] = $results["Admin_id"];   


//UPDATE AUTH TABLE AND SET EXPIRE TO 1

$update = "UPDATE Admin_Auth_table SET Expire ='1' WHERE Admin_id='$results[Admin_id]' AND Cookie_hash='$hash'";


if(mysqli_query($conn,$update)){

//DO NOTHING//

}else{


   // echo mysqli_error($conn);

header("location: Home");
exit;
}


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



$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);

$otp = rand(649273,927474);

$session_id = session_id();

$session_hash = session_id();

$_SESSION["Admin_hash"] = $session_hash;

$date = htmlspecialchars(date("Y/m/d H:i:s"));

$time =htmlspecialchars(date("H:i:s"));

$satus ="success";



$insert = "INSERT INTO Admin_Login_history(

Admin_id,Status,Hash,Session_id,Date,Time,Ip,User_agent
)
VALUES('$_SESSION[Admin_key]','$satus','$session_hash','$session_id','$date','$time','$ip','$user_agent')

";

if(mysqli_query($conn,$insert)){



}else{

//FAILED TO INSERT//

//echo mysqli_error($conn);

}



unset($_COOKIE["Remember-admin"]);
unset($_COOKIE["Admin_hash_key"]);

setcookie("Remember-admin","", time() - 86400);

setcookie("Admin_hash_key","", time() - 86400);



require_once "Remember-me.php";

$_SESSION["Admin_id"] = $_SESSION["Admin_key"];


header("Location: Home");
exit;


}else{



        


}


}else{

//NO MATCH FOUND JUST UNSET USER COOKIE//

        
unset($_COOKIE["Remember-admin"]);
unset($_COOKIE["Admin_hash_key"]);

setcookie("Remember-admin","", time() - 86400);

setcookie("Admin_hash_key","", time() - 86400);


header("Location: Login");
exit;

}
       
        
        }else{
        
        
        
        //CHECK DATAS
        
        unset($_COOKIE["Remember-admin"]);
        unset($_COOKIE["Admin_hash_key"]);
        
        setcookie("Remember-admin","", time() - 86400);
        
        setcookie("Admin_hash_key","", time() - 86400);
        
header("Location: Login");
exit;

        }
        

      /*  unset($_COOKIE["Remember-admin"]);
        unset($_COOKIE["Admin_hash_key"]);
        
        setcookie("Remember-admin","", time() - 86400);
        
        setcookie("Admin_hash_key","", time() - 86400);*/
    }        





}