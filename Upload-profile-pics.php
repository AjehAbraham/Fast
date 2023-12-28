<?php
require_once "sessionPage.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){



if(empty($_FILES["item-image"])){


    die("Please select an image");
}


    $filename ="(". $_SESSION["User"].")" .rand(). uniqid();


    $finfo = new finfo(FILEINFO_MIME_TYPE);

    $mime_type = $finfo -> file($_FILES["item-image"]["tmp_name"]);

    $mime_types =["image/gif", "image/png", "image/jpeg"];
    
    
    if(!in_array($_FILES["item-image"]["type"],$mime_types)){
    
    
    exit("invalid file type");
    
    
    }
    $pathinfo = pathinfo($_FILES["item-image"]["name"]);
    
    $base = $pathinfo["filename"];
    
    //$base = preg_replace("]", "_", $base);
    
    $filename =$filename. $base . "." . $pathinfo["extension"];
    
    $destination = __DIR__. "/Uploads/" . $filename;
    
    $i = 1;   
    
    while (file_exists($destination)){
    
    $filename =$filename. $base . "($i)." .$pathinfo["extenstion"];
    
    $destination  = __DIR__ . "/Uploads/" . $filename;
    
    $i++;
    
    } 
    
    
    if (! move_uploaded_file($_FILES["item-image"]["tmp_name"],$destination)){
    
    exit("fail to upload file");
    
    }else{
    
        
    
    require_once __DIR__.("/database_connection.php");
    
    
$date = htmlspecialchars(date("Y/m/d H:i:s"));
$time = htmlspecialchars(date("H:i:s"));
$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);
//$User_agent = htmlspecialchars($_SERVER["HTTP_USER_AGENT"]);
$session_id = session_id();




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



$insert = "INSERT INTO User_profile_image(User_id,Image_path,Date,Time,Ip_addr,User_agent	
)
VALUES('$_SESSION[User]','$filename','$date','$time','$ip','$user_agent')
";

if(mysqli_query($conn,$insert)){

die("success");

}else{

die("Fail to Upload file ". mysqli_error($conn));


}

    
    
    mysqli_close($conn);
    }
    



}else{


    header("Location: Error");
    exit;
}
