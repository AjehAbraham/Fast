<?php


session_start();

unset($_SESSION["Admin_id"]);
unset($_SESSION["Admin_hash"]);


header("Location: Login");
exit;