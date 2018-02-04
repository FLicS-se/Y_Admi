<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM sample INNER JOIN cuisine ON sample.cuisineID = cuisine.cuisineID';
$res = $db->query($sql);

while($row = $res->fetchArray()) {

	$matching[] = array(
	'StoreID' => $row[0],
	'SakeID'=> $row[1],
	'CuisineID' => $row[2],
	'DifferenceTaste' => $row[3], 
	'CuisineName' => $row[6],
	'Image' => $row[7]

	);
}
// jsonとして出力
print_r('{    "matching":');
print_r(json_encode($matching, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
