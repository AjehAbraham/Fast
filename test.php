<?php

require_once "database_connection.php";

//$password = "Ajeh821203$";
//$password = password_hash($password,PASSWORD_DEFAULT);
//$p ="UPDATE Register_db SET Password ='$password' WHERE id='3'";

 //$p = "ALTER TABLE Register_db ADD Date_edit DATE
 //";

 //$p = "ALTER TABLE Register_db MODIFY COLUMN Tel VARCHAR(10)";

 //$no = rand(23498,95678). uniqid(). rand(73731,97864);


//$p = "ALTER TABLE Items_product_table  ADD Status TEXT";
/*
$p = "CREATE TABLE Register_db (
    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

First_name TEXT,
Last_name TEXT,
Email VARCHAR(255),
Password VARCHAR(255),
Terms TEXT,
Date TIMESTAMP,
Time TIME,
Ip_addr VARCHAR(50),
Status TEXT,
User_agent TEXT,
Tel INT(11),
Address Text,
Date_edit DATE
)";*/
/*
$hash = "Ajeh821203$";
$hash = password_hash($hash,PASSWORD_DEFAULT);

$p= "UPDATE Register_db SET Password ='$hash'";
*/
/*
$p = "CREATE TABLE Authentication(

id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY
,User_id INT(20),Hash_id VARCHAR(255),Date TIMESTAMP,Time TIME,Ip_addr VARCHAR(40),
User_agent TEXT


)";*/
/*
$p ="CREATE TABLE Change_password_history(

id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20),Session_id VARCHAR(255),Date TIMESTAMP,Time TIME,
Ip_addr VARCHAR(40),User_agent TEXT


)";*/

/*
$p = "CREATE TABLE Users_otp_table(

id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20),OTP INT(6),Date TIMESTAMP,Time TIME,
Ip_addr VARCHAR(40),User_agent TEXT


)";*/




/*
$p = "CREATE TABLE User_session_id(

    id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY
    ,User_id INT(20),Session_id VARCHAR(255),Date TIMESTAMP,Time TIME,Ip_addr VARCHAR(40),
    User_agent TEXT
    )";*/
/*
$p = "CREATE TABLE Login_history(

id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20),Session_id VARCHAR(255),Date TIMESTAMP,Time TIME,
Ip_addr VARCHAR(40),User_agent TEXT
)";

*/
/*
$p = "CREATE TABLE     
Two_factor_auth(

    id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    User_id INT(20),Status TEXT,Session_id VARCHAR(255),Date TIMESTAMP,Time TIME,
    Ip_addr VARCHAR(40),User_agent TEXT
    )";

*/
/*

$p = "CREATE TABEL Account_balance(
id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,	User_id INT(20),Balance INT(20)	,Hash_id VARCHAR(255)	

)";


$p = "CREATE TABLE Account_balance_history(id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id	INT(20),Balance	INT(20),
From_bal INT(20),	To_bal INT(20),	Hash_id	 VARCHAR(255),Date TIMESTAMP,Time)";


$p = "CREATE TABLE Payment_history (

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20),
Amount INT(20),
Payment_provider TEXT,
Admin_id INT(20),
Remark TEXT,
Status TEXT,
Session_id  VARCHAR(255),
Date TIMESTAMP,
Time TIME,
Ip_addr VARCHAR(40),
User_agent TEXT,
Payment_type,
Transaction_id TEXT
)";*/

/*
$hash = uniqid().rand().uniqid().rand().uniqid();

$date = date("Y/m/d H:i:s");

$time = date("H:i:s");

$p = "INSERT INTO Account_balance (
User_id,Balance,Hash_id	
)
VALUES('1','1000','$hash')

";
*/
/*
$p ="CREATE TABLE Saved_card (

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(20),
Card_no INT(15),
Card_cvv INT(3),
EXP INT(4),
First_name TEXT,
Last_name TEXT,
Provider TEXT,
Session_id  VARCHAR(255),
Date TIMESTAMP,
Time TIME,
Ip_addr VARCHAR(40),
User_agent TEXT 

)";*/
/*
$p ="CREATE TABLE  Delivery_locations(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Admin_id INT(20),
State TEXT NOT NULL,
LGA TEXT NOT NULL,
Address TEXT NOT NULL,
Status TEXT NOT NULL,
Country TEXT NOT NULL,
Agent_email VARCHAR(30) NOT NULL,
Agent_full_name TEXT NOT NULL,
DATE TIMESTAMP NOT NULL,
TIME TIME NOT NULL
)";
*/
/*
$one =1;
$p = "INSERT INTO Delivery_locations(
Admin_id	,State	,LGA	,Address	,Status	,Country

)
VALUES('$one','Abuja','Kuje','Market Road Opposite First bank Gwagwalada,Abuja','UnAvaliable','Nigeria')

";
*/
/*
$p = "CREATE TABLE Delivery_state(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
State TEXT NOT NULL,
LGA TEXT NOT NULL,
Status TEXT NOT NULL
)";*/

/*
$p ="INSERT INTO Delivery_state(
State ,
LGA,
Status 
)
VALUES('Abuja','Bwari','Avaliable')
";

*/
/*
$p = "CREATE TABLE Delivery_LGA(

id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
State TEXT NOT NULL,
LGA TEXT NOT NULL,
Status TEXT NOT NULL
)";*/


/*
$p ="INSERT INTO Delivery_state(
State ,
LGA,
Status 
)
VALUES('Abuja','Bwari','Avaliable')
";*/

/*
$p ="INSERT INTO Delivery_state(State,Status)
VALUES('Enugu','Avaliable')
";
*/
/*
$p ="INSERT INTO Delivery_LGA(
State,LGA,Status)
VALUES('Lagos','Apapa','Avaliable')
";*/
/*
$p ="INSERT INTO Delivery_LGA(
    State,LGA,Status)
    VALUES('Abuja','Manicipal','Avaliable')
    ";*/

/*
$p = "CREATE TABLE User_profile_image(

id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id  INT(20) NOT NULL,
Image_path VARCHAR(255),
Date TIMESTAMP,
Time TIME,
Ip_addr VARCHAR(40),
User_agent TEXT

)";
*/
/*
$p = "ALTER TABLE Delivery_locations ADD Admin_id INT(20)";*/

/*
$p = "CREATE TABLE Customer_orders(
    id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id  INT(20) NOT NULL,
Amount  INT(20) NOT NULL,
payment_Type TEXT,
Transation_id VARCHAR(30) NOT NULL, 
Tracking_no  VARCHAR(20) NOT NULL,
Status TEXT,
Order_status TEXT,
Items TEXT,
Pickup_location Text,
Pickup_date TEXT,
Date TIMESTAMP,
Time TIME,
Ip varchar(40),
User_agent TEXT
)";*/

/*
$p = "CREATE TABLE Items_order(

id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id  INT(20) NOT NULL,
Tracking_no VARCHAR(30),
Item_name TEXT,
Item_price TEXT,
Image_path TEXT,
Quantity INT(20),
Date TIMESTAMP,
Time TIME
)";*/


//$p = "ALTER TABLE  Payment_history ADD Transaction_id TEXT";

/*
$p = "CREATE TABLE Customers_complain(
id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(10),
Ticket_id INT(20),
Tracking_no INT(20),
Complain TEXT,
Type TEXT,
Status TEXT,
Date TIMESTAMP,
Time TIME,
Ip VARCHAR(30),
User_agent TEXT
)" ;*/


/*
$p = "CREATE TABLE Auth_otp_table (

id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(10),
Otp INT(6),
Expire INT(2),
Hash VARCHAR(255),
Date TIMESTAMP,
Time TIME,
Ip VARCHAR(30),
User_agent TEXT
)";
*/

$p = "CREATE TABLE Product_user_rating(

id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
User_id INT(10),
Product_id VARCHAR(30),
Rating Text,
Status TEXT,
Date TIMESTAMP,
Time TIME,
Ip VARCHAR(30),
User_agent TEXT
)";




$servername = "localhost";
$username = "id20984188_fastshop_lazer";
$password = "Ajeh821203$$";
$database_name = "id20984188_fastshop";
/*
$p ="CREATE TABLE Admin_Auth_table(
id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Admin_id INT(5),
Hash_id VARCHAR(255),
Cookie_hash VARCHAR(255),
Expire INT(3),
Date TIMESTAMP,
Time TIME,
Ip TEXT,
User_agent TEXT
)";*/

/*
$p = "CREATE TABLE Block_user_payment(
    id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    User_id INT(20),
Status TEXT,
Admin_id INT(5),
Date TIMESTAMP,
Time TIME,
Ip_addr VARCHAR(40),
User_agent TEXT
)";*/
/*
$p = "CREATE TABLE Block_user_acct(
    id INT(123) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    User_id INT(20),
Status TEXT,
Admin_id INT(5),
Date TIMESTAMP,
Time TIME,
Ip_addr VARCHAR(40),
User_agent TEXT
)";*/

if (mysqli_query($conn,$p)){


    echo "TABLE MODIFY";
    

}else{



    echo "Failed  ".mysqli_connect_error();

}


