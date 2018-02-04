<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM store_Chinese';
$res = $db->query($sql);

while($row = $res->fetchArray()) {

$store_chinese[] = array(
	'StoreID' => $row[0],
	'Introduction' => $row[1]
	);
}
// jsonとして出力
print_r('{    "store_Chinese":');
print_r(json_encode($store_chinese, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
