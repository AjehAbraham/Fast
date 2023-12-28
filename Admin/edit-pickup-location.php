<?php
require_once "session.php";


if($result["Status"] == "Master"){



}else{
    
    die("Authorization Failed");
}

//require_once "db_connection.php";


//FETCH LOCATION //

if($_SERVER["REQUEST_METHOD"] == "GET"){



    if(isset($_GET["name"])  && isset($_GET["id"])){


        if(empty($_GET["name"]) && empty($_GET["id"])){


            die("<p style='color: red;text-align: center'>No location to search Please go back</p>");
        }else{




            $state = filter_var($_GET["name"],FILTER_SANITIZE_STRING);

            $state = htmlspecialchars($state);

            $id = (int) filter_var($_GET["id"],FILTER_VALIDATE_INT);

            $id = htmlspecialchars($id);


            $id = stripcslashes($id);
            $state = stripcslashes($state);

            require_once "db_connection.php";

            $id = mysqli_real_escape_string($conn,$id);

            $state = mysqli_real_escape_string($conn,$state);

            $location = "SELECT * FROM Delivery_locations WHERE State ='$state' AND id='$id' OR id ='$id'";



            $location_result = mysqli_query($conn,$location);


            if(mysqli_num_rows($location_result) > 0){


                $results_l = mysqli_fetch_assoc($location_result);

$country = /*strtolower(*/$results_l['Country']/*)*/;

$_SESSION["location_id"] = $results_l["id"];
                
            $dataDOG  ="
            

            <div class='form-container-fluid-two'>
            <p>Edit Location <i class='fa fa-map'></i></p>
            <form id='edit-location-form'>
            <label><b>Country</b></label>
            <br>
            <select name='country'>
            <option>$country</option>
            <option>Nigeria</option>
            <option>Ghana</option>
            <option>South Africa</option>
            </select>
            <br>
            
            <label><b>State</b></label>
            <br>
            <input type='text' value='$results_l[State]' name='state' placeholder='state...'>
            <br>
            
            
            
            <label><b>LGA</b></label>
            <br>
            <input type='text'value='$results_l[LGA]' name='LGA' placeholder='Enter LGA/Local goverment or city...'>
            <br>
            <label><b>Address</b></label><br>
            
            <textarea name='Add' cols='9' rows='6' placeholder='Pickup Location Address...''>$results_l[Address]</textarea>
            
            <br>
            <label><b>Agent name</b></label><br>
            <input type='text' value='$results_l[Agent_full_name]' name='agent-name' placeholder='Enter agent full name...'>
            
            <br>
            <label><b>Agent email</b></label>
            <br>
            <input type='email' value='$results_l[Agent_email]' name='agent-email' placeholder='Pickup agent email...''>
            
            <br>
            <br>
            <select name='status'>
            <option>$results_l[Status]</option>
            <option>Avaliable</option>
            <option>Unavaliable</option>
            <option>Busy</option>
            </select>
            <br>
            
            <br>
            
            <p class='open-transaction-pin'>Confirm Location</p>
            <br>
            
         
                        ";


            }else{




                die("<p style='color: red;text-align: center;'>Location cannot be found</p>");

            }



        }



    }else{

die("<p style='color: red;text-align: center'>Invalid request type,please go back or reload</p>");



    }

}


mysqli_close($conn);


?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="Css/edit-pickup-location.css">
  
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          
          <title>Edit Pickup Location</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" href="Css/header.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">


</head>
<body>

<?php require_once "header.php";

echo $dataDOG;

require_once "transaction-pin-box.php";
?>

<script src="Js/edit-pickup-location.js"></script>
</body>
</html>
