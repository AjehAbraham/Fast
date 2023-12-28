<?php
require_once "sessionPage.php";


if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){


if(isset($_POST["payment"])){

if(!empty($_POST["payment"])){


   $option = filter_var($_POST["payment"],FILTER_SANITIZE_STRING); 



   if($option == "All time"){


   // die("ALL TIME");

   require_once "database_connection.php";


   $fetch_payment = "SELECT * FROM Payment_history WHERE User_id ='$_SESSION[User]' ORDER BY id DESC";
   
   $results = mysqli_query($conn,$fetch_payment);
   
   
   if(mysqli_num_rows($results) > 0){
   

   while($result = mysqli_fetch_assoc($results)){
   
   $amount = "". number_format($result["Amount"]). ".00";
   
   $date = date("d D F Y",strtotime($result["Date"]));
   
   if($result["Time"] > 12){
   
   
       $time = $result["Time"]. "PM";
   
   }else{
   
       $time = $result["Time"]."AM";
   }


   if($result["Status"] == "Failed"){


    $status_color = "style='color: red;'";

}else if($result["Status"] == "success"){

    $status_color = "style='color: mediumseagreen;'";

}else{

    $status_color = "'color: orange'";


}

if($result["Remark"] == "- Debit"){

    $remark_color = "style='color: red;'";
}else if($result["Remark"] == "+ Credit"){


    $remark_color = "style='color: mediumseagreen;'";

}else{

    if($result["Remark"] == "Failed"){


        $remark_color = "style='color: red;'";
    }else{




        $remark_color= "style='color: orange;'";


    }
}




   
   echo "
   
   
   <div class='container-fliud'>
   <p>$time  $date</p>
   <b>$result[Payment_provider] <i class='fa fa-flash'></i></b><br>
   <b   $remark_color>$result[Remark] <br>₦$amount</b><br>
   <b>Payment Type:$result[Payment_Type]</b><br>
   <b>Transaction ID: $result[Transaction_id]</b><br>
   
   <b $status_color>$result[Status]</b>
   
   </div>
   ";
   
   }
   
   
   
   }else{

    die("<b style='text-align: center;'>No Transaction for ". $option."</b>");
}
   




   }else if($option == "This Month"){



    require_once "database_connection.php";


    $fetch_payment = "SELECT * FROM Payment_history WHERE User_id ='$_SESSION[User]' AND NOW() <= DATE_ADD(Date,INTERVAL  1 MONTH) ORDER BY id DESC";
    
    $results = mysqli_query($conn,$fetch_payment);
    
    
    if(mysqli_num_rows($results) > 0){
    
    while($result = mysqli_fetch_assoc($results)){
    
    $amount = "". number_format($result["Amount"]). ".00";
    
    $date = date("d D F Y",strtotime($result["Date"]));
    
    if($result["Time"] > 12){
    
    
        $time = $result["Time"]. "PM";
    
    }else{
    
        $time = $result["Time"]."AM";
    }
    
    
    
if($result["Status"] == "Failed"){


    $status_color = "style='color: red;'";

}else if($result["Status"] == "success"){

    $status_color = "style='color: mediumseagreen;'";

}else{

    $status_color = "'color: orange'";


}

if($result["Remark"] == "- Debit"){

    $remark_color = "style='color: red;'";
}else if($result["Remark"] == "+ Credit"){


    $remark_color = "style='color: mediumseagreen;'";

}else{

    if($result["Remark"] == "Failed"){


        $remark_color = "style='color: red;'";
    }else{




        $remark_color= "style='color: orange;'";


    }
}



    
    echo "
    
    
    <div class='container-fliud'>
    <p>$time  $date</p>
    <b>$result[Payment_provider] <i class='fa fa-flash'></i></b><br>
    <b  $remark_color >$result[Remark] <br>₦$amount</b><br>
    <b>Payment Type:$result[Payment_Type]</b><br>
    <b>Transaction ID: $result[Transaction_id]</b><br>
    
    <b $status_color>$result[Status]</b>
    
    </div>
    ";
    
    }
    
    
    
    }else{

        die("<b style='text-align: center;'>No Transaction for ". $option. "</b>");
    }
    




//die("THIS MONTH");



   }else{



    if($option == "This week"){

//die("THIS WEEK");





require_once "database_connection.php";


$fetch_payment = "SELECT * FROM Payment_history WHERE User_id ='$_SESSION[User]' AND NOW() <= DATE_ADD(Date,INTERVAL  1 WEEK) ORDER BY id DESC";

$results = mysqli_query($conn,$fetch_payment);


if(mysqli_num_rows($results) > 0){

while($result = mysqli_fetch_assoc($results)){

$amount = "". number_format($result["Amount"]). ".00";

$date = date("d D F Y",strtotime($result["Date"]));

if($result["Time"] > 12){


    $time = $result["Time"]. "PM";

}else{

    $time = $result["Time"]."AM";
}




    
if($result["Status"] == "Failed"){


    $status_color = "style='color: red;'";

}else if($result["Status"] == "success"){

    $status_color = "style='color: mediumseagreen;'";

}else{

    $status_color = "'color: orange'";


}

if($result["Remark"] == "- Debit"){

    $remark_color = "style='color: red;'";
}else if($result["Remark"] == "+ Credit"){


    $remark_color = "style='color: mediumseagreen;'";

}else{

    if($result["Remark"] == "Failed"){


        $remark_color = "style='color: red;'";
    }else{




        $remark_color= "style='color: orange;'";


    }
}



echo "


<div class='container-fliud'>
<p>$time  $date</p>
<b>$result[Payment_provider] <i class='fa fa-flash'></i></b><br>
<b   $remark_color>$result[Remark]<br>₦$amount</b><br>
<b>Payment Type:$result[Payment_Type]</b><br>
<b>Transaction ID: $result[Transaction_id]</b><br>

<b $status_color>$result[Status]</b>

</div>
";

}



}else{

    die("<b style='text-align: center;'>No Transaction for ". $option. "</b>");
}





    }else{


die("<b style='text-align: center;'>invalid select option " .$option."</b>");



    }



   }




}else{

die("<b style='text-align: center;'>Please select start date</b>");


}






}else{


die("<b style='text-align: center;'>Please select an option</b>");


}


}