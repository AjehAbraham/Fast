<?php

require_once "sessionPage.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){


    $acct_no = (int) filter_var($_POST["acct_no"],FILTER_VALIDATE_INT);


    if(empty($acct_no)){


die("Please enter your account number");

    }else{

$acct_no = htmlspecialchars($acct_no);



    }


    $amount = (int) filter_var($_POST["amount"],FILTER_VALIDATE_INT);


    if(empty($amount)){


die("Please enter Amount");


    }else if($amount <= 499){


        die("Amount cannot be less than 500");
    }else{

$amount = htmlspecialchars($amount);



    }




if(isset($_POST["Remark"])){


$remark_message = filter_var($_POST["Remark"],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);



if(empty($remark_message)){

$remark_message = "fastshop Withdrawal";


}else{


    $remark_message = $remark_message;
}


}

$acct_no = stripcslashes($acct_no);

$amount = stripcslashes($amount);

$remark_message = stripslashes($remark_message);

require_once "database_connection.php";


$amount = mysqli_real_escape_string($conn,$amount);

$remark_message = mysqli_real_escape_string($conn,$remark_message);

$acct_no = mysqli_real_escape_string($conn,$acct_no);



die("Pyament provider are currently offline please try again soon");


}