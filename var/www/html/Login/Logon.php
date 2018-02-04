<!--ログイン完了画面-->
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

<center>
...
<p>ようこそ!<?php echo $row[1]; ?>さん!!</p>
<p><a href="../Home/Home.html">ホーム画面へ</a></p>

<?php
print(date('ログイン時刻...   ' . 'G: i: s'));
?>

</center>
