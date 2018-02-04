<?php
$db = new SQLite3("/home/ubuntu/yamada.db");

$sql = 'UPDATE accommodation set People = 0';
$res = $db->query($sql);

?>
