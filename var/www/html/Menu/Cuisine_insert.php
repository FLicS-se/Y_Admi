<!--新規追加した料理情報の同期-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");
    
    // 編集した料理名を取得
    $name = null;
    if(isset($_POST["cuisine"])){
        $name = $_POST["cuisine"];
        // var_dump($name);
    }

    // 編集した値段を取得
    $price = null;
    if(isset($_POST["price"])){
        $price = $_POST["price"];
        // echo $price;
    }
    
    // DBに料理情報を挿入
    $sql = "INSERT into cuisine (StoreID,CuisineName,Price) 
		VALUES(".$_SESSION['my_id'].",'".$name."',".$price.")";
    $res = $db->query($sql);

    // 料理IDの取得
    $sql = "SELECT * FROM cuisine
		 WHERE StoreID =".$_SESSION['my_id']." AND CuisineName = '".$name."'";
    $res = $db->query($sql);
    // 配列に格納
    $cuisine = $res->fetchArray();

    // DBに料理英語情報のレコードを作成
    $sql = "INSERT into cuisine_English(StoreID)
                VALUES(".$_SESSION['my_id'].")";
    $res = $db->query($sql);

    // DBに料理中国語情報のレコードを作成
    $sql = "INSERT into cuisine_Chinese(StoreID)
                VALUES(".$_SESSION['my_id'].")";
    $res = $db->query($sql);

    // ファイルパスの更新
    $path = "http://13.114.169.85/image/cuisine".$_SESSION['my_id']."-".$cuisine[0].".png";
    $sql = "UPDATE cuisine SET ImageName ='".$path."'
                 WHERE StoreID =".$_SESSION['my_id']." AND CuisineID = ".$cuisine[0];
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
    $sql = "INSERT into cuisinedata 
		VALUES(".$_SESSION['my_id'].",".$cuisine[0].",'
			".$sweet."',".$saltdry.",".$acidity.",".$bitter.",".$tasty.")";
    $res = $db->query($sql);

    // 画像をサーバに保存
    if (is_uploaded_file($_FILES['img']['tmp_name'])) {
        $filePath = '/var/www/html/image/cuisine'.$_SESSION['my_id'].'-'.$_SESSION['cuisineID'].'.png';
        move_uploaded_file($_FILES['img']['tmp_name'],$filePath);
    }
    print('"'.$name.'"を新規追加しました！');
?>

<p><a href="./Menu.php">back</a></p>
