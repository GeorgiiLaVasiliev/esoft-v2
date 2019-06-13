<?php
$connect=mysqli_connect('localhost', 'root', '', 'creatures');

$sql_query=mysqli_query($connect,"SELECT firstname, date_of_reg, last_date_online FROM elfes INNER JOIN user_online ON elfes.firstname = user_online.user");

$sql_result=[];

$i=0;
$res=[];

while($row=mysqli_fetch_assoc($sql_query)){
	$sql_result[$i]=$row;
	$res_arr[$i] = [
		"log" => $sql_result[$i]["firstname"], 
		"reg" => $sql_result[$i]["date_of_reg"], 
		"auto" => $sql_result[$i]["last_date_online"]
	];	
	$i++;
};
$res = array_merge($res, $res_arr);
echo json_encode($res);
?>