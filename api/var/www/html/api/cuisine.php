<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM cuisine';
$res = $db->query($sql);

while($row = $res->fetchArray()) {

	$cuisine[] = array(
	'cuisineID' => $row[0],
	'storeID'=> $row[1],
	'cuisineName' => $row[2],
	'imageName' => $row[3],
	'price' => $row[4]
	);
}
// jsonとして出力
print_r('{    "cuisine":');
print_r(json_encode($cuisine, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
