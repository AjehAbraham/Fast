<?php require_once "session.php";

if($result["Status"] == "Master"){


}else{
  
  die("<p>You cannot view this page,Access denied!</p>");
}


?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/edit-product.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Edit Item</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">

<link rel="stylesheet" href="Css/header.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


</head>
<body>

<?php require_once "header.php"; 


if($_SERVER["REQUEST_METHOD"] == "GET"){



    if(isset($_GET["name"])){


if(empty($_GET["name"])){

    die("<h1>Item id cannot be empty</h1>");
}else{


 $item_id = htmlspecialchars($_GET["name"]);

 require_once "db_connection.php";

 $item_id = mysqli_real_escape_string($conn,$item_id);

 $item_id = stripcslashes($item_id);

 $check_item = "SELECT * FROM Items_product_table WHERE Hash_id='$item_id' OR id='$item_id'";


 $item_result = mysqli_query($conn,$check_item);


 if(mysqli_num_rows($item_result) > 0){


$item = mysqli_fetch_assoc($item_result);

$imageURL = "items-image/".$item["Product_image"];

$price = number_format($item["Product_price"])."";

$price_r = $item["Product_price"];

$old_price =$item["Product_old_price"];

$date = date("D d F Y",strtotime($item["Date_uploaded"]));

if($item["Time"] > 12){

  $time = $item["Time"]."PM";
}else{

$time = $item["Time"]."AM";

}


if($item["Status"] == "Deleted"){

$edit_btn = "Add Item";

}else if($item["Status"] == "Available"){

$edit_btn = "Remove Item";

}else{

$edit_btn = "Remove Item";


}

require_once "Loader.php";

echo "

<div class='form-container-box'>

<p><img src='$imageURL' ></p>

<b>$item[Product_name]</b><br>
<b>₦$price.00 </b><br>
<b>Date Uploaded: $date $time
</b>

<br>
<br>
<p onclick="."alert('coming soon')"." id='remove-item'>$edit_btn</p>
<br>
</div>
";



if($item["Admin_id"] == $_SESSION["Admin_id"]){



echo "
<br>
<div class='form-container'>

<h1>Edit Item <i class='fa fa-edit'></i></h1>

<form id='edit-form-data'>

<input type='text' name='Hash' value='$item[Hash_id]' style='display: none;'>
<br>
<label><b>Edit name</b></label>
<br>
<input type='text' name='name' value='$item[Product_name]' placeholder='enter new name or Rer-name item....'><br>


<label><b>Item old price (₦)</b></label>
<br>
<input type='text' name='old-price' value='$old_price' placeholder='enter old price....'><br>


<label><b>Item New Price(₦)</b></label>
<br>
<input type='text' value='$price_r' name='price' placeholder='enter new price....'><br>


<label><b>Quantity(No of Available items)</b></label>
<br>
<input type='text' name='qty' value='$item[Quantity]' placeholder='How many do you have?.....'><br>

<label><b>Product Description</b></label>
<br>
<textarea cols='10' rows='6' name='des' placeholder='Product Description....'>$item[Product_description]</textarea>
<br>


</div>

<br>
<p class='open-transaction-pin'>Proceed</p>
";


//FETCH ITEM EDIT HISTORY//



$edit_his = "SELECT * FROM Product_items_edited WHERE Item_hash ='$item_id' ORDER BY id DESC";

$product_his = mysqli_query($conn,$edit_his);


if(mysqli_num_rows($product_his) > 0){

  echo "<h1 class='container'>Edit History</h1>";

  $times = mysqli_num_rows($product_his);

  echo "<p style='text-align: center;'>Item has been edited ".$times ." Time(s)</p>";

  
echo "
<table>
<tr>
<th>Admin ID</th>
<th>Edited From</th>
<th>Edited to</th>
<th>Edited By</th>
<th>Date Edited</th>
</tr>
";


while($product_result = mysqli_fetch_assoc($product_his)){

  $date = date("D d F Y",strtotime($product_result["Date"]));


  if($product_result["Time"]  > 12){
  
  
  $time =$product_result["Time"]. "PM";
  
  }else{
  
  
  
    $time = $product_result["Time"]."AM";
  }
  
  


echo "
<tr>
<td>$product_result[Admin_id]</td>
<td>$product_result[Edited_from]</td>
<td>$product_result[Edited_to]</td>
<td>$product_result[Edited_By]</td>
<td>$date $time</td>
</tr>

";


  }


  echo "</table>";
}else{


echo "<h1 style='text-align: center;font-size: 14px;'>No edit history</h1>";

}

////


}



 }else{


  die("<h1 style='text-align: center;color: red;'>Item cannot be found</h1>");


 }



}




    }else{

die("<h1>Invalid request type</h1>");


    }



    require_once "transaction-pin-box.php";
}

mysqli_close($conn);
?>





          <script src="Js/Edit product.js"> </script>



</body>

</html>