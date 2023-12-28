<?php
require_once "database_connection.php";

/*
$p ="CREATE TABLE
Change_password_history(
  
id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  User_id INT(20) NOT NULL,
  Session_id VARCHAR(255) NOT NULL,
  Date TIMESTAMP NOT NULL,
  Time TIME NOT NULL,
Ip_addr VARCHAr(255) NOT NULL,
User_agent TEXT NOT NULL
)";
*/

/*
$p ="CREATE TABLE Auth_otp_table(
  
id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  User_id  INT(20) NOT NULL,
  Otp  INT(8) NOT NULL,
  Expire INT(20) NOT NULL,
  Hash VARCHAR(255) NOT NULL,
  Date TIMESTAMP NOT NULL,
  Time TIME NOT NULL,
  Ip VARCHAR(40) NOT NULL,
  User_agent TEXT NOT NULL
  )";*/
	/*
$p ="CREATE TABLE
Account_balance_history(
  
id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  User_id INT(20) NOT NULL,
  Balance  INT(20) NOT NULL,
  From_bal  INT(20) NOT NULL,
  To_bal  INT(20) NOT NULL,
  Hash_id VARCHAR(255) NOT NULL,
  Date TIMESTAMP NOT NULL,
  Time TIME NOT NULL
  )";*/

  /*
$p = "CREATE TABLE 
Customer_orders(
  
id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    User_id  INT(20) NOT NULL ,
    Amount  INT(20) NOT NULL,
    payment_Type TEXT NOT NULL,
    Transation_id TEXT NOT NULL,
    Tracking_no  INT(20) NOT NULL,
    Status TEXT NOT NULL,
    Order_status TEXT NOT NULL,
    Items	TEXT NOT NULL,
    Pickup_location TEXT NOT NULL,
    Pickup_date DATE NOT NULL,
    Date TIMESTAMP NOT NULL ,
    Time TIME NOT NULL,
    Ip VARCHAR(40) NOT NULL,
    User_agent TEXT NOT NULL)";
*/
/*


    $p ="CREATE TABLE
    Customer_orders(
      
id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        User_id  INT(20) NOT NULL,
        Amount  INT(20) NOT NULL,
        payment_Type TEXT NOT NULL,
        Transation_id TEXT NOT NULL,
        Tracking_no  INT(20) NOT NULL,
        Status TEXT NOT NULL,
        Order_status TEXT NOT NULL,
        Items	TEXT NOT NULL,
        Pickup_location TEXT NOT NULL,
        Pickup_date DATE NOT NULL,
        Date DATE NOT NULL,
        Time TIME NOT NULL,
        Ip VARCHAR(40) NOT NULL,
        User_agent TEXT NOT NULL
    )";
*/

/*
    $p=" CREATE TABLE 
    Payment_history(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        User_id  INT(20) NOT NULL,
        Amount  INT(20) NOT NULL,
        Payment_provider TEXT NOT NULL,
        Admin_id INT(20) NOT NULL,
        Remark TEXT NOT NULL,
        Status TEXT NOT NULL,
        Session_id VARCHAR(255) NOT NULL,
        Date TIMESTAMP NOT NULL,
        Time TIME NOT NULL,
        Ip_addr VARCHAR(40) NOT NULL,
        User_agent TEXT NOT NULL,
        Payment_Type TEXT NOT NULL,
        Transaction_id VARCHAR(255) NOT NULL
        )";
*/
/*
        $p ="CREATE TABLE 
        Items_order(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            User_id  INT(20) NOT NULL,
            Tracking_no  INT(20) NOT NULL,
            Item_name TEXT NOT NULL,
            Item_price  INT(20) NOT NULL,
            Image_path VARCHAR(255) NOT NULL,
            Quantity  INT(20) NOT NULL,
            Date TIMESTAMP NOT NULL,
            Time TIME NOT NULL
            )";
            */
/*
$p = "CREATE TABLE Two_factor_auth(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20) NOT NULL,
Status TEXT NOT NULL,
Session_id VARCHAR(255) NOT NULL,
Date TIMESTAMP NOT NULL,
Time TIME NOT NULL,
Ip_addr VARCHAR(40) NOT NULL,
User_agent TEXT NOT NULL
)";*/
/*

$p = "CREATE TABLE Register_db(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

First_name TEXT ,
Last_name TEXT,
Email VARCHAR(50) NOT NULL,
Password VARCHAR(255) NOT NULL,
Terms TEXT NOT NULL,
Date TIMESTAMP NOT NULL,
Time TIME NOT NULL,
Ip_addr VARCHAR(40) NOT NULL,
Status TEXT(12) NOT NULL,
User_agent TEXT,
Tel	TEXT ,
Address TEXT,
Date_edit TEXT,
uniqueID VARCHAR(255) NOT NULL
) ";*/

/*
$p = "CREATE TABLE Authentication(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20) NOT NULL,
Hash_id VARCHAR(255) NOT NULL,
Date TIMESTAMP NOT NULL,
Time TIME NOT NULL,
Ip_addr VARCHAR(40) NOT NULL,
User_agent TEXT NOT NULL
)";
*/
/*
$p = "CREATE TABLE Login_history(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20) NOT NULL,
Session_id VARCHAR(255) NOT NULL,
Date TIMESTAMP NOT NULL,
Time TIME NOT NULL,
Ip_addr VARCHAR(255) NOT NULL,
User_agent TEXT NOT NULL
)";*/

/*
$p = "CREATE TABLE  Block_user_acct(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20) NOT NULL,
Status TEXT NOT NULL,
Date TIMESTAMP NOT NULL,
Time TIME NOT NULL,
User_agent TEXT,
Ip_addr TEXT

)";
*/
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
)";
*/
/*
$p = "CREATE TABLE Authentication(

  id INT(120) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  User_id INT(20) NOT NULL,
  uniqueID VARCHAR(255) NOT NULL,
  HashID VARCHAR(255) NOT NULL,
  Date TIMESTAMP NOT NULL,
  Ip_add VARCHAR(40) NOT NULL,
  Status TEXT NOT NULL,
  User_agent TEXT NOT NULL
)";*/

/*
$p = "CREATE TABLE  User_session_id(
  User_id INT(20) NOT NULL,
  Session_id VARCHAR(255) NOT NULL,
  Date TIMESTAMP NOT NULL,
  Time TIME NOT NULL,
  Ip_addr VARCHAR(40) NOT NULL,
  User_agent TEXT
  )";*/
  /*
  $p ="CREATE TABLE Account_balance(

      
  id INT(120) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      User_id INT(20) NOT NULL,
      Balance INT(15) NOT NULL
  )";
  */

  /*
  $p = "CREATE TABLE User_profile_image(
    id INT(120) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20) NOT NULL ,
Image_path VARCHAR(255) NOT NULL,
Date TIMESTAMP NOT NULL,
Time TIME NOT NULL,
Ip_addr VARCHAR(40) NOT NULL,
User_agent TEXT NOT NULL
  )";*/
  /*
  $p = "CREATE TABLE Saved_card(

id INT(120) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20) NOT NULL ,
Card_no INT(15) NOT NULL,
Cvv INT(3) NOT NULL,
Pin INT(4) NOT NULL,
Exp INT(4) NOT NULL,
Date TIMESTAMP NOT NULL,
Time TIME NOT NULL,
Ip_addr VARCHAR(40) NOT NULL,
User_agent TEXT NOT NULL
  )";*/

  /*
$p ="CREATE TABLE Save_cart_items(
id INT(120) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  User_id TEXT,
  Item_name TEXT NOT NULL,
  Item_price INT(10) NOT NULL,
  Quantity INT(10) NOT NULL,
Product_id INT(20) NOT NULL,
Product_image VARCHAR(255) NOT NULL,
Status TEXT ,
Date TIMESTAMP NOT NULL,
Time TIME NOT NULL,
User_agent TEXT NOT NULL,
Ip VARCHAR(20) NOT NULL)";

*/
if(mysqli_query($conn,$p)){


    die("Table created");

}else{


    die("Failed");

}