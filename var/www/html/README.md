# 管理者端末

~~各画面をディレクトリで分けていますが、ブラウザで表示させるには全ファイルを同じディレクトリに配置してください。~~  
1/9 更新で直しました。

## 1/9 TUE 22:30 更新.

* 全ファイルを同一ディレクトリに配置する必要がなくなりました。
* 各画面への遷移が一応できるようになりました。
* 英語だったものを日本語に書きなおしました。（UTF-8）
* ファイル名の頭文字を大文字にしました。（GitHubで適応されているかわかりません。）

データベースとの接続、~~スタイルシート~~は考慮していません。  

## 1/13 Sat 17:30 更新.

* 一部HTMLにスタイルシートを適用。
* 各画面調節（位置変更、ボタンサイズ変更）
* 店舗情報編集画面に画像アップロードボタンを追加しました。  
ただし、画像情報は表示できても、画像がうまく表示できていません。
* 日付、時刻をホーム画面に追加（JavaScript使用）

予約者はまだ一覧表示できていないため、仮で作成するつもりです。

## 1/14 Sun 15:15 更新.

* スタイルシート変更
* 一部英語だったものを日本語化
* 予約者一覧をチェックボックス形式で仮表示
* お品書き編集画面にドロップダウン形式で味情報を追加
* 店舗情報画面で必要項目の追加

### 18:00 追加更新.

* お品書き編集画面にスタイルシート適用
* FLicSアイコン追加

### 23:00 追加更新.

* スタイルシート変更
* SQLite3への接続成功（ねこのローカルサーバ）

今後はデータベースも含めた設計を行っていきます。