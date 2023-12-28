<?php
session_start();

unset($_SESSION["Admin_key"]);

unset($_SESSION["Admin_hash"]);

unset($_SESSION["Admin_id"]);

unset($_SESSION["Admin_status"]);

  unset($_SESSION["Admin_permit"]);


  
  //COOKIE VALUE IS EMPTY JUST UNSET COOKIE//

  unset($_COOKIE["Remember-admin"]);
  unset($_COOKIE["Admin_hash_key"]);
  
  setcookie("Remember-admin","", time() - 86400 * 7, "/");
  
  setcookie("Admin_hash_key","", time() - 86400 * 7, "/");
  
  
  
  
  


header("Location: Login");
exit;