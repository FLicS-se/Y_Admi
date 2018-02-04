<!-- お酒編集画面-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");

    // 選択された酒名の取得、クエリ
    $name = null;
    if(isset($_POST["sake"])){
        foreach($_POST['sake'] as $name) {
            $sql = "SELECT * FROM sake 
			WHERE StoreID =".$_SESSION['my_id']." AND SakeName = '".$name."'";
        }
    }else {
        // エラーを出力しないよう設定
        ini_set( 'display_errors', 0 );
        // ラジオボタンが1つも選択されていないとき
        print('お酒が選択されていません。戻るボタンを押してください。');
        print '<p><a href="./Menu.php">back</a></p>';
    }

    // クエリ実行
    $res = $db->query($sql);
    // 配列に格納
    $sake = $res->fetchArray();

    // 味情報の取得
    $sql = "SELECT * FROM sakedata 
		WHERE StoreID =".$_SESSION['my_id']." AND SakeID =".$sake[0];
    $res = $db->query($sql);
    $taste = $res->fetchArray();

    // SakeIDの送信
    $_SESSION['sakeID'] = $sake[0];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ふらっとやまだ: お酒情報編集</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="MenuEdit.css"/>
</head>

<body>
<!-- script -->
<script>
    function submitChk() {
        var flag = confirm("本当に実行しますか?");
        // flag true -> sent, false -> not sent
        return flag;
    }
</script>

    <div id="site-box">
    <center>

    <div id="title">
    <h1> お酒情報編集 </h1>
    </div>
    
    <div id="description">
    <?php print('現在、' .$name. 'を編集しています。<br />'); ?>
    </div>

    <!--編集したデータをPOSTで送信-->
    <div id="menu">
    <form action="./Sake_update.php" method="post" enctype="multipart/form-data" onsubmit="return submitChk()" >
        <dl>
        
        <!--酒名の編集-->
        <div id="sake_name">
        <dt>お品書き名</dt>
        <dd><input id="name_text" name="sake" type="text" value="<?php echo $sake[2];?>" size="50" maxlength="32" /></dd>
        </div>

        <!--値段の編集-->
        <div id="price">
        <dt>値段</dt>
        <dd><input id="price_text" name="price" type="number" min="0" value="<?php echo $sake[4];?>" size="10" maxlength="10" /></dd>
        </div>

        <!--味情報の編集-->
        <div id="taste">
        <div id="sweet1">
        <dt>甘味</dt>
        <select id = "sweet" name="sweet" >
        <option selected="selected"><?php echo $taste[2]; ?></option>
        <?php
            $pref = array('1','2','3','4','5','6','7','8','9');
            foreach($pref as $pref) {
               print('<option value="' . $pref . '">' . $pref . '</option>');
            }
        ?>
        </select>
        </div>
 
        <div id="saltdry1">
        <dt>塩味</dt>
        <select id = "saltdry" name="saltdry" >
        <option selected="selected"><?php echo $taste[3]; ?></option>
        <?php
            $pref = array('1','2','3','4','5','6','7','8','9');
            foreach($pref as $pref) {
               print('<option value="' . $pref . '">' . $pref . '</option>');
            }
        ?>
        </select>
        </div>

        <div id="acidity1">
        <dt>酸味</dt>
        <select id = "acidity" name="acidity" >
        <option selected="selected"><?php echo $taste[4]; ?></option>
        <?php
            $pref = array('1','2','3','4','5','6','7','8','9');
            foreach($pref as $pref) {
               print('<option value="' . $pref . '">' . $pref . '</option>');
            }
        ?>
        </select>
        </div>

        <div id="bitter1">
        <dt>苦味</dt>
        <select id = "bitter" name="bitter" >
        <option selected="selected"><?php echo $taste[5]; ?></option>
        <?php
            $pref = array('1','2','3','4','5','6','7','8','9');
            foreach($pref as $pref) {
               print('<option value="' . $pref . '">' . $pref . '</option>');
            }
        ?>
        </select>
        </div>

        <div id="tasty1">
        <dt>旨味</dt>
        <select class="taste_cmb" id = "tasty" name="tasty" >
        <option selected="selected"><?php echo $taste[6]; ?></option>
        <?php
            $pref = array('1','2','3','4','5','6','7','8','9');
            foreach($pref as $pref) {
               print('<option value="' . $pref . '">' . $pref . '</option>');
            }
        ?>
        </select>
        </div>
        </div>

        <!--紹介文の編集-->
        <div id="about">
        <dt>概要</dt>
        <dd>
        <textarea id="about_text" name="about" cols="50" rows="10"><?php echo $sake[5];?></textarea>
        </dd>
        </div>

        <div id="image">
        <dt>お酒の写真</dt>
        <!--現在の画像を表示(キャッシュを防ぐため,末尾にタイムスタンプ)-->
        <div id="photo">
        <img src = "<?php echo "../../image/sake"
		.$_SESSION['my_id']."-".$sake[0].".png?".date("YmdHis"); ?>">
        <dd>
        <input id="img" name="img" type="file" size="50" />
        </dd>
        </div>
        </div>

        <!--同期ボタン-->
        <div id="update">
        <input id="update_button" type="submit" value="同期" >
        </div>

    </form>
    </div>
 
    <!--削除ボタン-->
    <div id="delete">
    <form action="./Sake_delete.php" method="post" onsubmit="return submitChk()" >
        <input id="delete_button" type="submit" value="削除" >
    </form>
    </div>    

    <!--戻るボタン-->
    <div id="back">
    <form action="./Menu.php" method="post" onsubmit="return submitChk ()" >
        <input id="back_button" type="submit" value="戻る" >
    </form>
    </div>

    </center>
    </div>
</body>
</html>
