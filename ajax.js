$(document).ready(function() {
    $('#submit').click(function(){
   		$.ajax({ 
         	type: "POST",
         	url: "auto.php",
         	dataType: "html",
         	data: $('#form1').serialize(),
         	success: function(data){
         		if(data=="success") window.location = "elf.html";
         		else alert(data);
         	}
   		});
	});
});

