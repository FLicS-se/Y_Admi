<!-- 料理新規追加画面-->

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ふらっとやまだ: 料理情報新規追加</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="MenuEdit.css"/>
</head>

<body>
    <div id="site-box_add">
    <center>

    <div id="title">
    <h1> 料理情報新規追加</h1>
    </div>
    
    <div id="description">
    <?php print('新規追加したい料理情報を入力してください。<br />'); ?>
    </div>

    <!--追加したデータをPOSTで送信-->
    <div id="menu">
    <form action="./Cuisine_insert.php" method="post" enctype="multipart/form-data">
        <dl>
        
        <!--料理名の追加-->
        <div id="sake_name">
        <dt>お品書き名</dt>
        <dd><input id="name_text" name="cuisine" type="text" value="" size="50" maxlength="32" /></dd>
        </div>

        <!--値段の追加-->
        <div id="price">
        <dt>値段</dt>
        <dd><input id="price_text" name="price" type="number" min="0" value="" size="10" maxlength="10" /></dd>
        </div>

        <!--味情報の追加-->
        <div id="taste">
        <div id="sweet1">
        <dt>甘味</dt>
        <select id = "sweet" name="sweet" >
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
        <?php
            $pref = array('1','2','3','4','5','6','7','8','9');
            foreach($pref as $pref) {
               print('<option value="' . $pref . '">' . $pref . '</option>');
            }
        ?>
        </select>
        </div>

        </div>        

        <div id="image_cuisine">
        <dt>料理の写真</dt>
        <div id="photo">
        <input id="img" name="img" type="file" size="50" />
        </div>
        </div>

        <!--同期ボタン-->
        <div id="update_cuisine_add">
        <input id="update_button" type="submit" value="同期" >
        </div>
    </form>

    <!--戻るボタン-->
    <div id="back_cuisine_add">
    <form action="./Menu.php" method="post">
        <input id="back_button" type="submit" value="戻る" >
    </form>
    </div>

    </center>
    </div>
</body>
</html>
