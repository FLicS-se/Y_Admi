<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM cuisinedata';
$res = $db->query($sql);

while($row = $res->fetchArray()) {

	$cuisinedata[] = array(
	'StoreID' => $row[0],
	'CuisineID'=> $row[1],
	'Sweetness' => $row[2],
	'SaltDry' => $row[3],
	'Acidity' => $row[4],
	'Bitterness' => $row[5],
	'Taste' => $row[6]
	);
}
// jsonとして出力
print_r('{    "cuisinedata":');
print_r(json_encode($cuisinedata, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
