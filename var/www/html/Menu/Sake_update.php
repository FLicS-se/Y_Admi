<!--編集したお酒情報の同期-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");
    
    // 編集した酒名を取得
    $name = null;
    if(isset($_POST["sake"])){
        $name = $_POST["sake"];
        //var_dump($name);
    }

    // 編集した紹介文を取得
    $about = null;
    if(isset($_POST["about"])){
        $about = $_POST["about"];
        //echo $about;
    }

    // 編集した値段を取得
    $price = null;
    if(isset($_POST["price"])){
        $price = $_POST["price"];
        //echo $price;
    }
    
    // SakeIDの取得 
    $sakeID = $_SESSION['sakeID'];
    //var_dump($sakeID);

    // 酒DBの更新
    $sql = "UPDATE sake SET SakeName = '".$name."',
		            Introduction ='".$about."',
                            Price = '".$price."'
		WHERE StoreID =".$_SESSION['my_id']." AND SakeID = ".$sakeID;
    $res = $db->query($sql);

    // 編集した味情報の取得
    $sweet = null;
    if(isset($_POST["sweet"])){
        $sweet = $_POST["sweet"];
        //echo $sweet;
    }

    $saltdry = null;
    if(isset($_POST["saltdry"])){
        $saltdry = $_POST["saltdry"];
        //echo $saltdry;
    }

    $acidity = null;
    if(isset($_POST["acidity"])){
        $acidity = $_POST["acidity"];
        //echo $acidity;
    }

    $bitter = null;
    if(isset($_POST["bitter"])){
        $bitter = $_POST["bitter"];
        //echo $bitter;
    }

    $tasty = null;
    if(isset($_POST["tasty"])){
        $tasty = $_POST["tasty"];
        //echo $tasty;
    }

    // 酒情報DBの更新
    $sql = "UPDATE sakedata SET Sweetness =".$sweet.",
                               SaltDry = ".$saltdry.",
                               Acidity = ".$acidity.",
                               Bitterness = ".$bitter.",
                               Taste = ".$tasty."
                WHERE StoreID =".$_SESSION['my_id']." AND SakeID = ".$sakeID;
    $res = $db->query($sql);

    // 画像をサーバに保存
    if (is_uploaded_file($_FILES['img']['tmp_name'])) {
        $filePath = '/var/www/html/image/sake'.$_SESSION['my_id'].'-'.$_SESSION['sakeID'].'.png';
        move_uploaded_file($_FILES['img']['tmp_name'], $filePath);
    }
       
    print('お酒情報の編集が完了しました！');
?>

<p><a href="./Menu.php">back</a></p>
