<?php

require_once "session.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}



if($_SERVER["REQUEST_METHOD"] == "POST"){


if(isset($_POST["Admin-info"])){


    if(empty($_POST["Admin-info"])){

        die("Please enter Email.Admin ID or a pickup location to find Admin");
    }else{


        $admin_info = htmlspecialchars($_POST["Admin-info"]);


        $admin_info = stripcslashes($admin_info);



        require_once "db_connection.php";


    $admin_info = mysqli_real_escape_string($conn,$admin_info);


$fetch_admin = "SELECT * FROM Admin_Register_db WHERE Email='$admin_info' OR id='$admin_info'";


$admin_result = mysqli_query($conn,$fetch_admin);

if(mysqli_num_rows($admin_result) > 0){


    $admin = mysqli_fetch_assoc($admin_result);


    $date = date("d D F Y",strtotime($admin["Date_created"]));

if($admin["Time"] > 12){

    $time = $admin["Time"]. "PM";
}else{


$time = $admin["Time"]. "AM";

}

    echo "
    
  <table>
  <tr>
    <th>Admin Email</th>
    <th>Admin Status</th>
    <th>Admin Permit</th>
    <th>Created by</th>
    <th>Date Created</th>
    <th>Time</th>
    <th>Ip Address</th>
    <th>Edit Info</th>
  </tr>

<tr>
<td>$admin[Email]</td>
<td>$admin[Status]</td>
<td>$admin[Admin_permit]</td>
<td></td>
<td>$date</td>
<td>$time</td>
<td>$admin[Ip]</td>
<td><a href='edit-admin?id=$admin[id]&mail=$admin[Email]'>Edit</a></td>
</tr>
</table>
    ";


}else{


    //SEARCH USING PIVKUP LOCATION FOR ADMIN//

    die("Admin info cannot be found please try using pickup location or enter valid email");


}

    mysqli_close($conn);

    }


}else{


    die("Error caught");
}




}else{


    header("Error");
    exit;
}
