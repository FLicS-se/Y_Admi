<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM 
	(sample INNER JOIN cuisine_English ON sample.cuisineID = cuisine_English.cuisineID)
	INNER JOIN cuisine ON cuisine_English.cuisineID = cuisine.cuisineID';
$res = $db->query($sql);

while($row = $res->fetchArray()) {

	$matching[] = array(
	'StoreID' => $row[0],
	'SakeID'=> $row[1],
	'CuisineID' => $row[2],
	'DifferenceTaste' => $row[3], 
	'CuisineName' => $row[5],
	'Image' => $row[9]

	);
}
// jsonとして出力
print_r('{    "matching":');
print_r(json_encode($matching, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
