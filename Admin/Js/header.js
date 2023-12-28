document.querySelector("#open-sidebar-btn").addEventListener("click",openside_bar);

function openside_bar(){

  var body = document.body;

  body.classList.add("add-sidebar");

    //document.querySelector(".sidebar-menu-container").style.width="100%";
}


document.querySelector(".close-sidebar-btn").addEventListener("click",close_sidebar);

function close_sidebar(){

  var body = document.body;

  body.classList.remove("add-sidebar");
}

/*
function showHint(str){

  if(str.length == 0){
  
    document.getElementById("txtHint").innertHTML ="";
    return;
  
  }else{
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
  
  
    if(this.readyState == 4 && this.status == 200){
  
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  
  xmlhttp.open("GET", "Text hint?q=" + str,true);
  xmlhttp.send();
  
  
  }
  
  }*/
  