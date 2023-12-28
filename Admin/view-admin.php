<?php
if(!$result["Status"] == "Master"){


    header("Location Error");
    exit;
}




?>


<br>
<p style="text-align: center; font-weight: bold;font-size: 18px;">All Admin(s) Info</p>


<?php

require_once "db_connection.php";

$fetch_admin = "SELECT * FROM Admin_Register_db";


$admin_result = mysqli_query($conn,$fetch_admin);


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

";


while($admins = mysqli_fetch_assoc($admin_result)){

$date =date("d D F Y",strtotime($admins["Date_created"]));

if($admins["Time"] > 12){


    $time = $admins["Time"] . "PM";
}else{

$time = $admins["Time"] . "AM";


}

if($admins["id"] == $_SESSION["Admin_key"]){

  $checking = "(YOU)";
}else{

  $checking = "";
}

    echo "
    
    <tr>
    <td>$admins[Email]$checking</td>
    <td>$admins[Status]</td>
    <td>$admins[Admin_permit]</td>
    <td></td>
    <td>$date</td>
    <td>$time</td>
    <td>$admins[Ip]</td>
    <td><a href='edit-admin?id=$admins[id]&mail=$admins[Email]'>Edit</a></td>
    </tr>
    
    ";
    
    
    }

    echo "
    </table>";



?>


<script src="Js/View admin.js"></script>
</body>
</html>

