$(document).ready(function() {
	$.ajax({
		type: "POST",
	   	url: "users_array.php",
	   	dataType: "html",
	   	success: function(data){    	
	   		var res = JSON.parse(data);
	   		var str;
			for(var i in res){
				str += '<tr>';
			  	str += '<td>'+res[i].log+'</td>';
			  	str += '<td>'+res[i].reg+'</td>';
			  	str += '<td>'+res[i].auto+'</td>';
			  	str += '</tr>';
			};
			$('.leftTab .tleft').append(str);
   		}

	});	
	$.ajax({
		type: "POST",
	   	url: "users_array2.php",
	   	dataType: "html",
	   	success: function(data){    		
	   		var res2 = JSON.parse(data);
	  		var str;
			for(var i in res2){
				str += '<tr>';
			  	str += '<td>'+res2[i].log+'</td>';
			  	str += '<td>'+res2[i].reg+'</td>';
			  	str += '<td>'+res2[i].auto+'</td>';
			  	str += '</tr>';
			}
			
			$('.rightTab .tright').append(str);
   		}

	});	
});