<!--予約情報新規追加画面-->

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ふらっとやまだ: 予約者追加</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Reserv_add.css"/>
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

    <div id="site-box">
    <center>

    <div id="title">
    <h1>予約者情報新規追加</h1>
    </div>
    </center>

    <div id="reserv">
    <form action="./Reserv_insert.php" method="post">
        <center>
        <dl>

        <!--予約者名の入力-->
        <div id="name">
        <dt>名前</dt>
        <dd>
        <input class="input" type="text" name="name" size="15" maxlength="10" value="" />
        </dd>
        </div>

        <!--人数の入力-->
        <div id="num">
        <dt>人数</dt>
        <dd>
        <input id="input_num" type="number" min="0" name="num" size="10" maxlength="10" value="" />
        </dd>
        
        </div>

        <!--予約日の入力-->
 　　　 <div id="date">
        <dt>予約日</dt>
        <dd><input id="input_date" type=text id="input_date" name="date" value="年/月/日"></dd>
        </div>

        <!--予約時間の入力-->
        <div id="time">
        <dt>時間</dt>
        <dt>(例：18:00 ⇒1800と入力)</dt>
        <input id="input_time"type="time" name="time" size="10" maxlength="10" value="" />
        </dd>
        </dl>
        </div>
        </center>

        </dl>
        </div>

       <!--追加ボタン-->
       <div id="submit">
       <input id="submit_button" type="submit" value="追加">
       </div>
    </form>

    <!--戻るボタン-->
    <form action="Reserv.php" method="post">
        <div id="back">
        <input id="back_button" type="submit" value="戻る">
        </div>
    </form>

    </div>
</body>
</html>
