document.querySelector(".country-name").addEventListener("onchange",select_country_code);


function select_country_code(){

var county_name = document.querySelector(".country-name");

if (county_name.value == "Nigeria"){

document.querySelector(".country-code").value = "+234"

}else if (county_name.value == 'Ghana'){
    
document.querySelector(".country-code").value = "+222"
}else{
    
document.querySelector(".country-code").value = "+233"
}

}