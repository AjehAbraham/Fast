

<style>
.Network-status-message{
text-align: center;
top: 0;
left: 0;
right: 0;
bottom: 0;
z-index: 1;
background-color: rgba(0,0,0,0.4);
  position: fixed;
  display: none;
}
.Network-status-message p{
text-align: center;
color: white;
width: 90%;
margin: auto;
background-color: rgb(0, 102, 153);
  padding: 10px 10px;
margin-top:  20%;
}

</style>

  <div class="Network-status-message">

       <p><i class="fa fa-wifi"></i> Opps!,no Internet connection,Please check your connection.</p>
  </div>


  <script>

    
window.addEventListener('offline', (e) => 
{
console.log('offline');
document.querySelector(".Network-status-message").style.display = "block";
});


window.addEventListener('online', (e) => 
{
console.log('online');

document.querySelector(".Network-status-message").style.display = "none";
});
</script>

