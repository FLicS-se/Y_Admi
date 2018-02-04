<!--編集した予約情報の同期-->

<?php
    // StoreIDとReservIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");
    
    // 編集した予約者名を取得
    $name = null;
    if(isset($_POST["name"])){
        $name = $_POST["name"];
        //var_dump($name);
    }

    // 編集した人数を取得
    $num = null;
    if(isset($_POST["num"])){
        $num = $_POST["num"];
        //echo $num;
    }

    // 編集した予約日を取得
    $date = null;
    $year = null;
    $mon = null;
    $day = null;
    if(isset($_POST["date"])){
        // 区切り文字("/")で文字列を分解、配列に格納
        $date = explode("/",$_POST["date"]);
        //echo '<p>',$date[0],'</p>';

        // 年の取得、"20"を除く
        $year = substr($date[0], -2);
        //echo '<p>',$year,'</p>';

        // 月の取得
        $mon = $date[1];
        //echo '<p>',$mon],'</p>';

        // 日の取得
        $day = $date[2];
        //echo '<p>',$day,'</p>';
    }

    // 編集した予約時間を取得
    $time = null;
    if(isset($_POST["time"])){
        $time = $_POST["time"];
        $time = str_replace(":","",$time);
        //var_dump($time);
    }


    // 予約情報の更新
    $sql = "UPDATE reservation SET VisitorName = '".$name."',
		            Reservation ='".$num."',
                            Year = '".$year."',
                            Month = '".$mon."',
                            Date = '".$day."',
                            Time = '".$time."'
		WHERE StoreID =".$_SESSION['my_id']." AND ReservationID = ".$_SESSION['reservID'];

    $res = $db->query($sql);
       
    print('予約情報の編集が完了しました！');
?>

<p><a href="./Reserv.php">back</a></p>
