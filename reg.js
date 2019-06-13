$(document).ready(function() {
	$('#submit').click(function(){
   		$.ajax({ 
         	type: "POST",
         	url: "reg.php",
         	dataType: "html",
         	data: $('#form2').serialize(),
         	success: function(data) {
         	  if(data=="success") window.location = "auto.html";
               else alert(data);
         	}
   		})
	});
});
