<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM cuisine_English INNER JOIN cuisine 
		ON cuisine_English.CuisineID = cuisine.CuisineID';
$res = $db->query($sql);


while($row = $res->fetchArray()) {

	$cuisine_English[] = array(
	'cuisineID' => $row[0],
	'cuisineName'=> $row[1],
        'Image' => $row[5],
        'Price' => $row[6]
	);
}
// jsonとして出力
print_r('{    "cuisine_English":');
print_r(json_encode($cuisine_English, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
