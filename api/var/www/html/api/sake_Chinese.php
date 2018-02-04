<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM sake_Chinese INNER JOIN sake ON sake_Chinese.SakeID = sake.SakeID';
$res = $db->query($sql);

while($row = $res->fetchArray()) {
	$sake_Chinese[] = array(
	'SakeID' => $row[0],
	'StoreID'=> $row[1],
        'SakeName' => $row[5],
        'Image' => $row[6],
        'Price' => $row[7],
	'Introduction' => $row[2] 
	);
}
// jsonとして出力
print_r('{    "sake_Chinese":');
print_r(json_encode($sake_Chinese, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
