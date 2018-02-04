<?php
$db = new SQLite3("/home/ubuntu/db/yamada.db");

$sql = 'SELECT * FROM reservation ORDER BY Year asc, Month asc, Date asc, Time asc';
$res = $db->query($sql);

while($row = $res->fetchArray()) {
        // 年月日の調整
        $row[4] = '20'.$row[4];

        if($row[5] <= 9){
           $row[5] = '0'.$row[5];
        }
        if($row[6] <= 9){
           $row[6] = '0'.$row[6];
        }

        $date = date('Y年m月d日', strtotime($row[4].$row[5].$row[6]));
        $time = date('H:i', strtotime($row[7]));

	$reservation[] = array(
	'StoreID' => $row[0],
	'ReservationID'=> $row[1],
	'VisitorName' => $row[2],
	'Reservation' => $row[3],
	'Date' => $date.$time
	);
}
// jsonとして出力
print_r('{    "sake":');
print_r(json_encode($reservation, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
print_r('}');
?>
