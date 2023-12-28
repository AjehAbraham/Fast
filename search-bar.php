<?php 
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location: Error");
    exit;

}else 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && realpath(__FILE__)==
realpath($_SERVER['SCRIPT_FILENAME'])){

    header("Location: Error");
    exit;
 
}
?>

<style>
    .search-bar-container-overlay{
    background-color: white;
    overflow-y: scroll;
    transition: 0.1s;
    position: fixed;
    bottom: 0;   
   z-index: 3; 
    right: 0;
    left: 0; 
    width: 0%;
    top: 0;
    }
    .search-bar-container-box{
        width: 90%;
        text-align: center;
        margin: auto;
        display: block;
    }
    .search-bar-container-box p:nth-child(1){
margin: auto;
display: block;
text-align: center;
font-size: 18px;
cursor: pointer;
    }
    .search-bar-container-box input[type=search]{
        width: 95%;
        padding: 8px 8px;
        border: 2px solid rgb(0,102,153);
        font-size: 18px;
        outline: 0;
        margin: auto;
        display: block;
        border-radius: 2rem;
    }
    .search-bar-container-box input[type=submit]{
        width: 60%;
        padding: 8px 8px;
        border: none;
        font-size: 15px;
        margin: auto;
        display: block;
        background-color: rgb(0,102,153);
        color: white;
        border-radius: 2rem;
        cursor: pointer;
    }
    @media screen and (min-width: 600px){
        .search-bar-container-box input[type=search]{
            font-size: 13px;
            width: 45%;
        }   
        .search-bar-container-box input[type=submit]{
            width: 30%;
        }
    }
    #opensearchbtn{
        cursor: pointer;
    }
    .items-container a:link,a:visited{
        text-decoration: none;
        color: black;
    }
    .addCartBtn{
        padding: 8px 8px;
        text-align: center;
        cursor: pointer;
        color: white;
        width: 56%;
        margin: auto;
        display: block;
background-color: rgb(0,102,153);
border-radius: 2rem;
font-size: 13px;
    }
    @media screen and (min-width: 600px){
        .addCartBtn{
            width: 30%;
        }
    }
    </style>



<div class="search-bar-container-overlay">
<div class="search-bar-container-box">
    <p><span class="material-symbols-outlined" id='close-search-bar'>cancel</span></p>
    <br>
    <form id='searcForm'>
    <input type='search' placeholder='search for Products,brands and Items....' name='search-bar'>
<br><input type='submit' value='search'>
</form>
<p class='search-response'></p>
</div>
</div>



<script>
    

    $(document).ready(function (e) {

$("#searcForm").on('submit', (function(e){


  e.preventDefault();
  
 document.querySelector(".loader-container-overlay").style.display= "block";

   $.ajax({
 
    url: 'Process/search-item',
type : 'POST',
data: new FormData(this),
cache: false,
contentType: false,
processData: false,
 dataType: "text",
    success:function(Data){
 
      
     document.querySelector(".loader-container-overlay").style.display= "none";
     
     document.querySelector(".search-response").innerHTML = Data;


     //STARTING OF A NESTED FUNCTION//
   
     $(document).ready(function (e) {
      
      $(".FormData").on('submit', (function(e){
      
      
        e.preventDefault();
        
      document.querySelector(".loader-container-overlay").style.display= "block";
      
         $.ajax({
       
          url: 'Process/Add cart item',
      type : 'POST',
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
          success:function(Data){
      
         document.querySelector(".loader-container-overlay").style.display= "none";
      
           document.querySelector(".error_message").innerHTML = Data;

           if(Data == "\r\nsuccess"){

            document.querySelector(".success-message-overlay").style.width="100%";

            document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

            document.querySelector(".data-reponse-data").innerHTML ="Item Added Successfuly!";

          //  alert("Item added");

           }else if(Data == "\r\nok"){

            
            document.querySelector(".success-message-overlay").style.width="100%";

            document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

            document.querySelector(".data-reponse-data").innerHTML ="Quantity increased!";
            
           }else{

            if(Data == "success"){

              document.querySelector(".success-message-overlay").style.width="100%";

            document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

            document.querySelector(".data-reponse-data").innerHTML ="Item Added Successfuly!";

          //  alert("Item added")
            }else if(Data == "ok"){

              
            
            document.querySelector(".success-message-overlay").style.width="100%";

document.querySelector(".data-reponse-data").style.backgroundColor="mediumseagreen";

document.querySelector(".data-reponse-data").innerHTML ="Quantity increased!";
            }else{
            
            document.querySelector(".success-message-overlay").style.width="100%";

            document.querySelector(".data-reponse-data").style.backgroundColor="red";

            document.querySelector(".data-reponse-data").innerHTML ="Opps!,Failed to add item";

//alert("Failed to add Item");

           }
         
          }
      //REMOVE SUCCESS MESSAGE USING NESTED LOOP//
      function RemoveResponseText(){

        document.querySelector(".success-message-overlay").style.width= "0";
      }

var RemoveText = setTimeout(RemoveResponseText, 1000);


          },
          error:function(Data){
            document.querySelector(".loader-container-overlay").style.display= "none";
      
            document.querySelector(".error_message").innerHTML = Data;
      
          }
        
         });
      
      
      
      }));
      
      
        });
      


//END OF NESTED FUNCTION TO ADD ITEMS//



    },
    error:function(Data){
     document.querySelector(".loader-container-overlay").style.display= "none";
      document.querySelector(".search-response").innerHTML = Data;

    }
  
   });



}));



});
    document.querySelector("#opensearchbtn").addEventListener("click",OpenSearcgBar);
    function OpenSearcgBar(){

        document.querySelector(".search-bar-container-overlay").style.width ="100%";
    }
    
    document.querySelector("#close-search-bar").addEventListener("click",CloseSearcgBar);
    function CloseSearcgBar(){

        document.querySelector(".search-bar-container-overlay").style.width ="0%";
    }
    </script>