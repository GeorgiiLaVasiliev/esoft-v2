$(document).ready(function() {	
$.ajax({
	type: "POST",
   	url: "AllJewerly.php",
   	dataType: "html",
   	success: function(data) {   
   		var res = JSON.parse(data);
   		var str ='';
		for(var i in res){				
			str +='<tr>';
			str += '<td>' + res[i].name + '</td>';
			str += '<td>' + res[i].date_prod + '</td>';
			str += '<td>' + res[i].dwarf + '</td>';
			str += '<td>' + res[i].elf + '</td>';
			str += '</tr>';
		}
		$('tbody').append(str);
		
		}
});
///////////////////////////////////////////////////////////////
$('#distrib').click(function(){
	$.ajax({	
	type: "POST",
   	url: "Algorithm_of_Distribute.php",
   	dataType: "html",
   	success: function(data) {   
   		console.log(data);
	}

	});
});
///////////////////////////////////////////////////////////////
});
// str += '<div class="all_jewerly_item">';
// str += '<label>' + res[i].count + '</label>';
// str += '<label>' + res[i].name + '</label>';
// str += '</div>';