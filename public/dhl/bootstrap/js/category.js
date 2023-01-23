$(function(){
				$("#other").change(function() {
					  $("#adcls,#adcls1,#adcls2,#adcls3").toggleClass( "hides" );
					
					});
						
					   $(".required").change(function(){
					   		var cnt=0;
					  	 	var cnt_tot=0; 
					   		
					   		
					   		 $(".required" ).each(function() {
					   		 	cnt_tot++;
					   		 });
					       	
					       
					       	
					        $(".required" ).each(function() {
					        	    if($(this).val()) {
								    	if($(this).val() != " ")
								    		cnt++;
								    		$("#btnnn").attr('disabled','disabled');
								          
								    }
								    //alert($(this).val());
									//alert(cnt);
								});
								if(cnt == cnt_tot){
									//alert(cnt);
								    	
								    	$("#btnnn").removeAttr('disabled');
								    }
								   
    			    });
});

function categoryName(title,id)
		{
			
		var inner_box="<div class='leaf-card-elements'> <h4> "+ title +" </h4><span class='a-button a-button-span6 a-button-primary'> <span class='a-button-inner'><a  class='btn btn-success btn-md' href='product_ad/index/"+ id +"/add' role='button'>Select</a></span></span></div>";
		
		 document.getElementById("innerbox").innerHTML =inner_box ;
		 return false;
		}
		
		
		
		
		
		/*
function check_input()
{	
	
var elements = document.getElementById("prod-form").elements;
var length = document.getElementById("prod-form").elements.length; 

		
			var check_t=0;
    //adddlert("Welcome guest!");
	for (var i = 0; i < length; i++) {

		alert(i);
		
		if(elements[i].type !="checkbox")
			{
    	if ((elements[i].type === "text" && elements[i].value === "") || (elements[i].type === "number" && elements[i].value === "")  || (elements[i].type === "date" && elements[i].value === "") || (elements[i].type === "file" && elements[i].value === "") || (elements[i].type === "select-one" && elements[i].value === "") || (elements[i].type === "textarea" && elements[i].value === ""))
    	  	{ //  console.log("it's an empty textfield");
     			//alert('www');
     			
			}
		else{
			//alert('done');
			//alert(elements[i].value);
			check_t++;
		}
		if(check_t>length){
			alert("done");
		}
		
	}
	
	}

	
}
*/