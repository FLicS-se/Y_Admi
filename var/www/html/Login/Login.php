<!--IDとパスワードの認証-->

<?php
    // StoreIDの取得
    session_start();

    // DBに接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");
    
    // クエリ
    $sql = 'SELECT * FROM login WHERE StoreID ='.$_POST['my_id'];
    
    // クエリ実行
    $res = $db->query($sql);

    // 正しく入力されていない場合、エラー画面を出力
    if(!$res){
        // error jump
        header('Location: ./Error.php');
        exit();
    }   

    // DBから取り出したデータを配列に格納
    $row = $res->fetchArray();

    // パスワードが一致した場合、Logon.phpへ遷移
    if($_POST['password'] == $row[1]) {
        $_SESSION['my_id'] = $_POST['my_id'];
        $_SESSION['password'] = $_SESSION['password'];
        header('Location: ./Logon.php');
    } else {
        // 一致しなかったらエラー画面を表示
        header('Location: ./Error.php');
    }
?>


