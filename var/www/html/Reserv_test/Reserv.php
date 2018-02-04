<?php
    // StoreIDの取得
    session_start();
   
    // DBの接続
    $db = new SQLite3("/home/ubuntu/db/yamada.db");

    // 予約一覧の取得
    $sql = 'SELECT * FROM reservation 
		WHERE StoreID ='.$_SESSION['my_id'].'
			ORDER BY Year asc, Month asc, Date asc, Time asc'; 
    $reservRes = $db->query($sql);	
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ふらっとやまだ: 予約者一覧</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Reserv.css"/>
</head>

<body>
<script>
    function submitChk () {
        var flag = confirm("本当に削除しますか?");
        return flag;
    } 
</script>
    <div id="site-box">
    <center>

    <div id="title">
    <h1>予約者一覧</h1>
    </div>

    <div id="info">
    <p>予約者の一覧です。</p>
    </div>

 </center> 

    <div id="reserv">
    <div id="member">
    <ul>
    <table border="1"><tbody>
        <tr align="left" >
            <th>予約日</th><th>時間</th><th>予約者</th><th>予約人数</th><th>更新</th>
        </tr>
	<?php while($row = $reservRes -> fetchArray()) : ?>
	    <?php
                // 年月日の調整
                $row[4] = '20'.$row[4];
                if($row[5] <= 9){
                    $row[5] = '0'.$row[5];
                }
                if($row[6] <= 9){
                    $row[6] = '0'.$row[6];
                }
                $date = date('Y年m月d日', strtotime($row[4].$row[5].$row[6]));
                    
                // 今日以降の予約のみ表示させる
                if(date('Y年m月d日', strtotime("-1 day")) < $date ){
                    $time = date('H:i', strtotime($row[7]));
                    $name = $row[2];
                    $num = $row[3];
                } else {
                    continue;   
                }
            ?>

            <!--予約情報の出力-->
            <tr align="left">
                <th><?php echo $date; ?></th>
                <th><?php echo $time; ?></th>
                <th><?php echo $name; ?></th>
                <th><?php echo $num; ?></th>
                <th>
                
                <!--編集ボタン-->
                <form action="./Reserv_edit.php" method="post">
                    <input type="hidden" name="reservID" value="<?php echo $row[1]; ?>">
                    <input type="submit" name="edit" value="編集">
                </form>
                
                <!--削除ボタン-->
                <form action="./Reserv_delete.php" method="post" onsubmit="return submitChk()" >
                    <input type="hidden" name="reservID" value="<?php echo $row[1]; ?>">
                    <input type="submit" name="delete" value="削除">
                </form>

                </th>
            </tr>
        <?php endwhile; ?>
    </tbody></table>
    </ul>
    </div>
    </div>

    <!--追加ボタン-->
    <form action="./Reserv_add.php" method="post">
        <div id="insert">
        <input id="insert_button" type="submit" value="追加">
        </div>
    </form>

    <!--戻るボタン-->
    <form action="./Reserv_unjump.php" method="post">
        <div id="back">
        <input id="back_button" type="submit" value="戻る">
        </div>
    </form>

    </div>
</body>
</html>

