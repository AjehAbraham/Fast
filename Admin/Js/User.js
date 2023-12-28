          
      $(document).ready(function (e) {

        $("#form").on('submit', (function(e){
        
        
          e.preventDefault();
          
       document.querySelector(".loader-container-overlay").style.display= "block";
        
           $.ajax({
         
            url: 'Proccess/Search User',
        type : 'POST',
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
            success:function(Data){
        
           document.querySelector(".loader-container-overlay").style.display= "none";

             document.querySelector(".error_message").innerHTML = Data;
        
        
            },
            error:function(Data){
              document.querySelector(".loader-container-overlay").style.display= "none";

              document.querySelector(".error_message").innerHTML = Data;
        
            }
          
           });
        
        
        
        }));
        
        
          });