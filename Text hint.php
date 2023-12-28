<?php

require_once "database_connection.php";



$fetch = "SELECT * FROM Items_product_table";


$result = mysqli_query($conn,$fetch);

if(mysqli_num_rows($result) > 0){

while($results = mysqli_fetch_assoc($result)){


    $suggestion[] = $results["Product_name"] . "<br>";


$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($suggestion as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}

// Output "no suggestion" if no hint was found or output correct values 
echo  $hint === "" ? "no suggestion" : $hint;





}




}else{


echo "No result found";


}



?>