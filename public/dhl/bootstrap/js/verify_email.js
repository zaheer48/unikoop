function verify_email(){

   var email =document.getElementById("email").value;

var xhttp;
 var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

        if(this.responseText=="no")
        {
             document.getElementById("mail_alert").className= "alert alert-danger alert-dismissable display_block";
             document.getElementById("mail_alert2").className= "alert alert-success alert-dismissable fade in display_none";
               document.getElementById("myBtn").disabled = true;
        }
        else
        { 
            document.getElementById("mail_alert").className= "alert alert-danger alert-dismissable display_none";
             document.getElementById("mail_alert2").className= "alert alert-success alert-dismissable display_block";
             document.getElementById("myBtn").disabled = false;
         }  
       }
  };
  xhttp.open("POST","http://unikoop.com/ultimatecheckout/validate_email/"+email, true);
  xhttp.send();  
}
function verify_pwd()
{
  var pwd =document.getElementById("pwd").value;
  var cpwd =document.getElementById("cpwd").value;
  if(pwd !="" || cpwd !="")
  { 

    if(pwd != cpwd)
      {
        document.getElementById("pwd_alert").className= "alert alert-danger alert-dismissable display_block";
        return false;
      }
    else
      {
        return true;
      }
  }
else
  {
    return true;
  }
}