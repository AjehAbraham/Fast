
function copyCode(){

  var code = document.querySelector("#TrackCode");
  code.select();
  code.setSelectionRange(0,99999);
    navigator.clipboard.writeText(
      code.value);
    alert("copied to Clipboard");
    
    document.getElementById("copy-btn").innerText="Copied";
}