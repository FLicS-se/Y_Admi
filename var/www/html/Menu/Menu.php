<!--お品書き一覧表示画面-->

<?php
    // StoreIDの取得
    session_start();
    
    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");

    // 酒一覧の取得
    $sql = 'SELECT * FROM sake where StoreID ='.$_SESSION['my_id'];
    $sakeRes = $db->query($sql);
	
    // 料理一覧の取得
    $sql = 'SELECT * FROM cuisine where StoreID ='.$_SESSION['my_id'];
    $cuiRes = $db->query($sql);	
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ふらっとやまだ: お品書き一覧</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Menu.css"/>
</head>

<body>
    <div id="site-box">
    <center>

    <div id="title">
    <h1> お品書き一覧 </h1>
    </div>

    <div id="description">
    <p>編集したいお品書きにチェックボックスを入れ、編集ボタンを押してください。</p>
    </div>		
    </center>

    <!-- お酒一覧の表示 -->
    <div id="sake">
    <dt>お酒一覧</dt>
    <form method="post" action="Sake_edit.php">
        <div class="menu">	
        <ul>
        <?php while($sakeList = $sakeRes->fetchArray()) : ?>
            <label>
            <li>
            <input type="radio" name="sake[]"value="<?php echo $sakeList[2]; ?>">
            <?php echo $sakeList[2]; ?>
            </li>
            </label>	
        <?php endwhile; ?>
        </ul>
        </div>
        <!-- 酒メニュー編集ボタン -->
        <div class="edit">
        <input class="edit_button" type="submit" value="編集" />
        </div>
    </form>

        <!--酒メニュー新規追加ボタン-->
        <form action="Sake_add.php" method="post">
            <div class="add">
            <input class="add_button" type="submit" value="追加">
            </div>
        </form>
    </div>

    <!-- 料理一覧の表示 --> 
    <div id="cuisine">
    <dt>料理一覧</dt>
    <form method="post" action="Cuisine_edit.php">
        <div class="menu">
        <ul>
        <?php while($cuiList = $cuiRes->fetchArray()) : ?>
        <label>
        <li>
        <input type="radio" name="cuisine[]"value="<?php echo $cuiList[2]; ?>">
        <?php echo $cuiList[2]; ?>
        </li>
        </label>
        <?php endwhile; ?>
        </ul>
        </div>       

        <!--料理メニュー編集ボタン --> 
        <div class="edit">
        <input class="edit_button" type="submit" value="編集" />
        </div>
    </form>

    <!--料理メニュー新規追加ボタン-->
    <form action="Cuisine_add.php" method="post">
        <div class="add">
        <input class="add_button" type="submit" value="追加">
        </div>
    </form>
    </div>

    <!-- 戻るボタン -->
    <form action="Menu_unjump.php" method="post">
        <div id="back">
	<input id="back_button" type="submit" value="戻る">
	</div>
    </form>

    </div>
</body>
</html>
