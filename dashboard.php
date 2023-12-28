<?php
require_once "sessionPage.php";


$full_name = $New_user["First_name"]  ." ". $New_user["Last_name"];

$full_name = strtoupper($full_name);

if($New_user["First_name"] == ""){

$name = "Chief!";
 $first_name ="";
$lastname = "";
$tel = "";

}else{


$name = $New_user["First_name"]. "!";

$first_name =  $New_user["First_name"];
$lastname =  $New_user["Last_name"];
$tel = $New_user["Tel"];
}

$bal ="SELECT * FROM Account_balance WHERE User_id ='$_SESSION[User]'";



$bal_result = mysqli_query($conn,$bal);


if(mysqli_num_rows($bal_result) > 0){


$bals = mysqli_fetch_assoc($bal_result);

$acct = "₦".number_format($bals["Balance"]). ".00";


}else{


$acct ="₦0.00";



}


$fetch_image = "SELECT * FROM User_profile_image WHERE User_id='$_SESSION[User]' ORDER BY id DESC LIMIT 1";

$dp_result = mysqli_query($conn,$fetch_image);

if(mysqli_num_rows($dp_result) > 0){


$profile = mysqli_fetch_assoc($dp_result);

$imageURL = "Uploads/". $profile["Image_path"];

$upload_option ="";


$edit = '';/*'<b style="margin-left: 35px">Edit</b>'*/;
}else{

  $edit = '';

  $imageURL = "Images/Null-image.png";
  
$upload_option = '
<input type="file" name="item-image" onchange ="loadFile(event)"
style="display:none;" id="file">
    
<p class="Add-image-btn" style="text-align: center;"><label for="file" onclick="upload(event)"> Upload image</p>

<input type="submit" value="Upload" id="Upload-btn">';


}
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/dashboard.css">
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Dashboard</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
<br>


<div class="sidebar">

<h1><span class="material-symbols-outlined" id="closeSideBar">
         cancel</span></h1>

  <a href="home"><p><i class="fa fa-home"></i> Home</p></a>
  <a href="order"><p><i class="fa fa-cart-arrow-down"></i> Orders </p></a>

  <a href="setting"> <p><i class="fa fa-cogs"></i> Setting</p></a>
 
  <a href="payment-history"><p><i class="fa fa-credit-card" style="margin-left: 15px"></i> Payment</p></a>

  <a href="Track-order" target="_blank"><p><i class="fa fa-tags" style="margin-left: 25px"></i> Track Order </p></a>
  
</div>






<div class="dashbaord-container">

  <p class="Open-sidebar-btn" onclick="openSidebar()"><i class="fa fa-bars"></i></p>
  <br>
  <br></div>
  <form id="Upload-form-data">

<p class="profile-image" ><img src="<?php echo $imageURL; ?>" style='border: 5px solid rgb(0,102,153);'
id="output" width="130px" accept="image" ><br><b style="cursor: pointer;"><?php echo $edit; ?></b></p>

<?php echo $upload_option; ?>

</form>
  </div>
<p style="color: red;" class="dp_error_message"></p>

<p style="color: #777;margin-left: 10px;">Hi <?php echo $name;?>&#9995;,Welcome Back!.</p>

</div>





<div class="balance-conatiner">
  <p class="hide_show_bt" onclick="showBal()"><i class='fa fa-eye'></i></p>

  <p class="account_balance"></p>
  <p class="Top_up-btn-top">Top up</p>
<p><a href="Withdrawal"> Withdraw</a></p>
</div>

<input type='hidden' value='<?php echo $acct; ?>' id='acct'>


<br>

<div class="form-container">
<h1> MyDetails</h1>

<p class="open-form-data-btn"><i class="fa fa-edit"></i> Edit</p>
  <label><b>Full Name</b></label>
  
  <input type="text" value="<?php echo $full_name; ?>" readonly id="f-name">
  <br>
  
  <label><b>Tel</b></label>
  
  <input type="text" value="<?php echo "+234". $New_user["Tel"];?>" readonly id="tel">
  <br>
  
  <label><b>E-mail</b></label>
  
  <input type="text" value="<?php echo $New_user["Email"];?>"  disabled>
  <br>


<div class="form-container-overlay-box">
<p><i class="fa fa-close" id="close-form-data-btn"></i></p>

  <h1>Edit Info <i class="fa fa-edit"></i></h1>
<form id="Edit-form-data">
  <label><b>Firstname</b></label>
  <input type="text" name="First_name" value="<?php echo $first_name;?>" placeholder="your firtsname...">
  <br>
  <label><b>Lastname</b></label>
  <input type="text" name="Last_name" value="<?php echo $lastname;?>" placeholder="your last name"><br>
  <label><b>Tel(+234)</b></label>
  <input type="tel" name="Tel" placeholder="+234 9005430030" value="<?php echo $tel;?>" inputmode="numeric" style="width: 66%;"><br>

  <label><b>Address(Optional)</b></label>
  <textarea name="Address" placeholder="your address...." ><?php echo $New_user["Address"]?></textarea>
  
<p class="Edit-data_error_message"></p>
  <input type="submit" value="Save changes">
  <br><br>
</form>

</div>
</div>





  
  <div class="credit-details-container">
    
  <h3>Payment Options</h3>

<?php 
  $saved_card = "SELECT * FROM Saved_card  WHERE User_id ='$_SESSION[User]'";




$card_result = (mysqli_query($conn,$saved_card));



if(mysqli_num_rows($card_result) > 0){


$cards = mysqli_fetch_assoc($card_result);

$card_first_four = substr(-4,$cards["Card_no"]);

$card_last_four = substr(-7,$cards["Card_no"]);

$card_name = $cards["First_name"] . " ".$cards["Last_name"];

$card_no = $card_first_four . "*****". $card_last_four;


echo "

<p> <b>$card_name/b>
  <b>$card_no <i class='fa fa-flash'></i> <i class='fa fa-trash' 
  onclick='OpenWarning()' style='margin-right: 15px;float: right;'></i></b>
  </p>";





}else{

  
  echo "<p>No saved card found click <b class='Open-top-up-btn'>here</b> to add card or Top-up balance.</p>";



}
?>

 
  </div>

</div>


<div class="Top-up-container-overlay-box">
<p class="close-top-up-btn"><i class="fa fa-close"></i></p>


<p><b>Top up <input type='radio' name='select' id="Top_up">  </b> 
<b>Add Card <input type='radio' name='select' id="Add_card"></b></p> 



<div class="fund-bal-container">
  <p>Top up balance</p>
  <p><form id="Add-bal-form">
    <label><b>Choose card</b></label><br>
    <div class="custom-select">
    <select name="card-no">
      <option></option>
      <option></option>
</select></div>
<br>
<lable><b>Amount </b></lable>
<br>
<input type="number" name="Amount" placeholder="Enter Amount...">

<p class="Add_bal_error_message"></p>
<input type="submit" value="Top up">
</form>
</div>


              

<div class="form-container-box">
  <h1>Payment Method</h1>

<form id="Top-up-form">
<label>Card Number</label>
<br>
<input type="text" inputmode="numeric" style="-webkit-text-security:disc" placeholder="**** **** **** ***">
<br>

<label>Expire Date</label><label style="margin-left: 200px;">Cvv</label><br>
<input type="text" inputmode="numeric" style="-webkit-text-security:disc;width: 42%;display: inline;margin: auto;" placeholder=" ****">

<input type="text" inputmode="numeric" style="-webkit-text-security:disc;width: 42%;display: inline;margin: auto;" placeholder="***">
<br>




<label>Card Pin</label>
<br>
<input type="text" inputmode="numeric" style="-webkit-text-security:disc" placeholder="****">


    
        <p class="Topup_error_message" style="color: red;"></p>
<input type="submit" value="Top up">
</form>

</div>

  </div>

  


<div class="confirm-delete">

  <p>Are you sure you want to delete this ?</p>
  <p>Yes</p>
  <p onclick="CancelWarning()">Cancel</p>
  <br>
  <i class="fa fa-cancel" ></i>
</div>
<?php 
require_once "Loader.php";


require_once "Network.php";

require_once __DIR__. ("/Loader.php"); 

?>
<script src="Js/dashboard.js"></script>

</body>
</html>