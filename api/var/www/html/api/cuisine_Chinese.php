<?php
header("Content-Type: text/html; charset=utf-8");
//echo mb_internal_encoding();
//mb_internal_encoding("GB2312");
//echo mb_internal_encoding();

$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM cuisine_Chinese INNER JOIN cuisine
		ON cuisine_Chinese.CuisineID = cuisine.CuisineID';
$res = $db->query($sql);

while($row = $res->fetchArray()) {

	$cuisine_Chinese[] = array(	
	'cuisineID' => $row[0],
	'cuisineName'=> $row[1],
        'Image' => $row[5],
        'Price' => $row[6]
	);
}

// jsonとして出力
print_r('{    "cuisine_Chinese":');
print_r(json_encode($cuisine_Chinese, JSON_UNESCAPED_UNICODE| JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
