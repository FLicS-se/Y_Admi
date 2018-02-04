<!-- 料理編集画面-->
<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");

    // 選択された料理名の取得、クエリ
    $name = null;
    if(isset($_POST["cuisine"])){
        foreach($_POST['cuisine'] as $name) {
            $sql = "SELECT * FROM cuisine 
			WHERE StoreID =".$_SESSION['my_id']." AND CuisineName = '".$name."'";
        }
    }else {
        // エラーを出力しないよう設定
        ini_set( 'display_errors', 0 );
        // ラジオボタンが1つも選択されていないとき
        print('料理が選択されていません。戻るボタンを押してください。');
        print '<p><a href="./Menu.php">back</a></p>';               
    }

    // クエリ実行
    $res = $db->query($sql);
    // 配列に格納
    $cuisine = $res->fetchArray();

    // 味情報の取得
    $sql = "SELECT * FROM cuisinedata
                WHERE StoreID =".$_SESSION['my_id']." AND CuisineID =".$cuisine[0];
    $res = $db->query($sql);
    $taste = $res->fetchArray();

    // cuisineIDの送信
    $_SESSION['cuisineID'] = $cuisine[0];

    //var_dump($row[]);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ふらっとやまだ: 料理情報編集</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="MenuEdit.css"/>
</head>

<body>
<!-- script -->
<script>
    function submitChk() {
        var flag = confirm("本当に実行しますか?");
        return flag;
    }
</script>

    <div id="site-box">
    <center>

    <div id="title">
    <h1> 料理情報編集 </h1>
    </div>
    
    <div id="description">
    <?php print('現在、' .$name. 'を編集しています。<br />'); ?>
    </div>

    <!--編集したデータをPOSTで送信-->
    <div id="menu">
    <form action="./Cuisine_update.php" method="post" enctype="multipart/form-data" onsubmit="return submitChk()" >
        <dl>
        
        <!--料理名の編集-->
        <div id="sake_name">
        <dt>お品書き名</dt>
        <dd><input id="name_text" name="cuisine" type="text" value="<?php echo $cuisine[2];?>" placeholder="" size="50" maxlength="32" /></dd>
        </div>

        <!--値段の編集-->
        <div id="price">
        <dt>値段</dt>
        <dd><input id="price_text" name="price" type="number" min="0" value="<?php echo $cuisine[4];?>" placeholder="" size="10" maxlength="10" /></dd>
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
        <dt>辛味</dt>
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
        <select id = "tasty" name="tasty" >
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

        <div id="image_cuisine_edit">
        <dt>料理の写真</dt>
        <div id="photo">
        <!--現在の画像を表示(キャッシュを防ぐため,末尾にタイムスタンプ)-->
        <img src = "<?php echo "../../image/cuisine"
                .$_SESSION['my_id']."-".$cuisine[0].".png?".date("YmdHis"); ?>">
        <dd>
        <input id="img" name="img" type="file" size="50" />
        </dd>
        </div>

        </div>

        <!--同期ボタン-->
        <div id="update_cuisine_edit">
        <input id="update_button" type="submit" value="同期" >
        </div>
    </form>

    <!--削除ボタン-->
    <div id="delete_cuisine_edit">
    <form action="./Cuisine_delete.php" method="post" onsubmit="return submitChk()" >
        <input id="delete_button" type="submit" value="削除" >
    </form>
    </div>    

    <!--戻るボタン-->
    <div id="back_cuisine_edit">
    <form action="./Menu.php" method="post" onsubmit="return submitChk()" >
        <input id="back_button" type="submit" value="戻る" >
    </form>
    </div>

    </center>
    </div>
</body>
</html>
