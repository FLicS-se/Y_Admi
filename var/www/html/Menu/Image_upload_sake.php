<?php
session_start();
$file = $_FILES['img'];

//print('ファイル名(name): ' . $file['name'] . '<br />');
//print('ファイルタイプ(type): ' . $file['type'] . '<br />');
//print('アップロードしたファイル(tmp_name): ' . $file['tmp_name'] . '<br />');
//print('エラー(error): ' . $file['error'] . '<br />');
//print('サイズ(size): ' . $file['size'] . '<br />');

$ext = substr($file['name'], -4);
if ($ext == '.jpg' || $ext == '.png') {
    // 本来なら、SakeIDを利用してパスを記入
    $filePath = '/var/www/html/image/sake'.$_SESSION['my_id'].'-'.$_SESSION['sakeID'].'.png';
    move_uploaded_file($file['tmp_name'], $filePath);
    if(file_exists($filePath)){
        $fp   = fopen($filePath,'rb');
        $size = filesize($filePath);
        $img  = fread($fp, $size);
        fclose($fp);
        //header('Content-Type: image/jpeg || image/png');
 	print('画像のアップロードが完了しました！');
        print '<p><a href="javascript:history.back()">back</a></p>';
    }
} else {
    print('拡張子が.jpgまたは.pngのいずれかのファイルをアップロードしてください');
}
?>
