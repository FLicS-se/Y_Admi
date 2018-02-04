<!--編集した料理情報の同期-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");
    
    // 編集した料理名を取得
    $name = null;
    if(isset($_POST["cuisine"])){
        $name = $_POST["cuisine"];
        //var_dump($name);
    }

    // 編集した値段を取得
    $price = null;
    if(isset($_POST["price"])){
        $price = $_POST["price"];
        //echo $price;
    }
    
    // CuisineIDの取得 
    $cuisineID = $_SESSION['cuisineID'];
    //var_dump($cuisineID);

    // 料理DBの更新
    $sql = "UPDATE cuisine SET CuisineName = '".$name."',
                            Price = '".$price."'
		WHERE StoreID =".$_SESSION['my_id']." AND CuisineID = ".$cuisineID;
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

    // 料理味情報DBの更新
    $sql = "UPDATE cuisinedata SET Sweetness =".$sweet.",
                               SaltDry = ".$saltdry.",
                               Acidily = ".$acidity.",
                               Bitterness = ".$bitter.",
                               Taste = ".$tasty."
                WHERE StoreID =".$_SESSION['my_id']." AND CuisineID = ".$cuisineID;
    $res = $db->query($sql);

    // 画像をサーバに保存
    if (is_uploaded_file($_FILES['img']['tmp_name'])) {
        $filePath = '/var/www/html/image/cuisine'.$_SESSION['my_id'].'-'.$_SESSION['cuisineID'].'.png';
        move_uploaded_file($_FILES['img']['tmp_name'], $filePath);
    }

    print('料理情報の編集が完了しました！');
?>

<p><a href="./Menu.php">back</a></p>
