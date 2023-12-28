<?php
   
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

//header('HTTP/1.0 403 Forbiddden',TRUE,403);
//die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}

?>

<div class="footer-overlay">

    <div class="sub-footer-container">
      <p>News</p>
      <p>Blog</p>
      <p>Terms and condition</p>
      <p>Follow us on social media</p>
      
      <p>
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"> <i class="fa fa-twitter"></i></a>
            <a href="#">  <i class="fa fa-instagram"></i></a>
      </div>
      
      <div class="footer-container">

<p>Privacy Policy</p>
<p>Cookie Policy</p>
<p>About us</p>
<p>Report a Bug</p>
<p>Partner with us</p>
<p>Contact us: <i>Behinde city mart specialist road,Gwagwalada Abuja.</i></p>
<p>Email us: <i>Ajehabraham51@gmail.com.</i></p>    
<p>All Right Reserved<p>
<p>©2022 - <?php echo date("Y") ?></p>
     
      </div>
      
</div>
    
</body>
</html>