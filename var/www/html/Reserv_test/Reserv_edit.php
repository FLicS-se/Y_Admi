<!-- 予約編集画面-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");
      
    // 予約情報の取得
    $sql = "SELECT * FROM reservation 
		WHERE StoreID =".$_SESSION['my_id']." AND reservationID =".$_POST['reservID'];
    $res = $db->query($sql);
    $reserv = $res->fetchArray();

    if($reserv[5] <= 9){
        $reserv[5] = "0".$reserv[5];
    } 
    if($reserv[6] <= 9){
        $reserv[6] = "0".$reserv[6];
    }
    $_SESSION['reservID'] = $_POST['reservID'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ふらっとやまだ: 予約情報編集</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Reserv_edit.css"/>
</head>

<body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
    <link type="text/css" rel="stylesheet"  href="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.min.css" />

    <script>
    $(function() {
        $('#input_date').datepicker();
    });
    </script>

    <script>
        function submitChk () {
            var flag = confirm("本当に実行しますか?");
            return flag;
        }
    </script>

    <div id="site-box">
    <center>

    <div id="title">
    <h1> 予約情報編集 </h1>
    </div>
    
    <div id="description">
    <?php print('現在、' .$reserv[2]. 'を編集しています。<br />'); ?>
    </div>
    </center>

    <!--編集したデータをPOSTで送信-->
    <div id="reserv">
    <form action="./Reserv_update.php" method="post" onsubmit="return submitChk()" >
        <center>
        <dl>
        
        <!--予約者名の編集-->
        <div id="name">
        <dt>予約者名</dt>
        <dd><input class="input" name="name" type="text" value="<?php echo $reserv[2];?>" size="50" maxlength="32" /></dd>
        </div>

        <!--人数の編集-->
        <div id="num">
        <dt>人数</dt>
        <dd><input id="input_num" name="num" type="number" min="0" value="<?php echo $reserv[3];?>" size="10" maxlength="10" /></dd>
        </div>

        <!--予約日の編集-->
 　　　 <div id="date">
        <dt>予約日</dt>
        <dd><input id="input_date" type=text id="input_date" name="date" 
		value=<?php echo "20".$reserv[4]."/".$reserv[5]."/".$reserv[6].""; ?>></dd>
        </div>

        <!--予約時間の編集-->
 　　　 <div id="time">
        <dt>時間</dt>
        <dd><input id="input_time" name="time" type="time" value="<?php echo wordwrap($reserv[7],2,":",true) ?>" size="10" maxlength="10" /></dd>
        </div>

        </dl>
        </div>

        <!--同期ボタン-->
        <div id="update">
        <input id="update_button" type="submit" value="同期" >
        </div>
    </form>

    <!--戻るボタン-->
    <div id="back">
    <form action="./Reserv.php" method="post" onsubmit="return submitChk()" >
        <input id="back_button" type="submit" value="戻る" >
    </form>
    </div>

    </center>
    </div>
</body>
</html>
