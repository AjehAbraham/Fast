
function Select_data(event){


    document.querySelector(".error_message").innerHTML = "...";
    
    var form = $("#form_id");
    
    var url = "Process/Payment history";
    
    $.ajax({
    
      type: 'POST',
      url: url,
      data: form.serialize(),
      dataType: 'json',
      encode: true,
      success: function (data) {
    
        console.log();
    
        var error_message = document.querySelector(".error_message");
    
        error_message.innerHTML = data.responseText;
    
        if (data.responseText === "\r\nok") {
    
          error_message.innerHTML = "Error fetching data,please try again.";
        } 
    
    
    
      },
      error: function (data) {
    
        var error_message = document.querySelector(".error_message");
    
        error_message.innerHTML = data.responseText;
    
        if (data.responseText === "\r\nok") {
    
          error_message.innerHTML = "Error fetching data,please try again.";
        } 
    
      }
    });
    
    
    }
    
    
    
    document.querySelector(".refresh_data").addEventListener("click",Refresh_data);
    
    
    function Refresh_data(){
    
    
      var body = document.body;
    
      body.classList.add("add-loading");
      
    
      var form = $("#form_id");
    
      var url = "Process/Refresh Payment history";
      
      $.ajax({
      
        type: 'POST',
        url: url,
        data: form.serialize(),
        dataType: 'json',
        encode: true,
        success: function (data) {
      
          console.log();
      
          body.classList.remove("add-loading");
      
          var error_message = document.querySelector(".error_message");
      
          error_message.innerHTML = data.responseText;
      
      
          var error_message = document.querySelector(".error_message");
      
          error_message.innerHTML = data.responseText;
      
      
      
          if (data.responseText === "\r\nok") {
      
            error_message.innerHTML = "Error fetching data,please try again.";
          } 
      
      
      
        },
        error: function (data) {
      
          body.classList.remove("add-loading");
      
          var error_message = document.querySelector(".error_message");
      
          error_message.innerHTML = data.responseText;
      
      
          if (data.responseText === "\r\nok") {
      
            error_message.innerHTML = "Error fetching data,please try again.";
      
          } 
        }
      });
      
    
    
    
    
    }
    
    
    
        function Fetch_histroy(){

            document.querySelector(".loader-container-overlay").style.display ="block";
    

          document.querySelector(".error_message").innerHTML = "...";
    
          var form = $("#form_id");
    
          var url = "Process/Fetch Payment history";
    
          $.ajax({
    
            type: 'POST',
            url: url,
            data: form.serialize(),
            dataType: 'json',
            encode: true,
            success: function (data) {
    
              console.log();
    
    
              document.querySelector(".loader-container-overlay").style.display ="none";
    
              var error_message = document.querySelector(".error_message");
    
              error_message.innerHTML = data.responseText;
    
    
              var error_message = document.querySelector(".error_message");
    
              error_message.innerHTML = data.responseText;
    
    
    
              if (data.responseText === "\r\nok") {
    
                error_message.innerHTML = "Error fetching data,please try again.";
    
              }
    
    
    
            },
            error: function (data) {
    
                document.querySelector(".loader-container-overlay").style.display ="none";
    
    
              var error_message = document.querySelector(".error_message");
    
              error_message.innerHTML = data.responseText;
    
    
              if (data.responseText === "\r\nok") {
    
                error_message.innerHTML = "Error fetching data,please try again.";
    
              } 
    
            }
          });
    
        }
    
        MyVar = Fetch_histroy();