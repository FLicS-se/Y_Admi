<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");
$array = file(__DIR__ . '/txt.txt');

$sql = 'UPDATE accommodation set People ='.$array[0];
$res = $db -> query($sql);

?>
