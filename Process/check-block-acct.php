<?php

//CHECK IF USER ACCOUNT HAS BEEN RESTRICTED//

 

$check_status = "SELECT * FROM Block_user_acct WHERE User_id='$checkBlockID' ORDER BY id DESC LIMIT 1";


$block_status = mysqli_query($conn,$check_status);


if(mysqli_num_rows($block_status) > 0){



    $block_result = mysqli_fetch_assoc($block_status);


if($block_result["Status"] == "Block"){



    die("Your account has been restricted for violating our Terms and Conditions,if you feel this was a mistake/Error
    please contact us <a href='mailto:Ajehabraham51@gmail.com'>here</a>.");
}



}else{

//DO NOTHINH//


}
