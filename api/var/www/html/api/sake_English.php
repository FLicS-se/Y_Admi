<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM sake_English INNER JOIN sake ON sake_English.SakeID = sake.SakeID';

$res = $db->query($sql);

while($row = $res->fetchArray()) {

	$sake_English[] = array(
	'sakeID' => $row[0],
	'storeID'=> $row[1],
        'sakeName' => $row[5],
        'Image' => $row[6],
        'Price' => $row[7],
	'Introduction' => $row[2]
	);
}
// jsonとして出力
print_r('{    "sake_English":');
print_r(json_encode($sake_English, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
