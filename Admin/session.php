<?php
session_start();

//require_once "Remember-me.php";

if(!isset($_SESSION["Admin_key"])){


  header("Location: Login");
  exit;
}
   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

}

require_once "db_connection.php";



$admin = "SELECT * FROM Admin_Register_db WHERE id='$_SESSION[Admin_key]'";


$admin_result = mysqli_query($conn,$admin);

$result = mysqli_fetch_assoc($admin_result);


$_SESSION["Admin_status"] = $result["Status"];

$_SESSION["Admin_permit"] = $result["Admin_permit"];

$_SESSION["Admin_id"] = $_SESSION["Admin_key"];

if($result["Admin_permit"] == "Granted"){



}else{

session_destroy();
header("Location: Logout");
exit;


}

