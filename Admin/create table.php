<?php
 /*  
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

header('HTTP/1.0 403 Forbiddden',TRUE,403);
die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}*/


require_once "Proccess/db_connection.php";

/*
$p = "CREATE TABLE Admin_Register_Temp (
    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(255),Admin_id INT(20),Category TEXT,Hash_id VARCHAR(255),Hash VARCHAR(255),
    Date TIMESTAMP,Time TIME,Ip VARCHAR(30),User_agent TEXT
)";*/


/*
$p = "CREATE TABLE Items_product_table(
  id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

  Product_name TEXT NOT NULL,
  Product_price TEXT NOT NULL,
  Product_old_price TEXT,
  Product_image VARCHAR(255) NOT NULL,
  Product_description TEXT NOT NULL,
  Date_uploaded TIMESTAMP,
  Admin_id INT(20) NOT NULL,
  Hash_id VARCHAR(255),
  Ip_addr VARCHAR(40),
  Time TIME,
  Quantity INT(20),
  Type INT(2) NOT NULL,
  Status TEXT NOT NULL
)";*/

/*
$p = "CREATE TABLE Admin_Register_db (
    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(255),
    Password VARCHAR(255),
    Pin VARCHAR(255),
    Admin_permit TEXT,
    Created_by INT(20),
    Status TEXT,
    Date_created TIMESTAMP,
    Time TIME,
    Ip VARCHAR(40),
    User_agent TEXT
)";
*/
/*
$p = "CREATE TABLE Admin_Login_otp(
      id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Admin_id INT(20),
    Admin_hash VARCHAR(255),
    Otp INT(8),
    Date TIMESTAMP,
    Time TIME,
    Ip VARCHAR(40),
    User_agent TEXT
    )";

*/
/*
$p ="CREATE TABLE Admin_Login_history(
   id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Admin_id INT(20),
    Status TEXT,
    Hash VARCHAR(255),
    Session_id VARCHAR(255),
    Date TIMESTAMP,
    Time TIME,
    Ip VARCHAR(40),
    User_agent TEXT
)";
*/
/*
$p = "CREATE TABLE Admin_session_id(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Admin_id INT(20),
    Session_id VARCHAR(255),
    Date TIMESTAMP,
    Time TIME,
    Ip VARCHAR(40),
    User_agent TEXT

)";*/
/*
$p = "CREATE TABLE Product_items_edited(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Admin_id INT(20),
Item_hash VARCHAR(255),
Edited_By INT(20),
Field_edited TEXT,
Edited_from TEXT,
Edited_to TEXT,
    Date TIMESTAMP,
    Time TIME,
    Ip VARCHAR(40),
    User_agent TEXT
)";
*/
/*
$p ="CREATE TABLE Delivery_location_history(
    id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Admin_id INT(20),
    Edited_from TEXT,
    Edited_to TEXT,
    Date TIMESTAMP,
    Time TIME,
    Ip_addr VARCHAR(30)
    )";*/
/*
    $p = "CREATE TABLE Admin_Auth_table(
        
    id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Admin_id INT(20) NOT NULL,
        Hash_id VARCHAR(255) NOT NULL,
        Cookie_hash VARCHAR(255) NOT NULL,
        Expire TEXT ,
        Date TIMESTAMP NOT NULL,
        Time TIME NOT NULL,
        Ip TEXT NOT NULL,
        User_agent TEXT
        )";*/

        

if(mysqli_query($conn,$p)){


    echo "created";
    
}else{


    die("Error ".mysqli_connect_error());
}
