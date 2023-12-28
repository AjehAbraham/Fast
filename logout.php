<?php
session_start();

unset($_COOKIE["UserID"]);
setcookie("UserID","",time() - 86400 * 7,"/");

unset($_COOKIE["TokenID"]);
setcookie("TokenID","",time() - 86400 * 7, "/");


unset($_COOKIE["Last_visited"]);

setcookie("Last_visited", "", time() - 86400 * 7);


unset($_SESSION["User"]);



session_destroy();

header("Location: home");
exit;




?>