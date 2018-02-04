<!--編集した店舗情報の同期-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続	
    $db = new SQLite3("/home/ubuntu/db/yamada.db");

    // 編集した店舗名を取得
    $name = null;
    if(isset($_POST["tenpo"])){
        $name = $_POST["tenpo"];
        //var_dump($name);
    }

    // 編集した電話番号を取得
    if(isset($_POST["phone"])){
        $phone = $_POST["phone"];
        //echo $phone;
    }

    // 編集した住所を取得
    if(isset($_POST["adre"])){
        $adre = $_POST["adre"];
        //echo $adre;
    }

    // 編集した紹介文を取得
    if(isset($_POST["about"])){
        $about = $_POST["about"];
        //echo $about;
    }	

    // DBの更新
    $sql = "UPDATE store SET StoreName = '".$name."',
                             PhoneNumber = '".$phone."',
                             Address = '".$adre."',
                             Introduction = '".$about."' 
		WHERE StoreID =".$_SESSION['my_id'];
    $res = $db->query($sql);

    // 画像をサーバに保存
    if (is_uploaded_file($_FILES['img']['tmp_name'])) {
        $filePath = '/var/www/html/image/store'.$_SESSION['my_id'].'.png';
        move_uploaded_file($_FILES['img']['tmp_name'], $filePath);
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>

<?php
print('店舗情報の編集が完了しました！');
?>

<p><a href="./Info_edit.php">back</a></p>

</html>
