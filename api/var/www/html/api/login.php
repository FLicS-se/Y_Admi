<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM login';
$res = $db->query($sql);

while($row = $res->fetchArray()) {

	$store[] = array(
	'StoreID' => $row[0],
	'Password'=> $row[1]
	);
}
// jsonとして出力
print_r('{    "login":');
print_r(json_encode($store, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
