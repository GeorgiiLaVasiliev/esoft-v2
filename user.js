$(document).ready(function() {
document.getElementById("createtab").disabled = true;
$.ajax({ 
   type: "POST",
   url: "user.php",
   dataType: "html",
   success: function(data){ 
      if (data == "session is empty"){
         console.log(data);
         window.location = "auto.html";
      }
      else {
         if (data == "no user in db") window.location = "auto.html";
         else {
            var result = JSON.parse(data);
            $('#welcome1').val(result.hello);
            $('#name').val(result.name);
            $('#login').val(result.login);
         }   
      }
   }
});
   ///////////////////////////////////////////////////////////////////////////////
$("#exit").click(function(){
   $.ajax({ 
   type: "POST",
   url: "exit.php",
   dataType: "html",
   success: function(data){ 
      if (data=="ok") {
         console.log(data);
         alert("Вы вышли из своего аккаунта");
         window.location = "auto.html";
      }
   }
   })
});
   ///////////////////////////////////////////////////////////////////////////////
$("#update").click(function(){
   $.ajax({ 
   type: "POST",
   url: "update.php",
   dataType:"html",
   data: $('#form3').serialize(),
   success: function(data){ 
      if (data=="update ok"){
         //alert("Сейчас обновится страница");
         console.log(data);
         window.location.reload();
      }
      else  {
         alert(data);
      }
   }
   });
});
///////////////////////////////////////////////////////////////////////////////   
$("#open_jew").click(function(){
   $.ajax({
      type: "POST",
      url: "jewerly.php",
      dataType: "html",
      success: function(data) {    
         var res = JSON.parse(data);
         var str = '<h2 style>Драгоценности</h2>';
         for(var i in res){            
            str += '<div class="all_jewerly_item">';
            str += '<input id="inp' + i + '" type="number" min="0" max="100" pattern="[0-100]">';
            str += '<label id="lab' + i + '">' + res[i].name + '</label>';
            str += '</div>';
         }
         str += '</div>';
         $('.window_4').append(str);
      }  
   });
   document.getElementById("createtab").disabled = false;
});
///////////////////////////////////////////////////////////////////////////////   
$("#createtab").click(function(){
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
   $.ajax({
      type: "POST",
      url: "createtab.php",
      dataType: "html",
      data: { "data" : data}, 
      success: function(data) {  
         alert(data);
      }
   });
});
///////////////////////////////////////////////////////////////////////////////   ;
});
