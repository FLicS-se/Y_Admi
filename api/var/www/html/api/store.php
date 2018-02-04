<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM store';
$res = $db->query($sql);

while($row = $res->fetchArray()) {

	$store[] = array(
	'StoreID' => $row[0],
	'StoreName'=> $row[1],
	'ImageName' => $row[2],
	'Introduction' => $row[3],
	'Address' => $row[4],
	'PhoneNumber' => $row[5]
	);
}
// jsonとして出力
print_r('{    "store":');
print_r(json_encode($store, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
