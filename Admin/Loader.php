<?php

  /* 
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location:Error");
    exit;

header('HTTP/1.0 403 Forbiddden',TRUE,403);
die("<h3> 403 Access denied!The file you request for does not exist.</h3>");
}*/

?>




  <style>
    .loader-container-overlay{
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      width: ;
      bottom: 0;
      background-color: rgba(255,255,255,0.6);
      text-align: center;
     display: none;
     z-index: 9;
    }
    .loader-container{
position: absolute;
margin:  -76px 0 0 -76px;
left: 50%;
top: 50%;
      text-align: center;
color: rgb(0,0,52);
    }
    /*.loader-container p:nth-child(1){

      -webkit-animation: spin 0.7s linear infinite;

      animation: spin 0.7s linear  ease-in-out infinite;
    }
@keyframes spin {
  0%{transform: rotate(0deg);}
  100%{transform: rotate(360deg);}
  
}
@-webkit-keyframes spin{
  0%{transform: rotate(0deg);}
  100%{transform: rotate(360deg);}
  

}*/
.loader-container p:nth-child(1){
  text-align: center;
  font-weight: bold;
  font-size: 18px;
}

.loader-container p:nth-child(1) i{
  text-align: center;
  font-weight: bold;
  font-size: 5px;

}

    .loader-container p i{
      font-size: 20px;
    }
    .loader-container {

    }
   #loader-element:nth-child(1){

      -webkit-animation:  pre-loader 2s ease-in-out alternate infinite;
      animation: pre-loader 0.6s ease-in-out alternate infinite;

    }
    
    #loader-element:nth-child(2){
      
      -webkit-animation:  pre-loader 2s ease-in-out alternate infinite;
      animation: pre-loader 0.6s ease-in-out alternate  0.2s infinite;

    }
    
    #loader-element:nth-child(3){
      
      -webkit-animation:  pre-loader 2s ease-in-out alternate infinite;
      animation: pre-loader 0.6s ease-in-out alternate  0.4s infinite;

    }

    @keyframes pre-loader {
      
      100%{transform: scale(1);}
    }
    @-webkit-keyframes pre-loader{

      100%{transform: scale(2);}
    }
  </style>


  <div class="loader-container-overlay">

     <div class="loader-container">
        
  
    <p>Please wait <i class="fa fa-circle" id="loader-element"></i> <i class="fa fa-circle" id="loader-element"></i> <i class="fa fa-circle" id="loader-element"></i> </p>
     </div>
  </div>
