function subsc() {

	 var email=document.getElementById("subscribe").value;

	   var xhttp;
  var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //document.getElementById("items").innerHTML = this.responseText;
  document.getElementById("subsc").className= "alert alert-success alert-dismissable fade in display_block";
 window.scrollTo(0,document.body.scrollHeight);
    }
  };
  xhttp.open("POST","http://unikoop.com/subscribe/sub/"+email, true);
  xhttp.send(); 
}