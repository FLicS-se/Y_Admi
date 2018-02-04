<!--新規追加したお酒情報の同期-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");
    
    // 編集した酒名を取得
    $name = null;
    if(isset($_POST["sake"])){
        $name = $_POST["sake"];
        // var_dump($name);
    }

    // 編集した紹介文を取得
    $about = null;
    if(isset($_POST["about"])){
        $about = $_POST["about"];
        // echo $about;
    }

    // 編集した値段を取得
    $price = null;
    if(isset($_POST["price"])){
        $price = $_POST["price"];
        // echo $price;
    }
    
    // DBに酒情報を挿入    
    $sql = "INSERT into sake (StoreID,SakeName,Price,Introduction) 
		VALUES(".$_SESSION['my_id'].",'".$name."',".$price.",'".$about."')";
    $res = $db->query($sql);

    // 酒IDの取得
    $sql = "SELECT * FROM sake
                 WHERE StoreID =".$_SESSION['my_id']." AND SakeName = '".$name."'";
    $res = $db->query($sql);
    // 配列に格納
    $sake = $res->fetchArray();

    // DBに酒英語情報のレコードを作成
    $sql = "INSERT into sake_English(StoreID)
		VALUES(".$_SESSION['my_id'].")";
    $res = $db->query($sql);

    // DBに酒中国語情報のレコードを作成
    $sql = "INSERT into sake_Chinese(StoreID)
                VALUES(".$_SESSION['my_id'].")";
    $res = $db->query($sql);

    // ファイルパスの更新
    $path = "http://13.114.169.85/image/sake".$_SESSION['my_id']."-".$sake[0].".png";
    $sql = "UPDATE sake SET ImageName ='".$path."'
		 WHERE StoreID =".$_SESSION['my_id']." AND SakeID = ".$sake[0];
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

    // DBに味情報を挿入
    $sql = "INSERT into sakedata
                VALUES(".$_SESSION['my_id'].",".$sake[0].",'
                        ".$sweet."',".$saltdry.",".$acidity.",".$bitter.",".$tasty.")";
    $res = $db->query($sql);

    // 画像をサーバに保存
    if (is_uploaded_file($_FILES['img']['tmp_name'])) {
        $filePath = '/var/www/html/image/sake'.$_SESSION['my_id'].'-'.$_SESSION['sakeID'].'.png';
        move_uploaded_file($_FILES['img']['tmp_name'],$filePath);
    }

    print('"'.$name.'"を新規追加しました！');
?>

<p><a href="./Menu.php">back</a></p>
