<!-- お酒情報新規追加画面-->

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ふらっとやまだ: お酒情報新規追加</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="MenuEdit.css"/>
</head>

<body>
    <div id="site-box_add">
    <center>

    <div id="title">
    <h1> お酒情報新規追加</h1>
    </div>
    
    <div id="description">
    <?php print('新規追加したいお酒情報を入力してください。<br />'); ?>
    </div>

    <!--入力したデータをPOSTで送信-->
    <div id="menu">
    <form action="./Sake_insert.php" method="post" enctype="multipart/form-data">
        <dl>
        
        <!--酒名の入力-->
        <div id="sake_name">
        <dt>お品書き名</dt>
        <dd><input id="name_text" name="sake" type="text" value="" size="50" maxlength="32" /></dd>
        </div>

        <!--値段の入力-->
        <div id="price">
        <dt>値段</dt>
        <dd><input id="price_text" name="price" type="number" min="0" value="" size="10" maxlength="10" /></dd>
        </div>

        <!--味情報の入力-->
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

        <!--紹介文の入力-->
        <div id="about">
        <dt>概要</dt>
        <dd>
        <textarea id="about_text" name="about" cols="50" rows="10"></textarea>
        </dd>
        </div>

        </dl>
        </div>

        <div id="image_add">
        <dt>お酒の写真</dt>
        <div id="photo_add">
        <input id="img" name="img" type="file" size="50" />
        </div>
        </div>

        <!--同期ボタン-->
        <div id="update_add">
        <input id="update_button" type="submit" value="同期" >
        </div>
    </form>

    <!--戻るボタン-->
    <div id="back_add">
    <form action="./Menu.php" method="post">
        <input id="back_button" type="submit" value="戻る" >
    </form>
    </div>

    </center>
    </div>
</body>
</html>
