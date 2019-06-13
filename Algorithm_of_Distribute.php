<?php
$connect = mysqli_connect('localhost', 'root', '', 'creatures');
//////////////////----КОЛИЧЕСТВО ЭЛЬФОВ----///////////////////////////////////////////////////////////////////////////////////////
$query = mysqli_query($connect,"SELECT firstname FROM `elfes`");
$Count_of_Elfes = mysqli_num_rows($query);
//////////////////----КОЛИЧЕСТВО КАМНЕЙ----///////////////////////////////////////////////////////////////////////////////////////
$query = mysqli_query($connect,"SELECT name_jewerly FROM `undistributed_jewerly`");
$Count_of_Jewerly = mysqli_num_rows($query);

$sql_result = [];	
$i = 0;
while ($row=mysqli_fetch_assoc($query)) {
	$sql_result[$i] = $row;
	$arr_jew[$i] = $sql_result[$i]["name_jewerly"];	//МАССИВ ДРАГОЦЕННОСТЕЙ ДЛЯ РАСПРЕДЕЛЕНИЯ
	$i++;
};
///////////////////////-----ПРОЦЕНТЫ УСЛОВИЙ----///////////////////////////////////////////////////////////////////////////////////
$query = mysqli_query($connect,"SELECT numb_condition, condition_procent FROM `condition_of_system`");
//////////////////////////////////////////
$sql_result = [];	
$i = 0;
$conditions = [];
//////////////////////////////////////////
while ($row = mysqli_fetch_assoc($query)) {
	$sql_result[$i] = $row;
	$res_arr[$i] = [
		"numb" => $sql_result[$i]["numb_condition"],
		"procent" => $sql_result[$i]["condition_procent"]
	];	
	$i++;
};
$conditions = array_merge($conditions, $res_arr);
//////////////////////////////////////////
$First_Condition = $conditions[0]["procent"]; //Требование равномемерного распределения
$Second_Condition = $conditions[1]["procent"];//Требование справедливого распределения
$Third_Condition = $conditions[2]["procent"]; //Требование учета предпочтений
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
iF (!More_or_Less_Half($Count_of_Elfes, $First_Condition) || !More_or_Less_Half($Count_of_Elfes, $Second_Condition) || !More_or_Less_Half($Count_of_Elfes, $Third_Condition)) {
	// Если больше половины
	for ($i = 0; $i < count($arr_jew); $i++) {
		
	}
}
else echo "true";

































/////////////////////////----ФУНКЦИИ----////////////////////////////////////////////////////////////////////////////////////////////
function More_or_Less_Half($elf, $cond){
	$metka = ($elf / 100) * $cond;

	if(round($metka) >= ($elf / 2)) return true;
	else return false;

}
?>
