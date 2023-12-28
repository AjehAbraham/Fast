<?php
require_once "session.php";

if(!$result["Status"] == "Master"){


    die("<p>You cannot view this page,Access denied!</p>");
}


?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/edit-admin.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Edit Admin info</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="Css/header.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


</head>
<body>

<?php require_once "header.php";

?>


<?php
//echo $responseText;

if($_SERVER["REQUEST_METHOD"] == "GET"){


  if(isset($_GET["id"]) && isset($_GET["mail"])){
  
  
    if(!empty($_GET["id"]) && isset($_GET["mail"])){
  
  $id = (int) filter_var($_GET["id"],FILTER_VALIDATE_INT);
  
  $email = filter_var($_GET["mail"],FILTER_VALIDATE_EMAIL);
  
  require_once "db_connection.php";
  
  $id = stripcslashes($id);
  $email = stripcslashes($email);
  
  $id = mysqli_real_escape_string($conn,$id);
  
  $email =mysqli_real_escape_string($conn,$email);
  
  $fetch_admin = "SELECT * FROM Admin_Register_db WHERE Email='$email' AND id='$id' OR id='$id'";
  
  
  $admin_result = mysqli_query($conn,$fetch_admin);
  
  if(mysqli_num_rows($admin_result) > 0){
  
  $admins = mysqli_fetch_assoc($admin_result);
  
if($admins["id"] == $_SESSION["Admin_key"]){

  $checking = "<p style='font-size: 13px;color: red;'>(This account belongs to you,changing the account status cannot 
  be undo by you,but can be undo by other Master admin)</p>";
}else{

  $checking = "";
}
  
  echo "
  
  
  <div class='form-container-fluid-two'>
    <p>Edit Admin <i class='fa fa-user-plus'></i></p>
    $checking
    <form id='FormID'>
    
  
  <label><b>Email</b></label>
  
  <input type='email' name='admin-email'  value='$admins[Email]' placeholder='Admin email...'><br>
  
  <label><b>Admin Status</b></label>
  <select name='status'>
    <option>$admins[Status]</option>
    <option>Master</option>
    <option>Pickup Agent</option>
    <option>Store Agent</option>
    <option>Customer care</option>
  </select>
  <br>
  
  <label><b>Admin permission</b></label>
  <select name='permit'>
    <option>$admins[Admin_permit]</option>
    <option>Granted</option>
    <option>Suspend</option>
  <option>Deny</option>
  <option>Block</option>
  </select>
  <br>
  
  
   <h1 class='open-transaction-pin' onclick='Open_pin_box()'>proceed</h1>
   </div>

  
  ";
  
  require_once "transaction-pin-box.php";
  
  require_once "Loader.php";

  }else{
  
  die("<p style='color: red; text-align: center;'>No admin found with details");
  
  }
  
  
  
    }else{
  
  
      die("<p style='color: red; text-align: center;'>Erro occur</p>");
    }
  
  
  
  }else{
  
  
    die("<p style='color: red; text-align: center;'>Error,please reload page or go back</p>");
  
  
  }
  
  
  }else{
  
  
 // header("Location: Error");
  //exit;
  
  }
  
?>

<script src="Js/edit-admin.js"></script>
</body>
</html>