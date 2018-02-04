<!--料理情報の削除-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");
    
    // SakeIDの取得 
    //$sql = "SELECT SakeID FROM sake 
    //		WHERE StoreID =".$_SESSION['my_id']." AND SakeName = '".$name."'";

    $cuisineID = $_SESSION['cuisineID'];
    //var_dump($sakeID);

    // DBから料理情報を削除
    $sql = "DELETE FROM cuisine WHERE CuisineID = ".$cuisineID;
    $res = $db->query($sql);

    $sql = "VACUUM";
    $res = $db->query($sql);

    // DBから味情報を削除
    $sql = "DELETE FROM cuisinedata WHERE CuisineID = ".$cuisineID;
    $res = $db->query($sql);

    $sql = "VACUUM";
    $res = $db->query($sql);

    // DBから英語の料理情報を削除
    $sql = "DELETE FROM cuisine_English WHERE CuisineID = ".$cuisineID;
    $res = $db->query($sql);

    $sql = "VACUUM";
    $res = $db->query($sql);

    // DBから中国語の料理情報を削除
    $sql = "DELETE FROM cuisine_Chinese WHERE CuisineID = ".$cuisineID;
    $res = $db->query($sql);

    $sql = "VACUUM";
    $res = $db->query($sql);



    // サーバから画像ファイルを削除
    $filePath = '/var/www/html/image/cuisine'.$_SESSION['my_id'].'-'.$_SESSION['cuisineID'].'.png';
    unlink($filePath);

    print('削除しました！');
?>

<p><a href="./Menu.php">back</a></p>
