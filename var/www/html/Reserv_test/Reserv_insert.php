<!--新規追加した予約情報の同期-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");
    
    // 追加した予約者名を取得
    $name = null;
    if(isset($_POST["name"])){
        $name = $_POST["name"];
        // var_dump($name);
    }

    // 追加した人数を取得
    $num = null;
    if(isset($_POST["num"])){
        $num = $_POST["num"];
        // echo $num;
    }

    // 追加した予約日を取得
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

    // 追加した予約時間を取得
    $time = null;
    if(isset($_POST["time"])){
        $time = $_POST["time"];
        $time = str_replace(":","",$time);
        //var_dump($time);
    }

    // DBに予約情報を挿入    
   $sql = "INSERT into reservation (StoreID,VisitorName,Reservation,Year,Month,Date,Time) 
		VALUES(".$_SESSION['my_id'].",'".$name."',
			".$num.",".$year.",".$mon.",".$day.",".$time.")";
    $res = $db->query($sql);
   
    print('"'.$name.'"を新規追加しました！');
?>

<p><a href="./Reserv.php">back</a></p>
