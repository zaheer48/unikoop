function makeAjaxCall() {

  var xhttp;

    var d1 = document.getElementById("label_heading").value;
    var d2=document.getElementById("label_price").value ;
    var d3=document.getElementById("prod_id").value ;

     if ((d1 != "") && (d2 !="") ) 
     {
     

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("label_data").innerHTML = this.responseText;
      
    }
  };
  xhttp.open("GET", "http://unikoop.com/seller/product_ad/product_label_price/"+d1+"/"+d2+"/"+d3, true);
  xhttp.send();  
  }
}
function delete_label(id,prod_id)
{

  var xmlhttp;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("label_data").innerHTML = this.responseText;

            }
        };
 
  xmlhttp.open("GET", "http://unikoop.com/seller/product_ad/delete_product_label/"+id+"/"+prod_id, true);
  xmlhttp.send();  
   

}
 function changeinp(id1,id2,bid,uid)
{
    document.getElementById(id1).readOnly = false;
    document.getElementById(id2).readOnly = false;
    document.getElementById(bid).style.display = "none";
    document.getElementById(uid).classList.remove("hidden");

}
 function Updateinp(id1,id2,id)
{
   var label_heading=document.getElementById(id1).value ;
    var label_price =document.getElementById(id2).value ;
    
   var label_id=document.getElementById("prod_id").value ;

   var xmlhttp;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("label_data").innerHTML = this.responseText;
                
            }
        };
 
  xmlhttp.open("GET", "http://unikoop.com/seller/product_ad/Update_product_label/"+label_heading+"/"+label_price+"/"+label_id+"/"+id, true);
  xmlhttp.send();  
}

function pricechange() {
    var x = document.getElementById("pricelabel").value;
    var res = x.split('::')[0];
    var res2 = x.split('::')[1];

    document.getElementById("price").innerHTML =  res;
    document.getElementById("prices").value =  res;
    document.getElementById("label_title").value =  res2;

}