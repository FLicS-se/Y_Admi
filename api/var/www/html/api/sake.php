<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM sake';
$res = $db->query($sql);

while($row = $res->fetchArray()) {

	$sake[] = array(
	'SakeID' => $row[0],
	'StoreID'=> $row[1],
	'SakeName' => $row[2],
	'ImageName' => $row[3],
	'Price' => $row[4],
	'Introduction' => $row[5] 
	);
}
// jsonとして出力
print_r('{    "sake":');
print_r(json_encode($sake, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
