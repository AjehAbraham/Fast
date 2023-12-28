<?php

require_once "session.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

header('HTTP/1.0 403 Forbiddden',TRUE,403);
die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



$item_name = $item_price = $item_discount_price = $item_image =$image_name = "";



if ($_SERVER["REQUEST_METHOD"] == "POST"){

  $item_name  = filter_var($_POST["item-name"], FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);

  if (empty($item_name)){

    die("Enter item name");

  }

  $item_price  =(int) filter_var($_POST["item-price"], FILTER_VALIDATE_INT);

  
  if (empty($item_price)){

    die("Enter item price");

  }


$item_discount_price =(int) filter_var($_POST["item-discount-price"], FILTER_VALIDATE_INT);


if (empty($item_discount_price)){

  die("enter discount price");

}


$quantity = (int) filter_var($_POST["quantity"],FILTER_VALIDATE_INT);


if(empty($quantity)){


die("Please enter quantity");

}else{


    $quantity = htmlspecialchars($quantity);
}




$image_name =filter_var($_POST["image-name"],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);


if (empty($image_name)){

  die("Choose iamge name");

}

$round_no = rand(10000,999999) * 200000;

$image_name = htmlspecialchars($image_name) . $round_no ;

$item_description = htmlspecialchars($_POST["item-description"]);

if (empty($item_description)){

  die("Please describe this item or write little about this item.");

}
 

if(empty($_FILES)){

  die("please select an image");


}

if ($_FILES["item-image"]["size"] >= 1000000){
  
  die('file too large max(10mb)');
 
}


$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $finfo -> file($_FILES["item-image"]["tmp_name"]);
$mime_types =["image/gif", "image/png", "image/jpeg"];


if(! in_array($_FILES["item-image"]["type"],$mime_types)){


exit("invalid file type");


}
$pathinfo = pathinfo($_FILES["item-image"]["name"]);

$base = $pathinfo["filename"];

//$base = preg_replace("]", "_", $base);

$filename =$image_name . $base . "." . $pathinfo["extension"];

$destination = __DIR__. "/items-image/" . $filename;

$i = 1;   

while (file_exists($destination)){

$filename =$image_name . $base . "($i)." .$pathinfo["extenstion"];

$destination  = __DIR__ . "/items-image/" . $filename;

$i++;

} 


if (! move_uploaded_file($_FILES["item-image"]["tmp_name"],$destination)){

exit("fail to upload file");

}else{

    

require_once __DIR__.("/connection.php");

$image_name = mysqli_real_escape_string($conn,$image_name);

$item_description = mysqli_real_escape_string($conn,$item_description);

$item_discount_price = mysqli_real_escape_string($conn,$item_discount_price);

$item_name = mysqli_real_escape_string($conn,$item_name);

$filename = mysqli_real_escape_string($conn,$filename);

$quantity = mysqli_real_escape_string($conn,$quantity);


$time = htmlspecialchars(date("H:i:s"));

  $date =htmlspecialchars( date("Y/m/d H:i:s"));

  $ip =htmlspecialchars($_SERVER["REMOTE_ADDR"]);

$hash_id = uniqid().rand().uniqid();

$admin_id = $_SESSION["Admin_key"];




$ftech_type = "SELECT Type FROM Items_product_table ORDER BY id DESC LIMIT 1";


$type_result = mysqli_query($conn,$ftech_type);

if(mysqli_num_rows($type_result) > 0){


    $type_results = mysqli_fetch_assoc($type_result);


    if($type_results["Type"] == "1"){


        $type = "2";

    }else{


$type = "1";

    }

}else{

$type = 1;

}



$status = "Available";

$upload =  "INSERT INTO Items_Product_Table( 
  Product_name,Product_price,Product_old_price,Product_image,
  Product_description,Date_uploaded,Admin_id,Hash_id,Ip_addr,Time,Quantity,Type,Status)

  VALUES(
'$item_name','$item_price','$item_discount_price',
  '$filename','$item_description','$date','$admin_id','$hash_id','$ip','$time','$quantity',
  '$type',$status')
  
  ";
  if (mysqli_query($conn,$upload)){

    echo "ok";
    

  }else{

    echo mysqli_connect_error();
   // die("Fail to upload item");
   
  }



}
mysqli_close($conn);

}





?>