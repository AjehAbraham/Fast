  
$(document).ready(function (e) {

    $("#FormID").on('submit', (function(e){
    
    
    e.preventDefault();
    
    // document.querySelector(".loader-container-overlay").style.display= "block";
    
    $.ajax({
    
    url: 'Proccess/Register',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success:function(Data){
    
    //document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_message").innerHTML = Data;
    
    
    
    if(Data === "\r\nok"){
    
    document.querySelector("#FormID").reset();
    
    window.location.href ="Login";
    
    
    }else if(Data === "ok"){
    
    document.querySelector("#FormID").reset();
    
    window.location.href ="Login";
    }
    
    },
    error:function(Data){
    //document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_message").innerHTML = Data;
    
    }
    
    });
    
    
    
    }));
    
    
    });
    function Reload_page(){
    window.location.href = "Login";
    
    }
     
    myvar = setTimeout(120000,Reload_page);
    
    