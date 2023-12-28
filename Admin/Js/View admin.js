

  $(document).ready(function (e) {

    $("#search-admin").on('submit', (function(e){
    
    
    e.preventDefault();
    
     document.querySelector(".loader-container-overlay").style.display= "block";
    
    $.ajax({
    
    url: 'Proccess/Search admin',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success:function(Data){
    
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_messages").innerHTML = Data;
    
    /*if(Data == "success"){
    
  document.querySelector("#Edit-admin-form").reset();
  
      alert("Updated successfully");
  
    }else if(Data == "\r\nsuccess"){
  
      document.querySelector("#Edit-admin-form").reset();
  
      alert("Updated successfully");
    }
    */
    
    
    },
    error:function(Data){
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_messages").innerHTML = Data;
    
    }
    
    });
    
    
    
    }));
    
    
    });


