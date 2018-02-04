<!--店舗情報編集画面 -->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");

    // クエリ
    $sql = 'SELECT * FROM store where StoreID ='.$_SESSION['my_id'];

    // クエリ実行
    $res = $db->query($sql);
    // 配列に格納
    $row = $res->fetchArray();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ふらっとやまだ: 店舗情報</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Info.css"/>
</head>

<body>
<script>
    function submitChk () {
        var flag = confirm("本当に実行しますか?");
        return flag;
    }
</script>

    <div id="site-box">
    <center>

    <div id="title">
    <h1>店舗情報</h1>
    <p>店舗情報の編集が行えます。編集後は、同期ボタンを押してください。</p>
    </div>

    <div id="info">
    <form action="Info_update.php" method="post" enctype="multipart/form-data" onsubmit="return submitChk()" >
        <dl>
        
        <!--店舗名の編集-->
        <div id="tenpo">
        <dt>店舗名</dt>
        <dd><input id="name" name="tenpo" type="text" value="<?php echo $row[1];?>" size="50" maxlength="32" /></dd>
        <p>
        </div>
        
        <!--電話番号の編集-->
        <div id="phone">
        <dt> 電話番号 (ハイフン(-)無しで入力）</dt>
        <dd><input id="num" name="phone" type="tel" value="<?php echo $row[5];?>" size="10" maxlength="11" /></dd>
        <p>
        </div>
        
        <!--住所の編集-->
        <div id="adress">
        <dt>住所</dt>
        <dd><input id="adre" name="adre" type="text" value="<?php echo $row[4];?>" size="10" maxlength="50" /></dd>
        <p>
        </div>

        <!--紹介文の編集-->
        <dt>概要</dt>
        <dd>
        <textarea id="about" name="about" cols="50" rows="10"><?php echo $row[3];?></textarea>
        </dd>
        </dl>
        </div>

        <div id="image">
        <dt>店舗写真</dt>
        <!--現在の画像を表示(キャッシュを防ぐため,末尾にタイムスタンプ)-->
        <img src = "<?php echo "../../image/store"
                .$_SESSION['my_id'].".png?".date("YmdHis"); ?>">
        <dd>
        <input id="img" name="img" type="file" size="50" />
        </dd>
        </div>

        <!--同期ボタン-->
        <div id="update">
        <input id="update_button" type="submit" value="同期" >
        </div>
    </form>

    <!--戻るボタン-->
    <div id="back">
    <form action="Info_unjump.php" method="post" onsubmit="return submitChk()" >
        <input id="back_button" type="submit" value="戻る" >
    </form>
    </div>

    </center>

    </div>
</body>
</html>
