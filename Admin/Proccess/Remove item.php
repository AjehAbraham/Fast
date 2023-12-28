<?php
require_once "session.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){

 

    if(isset($_POST["secert-key"]) && isset($_POST["item-ID"])){



        if(empty($_POST["secert-key"])){

            die("Please enter your secret key");
        }else{



            $seret_key = (int) filter_var($_POST["secert-key"],FILTER_VALIDATE_INT);

            $seret_key = htmlspecialchars($seret_key);
        }


        $id = filter_var($_POST["item-ID"],FILTER_SANITIZE_STRING);


        if(empty($id)){

            die("Error occur submitting form");
        }else{

            $id = htmlspecialchars($id);

        }



    }else{


        die("Invalid credentiall");
    }




    //CHECK USER SECREY KEY IF IT VALID OR NOT//


    $check_key = "SELECT Pin FROM Admin_Register_db WHERE id='$_SESSION[Admin_id]'";


    $pin_result = mysqli_query($conn,$check_key);

$results_pin = mysqli_fetch_assoc($pin_result);


if(password_verify($seret_key,$results_pin["Pin"]) == "password_hash"){


    $update_item = "SELECT * FROM Items_product_table WHERE Hash_id='$id'";


    $item_result = mysqli_query($conn,$update_item);

    if(mysqli_num_rows($item_result) > 0){


$results_l = mysqli_fetch_assoc($item_result);


if($results_l["Status"] == "Deleted"){


    $status = "Avaliable";

    $reponse = "ok";

}else{

    $reponse = "success";

    $status = "Deleted";
}




$saved = "UPDATE Items_product_table SET Status ='$status' WHERE Hash_id='$id'";



if(mysqli_query($conn,$saved)){


    die($reponse);

}else{

die("Failed to updated item ". mysqli_connect_error());


}

    }else{


die("Item cannot be found or has been removed");

    }



}else{


    die("invalid secret key");

}

mysqli_close($conn);


}else{



    header("Location: Error");
    exit;
}

