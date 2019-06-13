$(document).ready(function() {	
	//////////////////////////////////////////////////////////////////////////////////////
	$.ajax({
		url: "check_for_dwarf.php",
		success: function(data) {
			console.log(data);
			if (data == "dwarf") alert("Добро пожаловать, добытчик");
			else window.location = "elf.html";
		}
	});
	//////////////////////////////////////////////////////////////////////////////////////
	$.ajax({
		type: "POST",
	   	url: "jewerly.php",
	   	dataType: "html",
	   	success: function(data) {    
	   		var res = JSON.parse(data);
	   		var str = '<h2 style>Драгоценности</h2>';
			for(var i in res){				
				str += '<div class="all_jewerly_item">';
			  	str += '<input id="inp' + i + '" type="number" min="0" max="5" pattern="[0-5]">';
			  	str += '<label id="lab' + i + '">' + res[i].name + '</label>';
		  		str += '</div>';
			}
			$('.all_jewerly2 .jewerly').append(str);
   		}
	});
	//////////////////////////////////////////////////////////////////////////////////////
$('#submit').click(function(){
	var arrJew = [];
	for (var i = 0; i < 39; i++) {
		item = {};
		item ["count"] =  document.getElementById('inp'+i+'').value;
		item ["name"] = document.getElementById('lab'+i+'').textContent;
		if (item["count"] > 0) {
			arrJew.push(item);
		};
	};
	var data = JSON.stringify(arrJew);
	/////////////////////////////////////////////////
	$.ajax({
		type: "POST",
	   	url: "jewerlyAdd.php",
	   	dataType: 'html',
	   	data: { "data" : data}, 
	   	success: function(data) {  
	   		if (data == "success") alert("Добавлено");
	   		else console.log(data);
		}
	});
});
	//////////////////////////////////////////////////////////////////////////////////////

});
