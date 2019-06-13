<?php
////////////////////////////////////////////////////////////////////
$connect = mysqli_connect('localhost', 'root', '', 'creatures');
////////////----Эльф, который добавил предпочтения----/////////////////
session_start();
$elf = $_SESSION['user'];
////////////----ИМЯ ТАБЛИЦЫ----///////////////////////////////////////
$str = "_love_jew";
$name_table = strval($elf) . $str;

////////////////----Драгоценности----/////////////////////////////////
$res = json_decode($_POST['data']);
$i = 0;
$love_jew = [];
foreach ($res as $key => $value){
	$love_jew[$i] = [
		"name" => $value->name,
		"count"=> $value->count
	];
	$i++;
}
//////////////////////////////////////////////////////////////////
$count_love = 0;
for ($i = 0; $i < count($love_jew); $i++) {
	$count_love += (int)$love_jew[$i]["count"];
}

if ($count_love > 100) echo "Сумма предпочтений большее 100, исправьте";
else {
	for ($i = 0; $i < count($love_jew); $i++) {
		$querry =  mysqli_query($connect,"CREATE TABLE `{$name_table}` (`name_jew` VARCHAR(50) NOT NULL,
			`count_love` VARCHAR(5) NOT NULL)");
		$querry = mysqli_query($connect,"INSERT INTO $name_table (name_jew, count_love) VALUES('{$love_jew[$i]["name"]}','{$love_jew[$i]["count"]}')"); 
	}
	if ($querry) echo "success";
	else echo "err";

}

//////////////////////////////////////////////////////////////////

?>