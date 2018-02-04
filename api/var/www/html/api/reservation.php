<?php
    date_default_timezone_set('asia/Tokyo');
    //echo date('Y年m月d日', strtotime("0 day"));

    $db = new SQLite3("/home/ubuntu/db/yamada.db");

    $sql = 'SELECT * FROM reservation ORDER BY Year asc, Month asc, Date asc, Time asc';
    $res = $db->query($sql);
    
    $today = null;
    $reservation = null;

    while($row = $res->fetchArray()) {
        // 年月日の調整
        if($row[4] < 100) {	
	   $row[4] = '20'.$row[4];
        }
	if($row[5] <= 9){
	   $row[5] = '0'.$row[5]; 
	}
        if($row[6] <= 9){
	   $row[6] = '0'.$row[6];
	}
	$date = date('Y年m月d日', strtotime($row[4].$row[5].$row[6]));
        $md = date('m月d日', strtotime($row[4].$row[5].$row[6]));
        $time = date('H:i', strtotime($row[7]));
	
	//echo date('Y年m月d日H:i', strtotime($row[4].$row[5].$row[6].$row[7]));
        if(date('Y年m月d日', strtotime("-1 day")) < $date 
		&& $date <= date('Y年m月d日', strtotime("+1 week"))){

            if(date('Y年m月d日', strtotime("0 day")) == $date) {
               $today[] = array(
                    'StoreID' => $row[0],
                    'ReservationID'=> $row[1],
                    'VisitorName' => $row[2],
                    'Persons' => $row[3],
                    //'Year' => $row[4],
                    //'Month' => $row[5],
                    'Date' => $md,
                    //'Time' => $row[7],
                    'Time' => $time
                );
            } else {
                $reservation[] = array(
		    'StoreID' => $row[0],
		    'ReservationID'=> $row[1],
		    'VisitorName' => $row[2],
		    'Persons' => $row[3],
		    //'Year' => $row[4],
		    //'Month' => $row[5],
		    //'Date' => $row[6],
		    //'Time' => $row[7],
		    'Date' => $md,
                    'Time' => $time
                );
            }
        }
    }

    // jsonとして出力
    if($today != null) {
        print_r('{    "today_reservation":');
        print_r(json_encode($today, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        print_r('}'); 
    }
    
    echo "<br />";
    echo "<br />";

    if($reservation != null) {
        print_r('{    "1week_reservation":');
        print_r(json_encode($reservation, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        print_r('}');
    }
?>
