<?php
require_once "sessionPage.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){


die("Unable to Top up balance at this moment, Please try again.");


}else{

    header("Location: Error");

    exit;
}