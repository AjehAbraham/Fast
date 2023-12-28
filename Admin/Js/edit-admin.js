
$(document).ready(function (e) {

    $("#FormID").on('submit', (function(e){
    
    
    e.preventDefault();
    
     document.querySelector(".loader-container-overlay").style.display= "block";
    
    $.ajax({
    
    url: 'Proccess/Remove-Admin',
    type : 'POST',
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success:function(Data){
    
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_message").innerHTML = Data;
    
    document.querySelector("#pin").value="";
    },
    error:function(Data){
    document.querySelector(".loader-container-overlay").style.display= "none";
    
    document.querySelector(".error_message").innerHTML = Data;
    
    }
    
    });
    
    
    
    }));
    
    
    });
    