<!--予約情報の削除-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");
    
    // 予約IDの取得
    $reservID = $_POST['reservID'];
    //var_dump($reservID);

    // DBから予約情報を削除
    $sql = "DELETE FROM reservation WHERE ReservationID = ".$reservID;
    $res = $db->query($sql);

    $sql = "VACUUM";
    $res = $db->query($sql);

    print('削除しました！');
?>

<p><a href="./Reserv.php">back</a></p>
