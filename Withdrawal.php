<?php
require_once "sessionPage.php";


?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/widthrawal.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Withdraw Cash</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>

<?php require_once "Network.php";

require_once "Loader.php";

?>


<div class="container-fulid-form">

  <p>Withdraw To Bank(Lazerwave only)</p>

  <form id="Withdraw">

<label><b>Account Number</b></label><br>

<input type="number" name="acct_no" placeholder="Account number...." inputmode="numeric" >

<br>
<label><b>Amount(₦500 and Above)</b></label><br>
<input type="number" name="amount" placeholder="Enter Amount e.g ₦1,000..." inputmode="numeric">
<br>

<label><b>Remark(Optional)</b></label><br>

<textarea cols="9" rows="5" name="Remark" placeholder="e.g Fess,House Rent ..."></textarea>

<p class="error_message"></p>

<input type="submit" value="withdraw Balance">

<br>
</form>

</div>


<script src="Js/Withdraw.js"></script>


</body>
</html>
