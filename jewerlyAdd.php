<?php 
////////////----Гнорм, который добыл драгоценность----/////////////////
session_start();
$dwarf = $_SESSION['user'];
////////////----Дата добычи----///////////////////////////////////////
date_default_timezone_set('Asia/Yekaterinburg');
$date = date('d-m-Y', time());
////////////////----Драгоценности----/////////////////////////////////
$res = json_decode($_POST['data']);
$i = 0;
$und_jew = [];
foreach ($res as $key => $value){
	$und_jew[$i] = [
		"name" => $value->name,
		"count"=> $value->count
	];
	$i++;
}

$add_jew = [];
for ($i = 0; $i < count($und_jew); $i++) {
	if ($und_jew[$i]["count"] > 1) {
		for ($j = 0; $j < $und_jew[$i]["count"]; $j++){
			array_push($add_jew, $und_jew[$i]["name"]);
			
		}
	}
	else  array_push($add_jew, $und_jew[$i]["name"]);
}

$connect = mysqli_connect('localhost', 'root', '', 'creatures');
$timer = 0;
for ($i = 0; $i < count($add_jew); $i++) { 
	$query = mysqli_query($connect,"INSERT INTO undistributed_jewerly (name_jewerly, date_of_production, dwarf_who_got)
	 VALUES ('{$add_jew[$i]}', '{$date}', '{$dwarf}')");
	$timer++;
}
if ($timer > 0) echo "success";























































// $connect = mysqli_connect('localhost', 'root', '', 'creatures');
// $query = mysqli_query($connect,"SELECT name_jewerly, count_jew FROM `undistributed_jewerly`");
// ///////////////////////////////////////////////////////////////////////////////////////////////
// $sql_result = [];	
// $i = 0;
// $result = [];
// while ($row=mysqli_fetch_assoc($query)) {
// 	$sql_result[$i] = $row;
// 	$res_arr[$i] = [
// 		"name" => $sql_result[$i]["name_jewerly"],
// 		"count" => $sql_result[$i]["count_jew"]
// 	];	
// 	$i++;
// };
// $result = array_merge($result, $res_arr);
/////////////////////////////////////////////////////////////////////////////////////


// /////////////////////////////////////////////////////////////////////////////////////
// $r1d = 0;
// $r2d = 0;
// $r3 = 0;
// for ($z = 0; $z < 39; $z++) {
// 	if ($result[$z]["name"] == $und_jew[$z]["name"]) {
// 		$r1d = (int)$result[$z]["count"];
// 		$r2d = (int)$und_jew[$z]["count"];
// 		$r3 = $r1d + $r2d; 
// 		$result[$z]["count"] = strval($r3);
// 	}
// 	else echo "rer ";
// }
// /////////////////////////////////////////////////////////////////////////////////////
// for ($x = 0; $x < count($result); $x++) {
// 	$query=mysqli_query($connect,"UPDATE undistributed_jewerly SET count_jew = '{$result[$x]["count"]}' 
// 		WHERE name_jewerly = '{$result[$x]["name"]}'");
// }
// /////////////////////////////////////////////////////////////////////////////////////
// if ($query) echo "success";
// else echo "error";
?>