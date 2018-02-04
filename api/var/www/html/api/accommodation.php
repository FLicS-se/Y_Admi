<?php
//header("Pragma: no-cache");
//exec('php countPeople.php');

$db = new SQLite3("/home/ubuntu/db/yamada.db");

$array = file(__DIR__ . '/txt.txt');

$sql = 'UPDATE accommodation set People ='.$array[0];
$res1 = $db -> query($sql);


$sql = 'SELECT * FROM accommodation';
$res = $db->query($sql);

while($row = $res->fetchArray()) {

	$accomodation[] = array(
	'StoreID' => $row[0],
	'People'=> $row[1],
	'Accomodation' => $row[2]
	);
}

// jsonとして出力
print_r('{    "accomodation":');
print_r(json_encode($accomodation, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
