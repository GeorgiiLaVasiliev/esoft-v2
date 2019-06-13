<?php  
/////////////////////////////////////////////////////////////////////////////////////
$connect = mysqli_connect('localhost', 'root', '', 'creatures');
$query = mysqli_query($connect,"SELECT name_jewerly, date_of_production, dwarf_who_got, elf_owner FROM `undistributed_jewerly`");

/////////////////////////////////////////////////////////////////////////////////////
$sql_result = [];	
$i = 0;
$res = [];
/////////////////////////////////////////////////////////////////////////////////////
while ($row=mysqli_fetch_assoc($query)) {
	$sql_result[$i] = $row;
	$res_arr[$i] = [
		"name" => $sql_result[$i]["name_jewerly"],
		"date_prod" => $sql_result[$i]["date_of_production"],
		"dwarf" => $sql_result[$i]["dwarf_who_got"],
		"elf" => $sql_result[$i]["elf_owner"]
	];	
	
	$i++;
};
/////////////////////////////////////////////////////////////////////////////////////
$res = array_merge($res, $res_arr);
echo json_encode($res);
?>