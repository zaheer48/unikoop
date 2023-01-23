function add_to_cart() {
    var ptitle=document.getElementById("product_title").value;
    var price=document.getElementById("prices").value ;
    var label_title=document.getElementById("label_title").value ;
    var user_id=document.getElementById("user_id").value ;
    var prod_id=document.getElementById("prod_id").value ;
    var quantiy=document.getElementById("quantiy").value ;
    
    if(quantiy>0)
    {

    if(label_title=="")
      {
        label_title="no_label";
      }

 var x = document.getElementById("snackbar")
    x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  var xhttp;
  var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("items").innerHTML = this.responseText;
      get_total_amount();
    }
  };
  xhttp.open("POST","http://unikoop.com/pages/addtocart/"+label_title+"/"+price+"/"+user_id+"/"+prod_id+"/"+quantiy+"/"+ptitle, true);
  xhttp.send(); 
  }  
}

function get_total_amount(){
var xhttp;
  var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("cart").innerHTML = this.responseText;
       document.getElementById("check").className= "highlighted";

          setTimeout(function() {
        document.getElementById("check").className= "check";
       
             }, 2000);
       }
  };
  xhttp.open("POST","http://unikoop.com/pages/fetch_cart_amount", true);
  xhttp.send();  
}
function update_quantiy(qty,cid) 
{

  var qty=document.getElementById(qty).value;
  var cid=document.getElementById(cid).value;

    var xhttp;
    var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //document.getElementById("items").innerHTML = this.responseText;
          location.reload();

      }
    };
    xhttp.open("POST","http://unikoop.com/pages/update_cart/"+qty+"/"+cid, true);
    xhttp.send(); 

}
function delete_cart(id)
{

    var xhttp;
    var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //document.getElementById("items").innerHTML = this.responseText;
          location.reload();

      }
    };
    xhttp.open("POST","http://unikoop.com/shopping_cart/delete_cart/"+id, true);
    xhttp.send();   
}