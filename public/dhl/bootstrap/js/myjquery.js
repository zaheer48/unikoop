
$(document).ready(function(){
	
    $("#hide").click(function(){
        $("#pwd").hide();
    });
    $("#show").click(function(){
        $("#pwd").show();
		
		$(".box").hide();
		$(".box2").hide();
    });
	
	$("#hides").click(function(){
        $("#pwd").hide();
        $(".box").show();
    });
	
	$("#shows").click(function(){
        $("#pwd").show();
		$(".box2").hide();
    });
	
	$("#hid").click(function(){
        $(".box2").show();
        $("#pwd").hide();
    });
	
	$(".enitys").click(function(){
        $("#comp_detail").show();
        $("#individual").hide();
    });
	
	$('.onRegisteredChange').click(function() {
        if ($(this).is(':checked')) {
			$("#dbreg").show();
        }
		else
		{
			 $("#dbreg").hide();
		}
    });
	
	$(".enitys1").click(function(){
        $("#individual").show();
        $("#comp_detail").hide();
    });
	$("#ad_exten").click(function(){
        $("#extention").show();
        $("#ad_exten").hide();
    });
	
	$("#individual").hide();
	$("#extention").hide();
	$("#dbreg").hide();
	 $("#comp_detail").hide();
	$(".box2").hide();
	$(".entity").hide();
	$(".box").hide();
	



});
