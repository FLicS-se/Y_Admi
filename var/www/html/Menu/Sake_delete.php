<!--お酒情報の削除-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");
    
    // 酒IDの取得
    $sakeID = $_SESSION['sakeID'];
    //var_dump($sakeID);

    // DBから酒情報を削除
    $sql = "DELETE FROM sake WHERE SakeID = ".$sakeID;
    $res = $db->query($sql);

    $sql = "VACUUM";
    $res = $db->query($sql);

    // DBから味情報を削除
    $sql = "DELETE FROM sakedata WHERE SakeID = ".$sakeID;
    $res = $db->query($sql);

    $sql = "VACUUM";
    $res = $db->query($sql);

    // DBから英語の酒情報を削除
    $sql = "DELETE FROM sake_English WHERE SakeID = ".$sakeID;
    $res = $db->query($sql);

    $sql = "VACUUM";
    $res = $db->query($sql);

    // DBから中国語の酒情報を削除
    $sql = "DELETE FROM sake_Chinese WHERE SakeID = ".$sakeID;
    $res = $db->query($sql);

    $sql = "VACUUM";
    $res = $db->query($sql);



    // サーバから画像ファイルを削除
    $filePath = '/var/www/html/image/sake'.$_SESSION['my_id'].'-'.$_SESSION['sakeID'].'.png';
    unlink($filePath);

    print('削除しました！');
?>

<p><a href="./Menu.php">back</a></p>
