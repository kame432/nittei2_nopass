# 日程調整アプリ

## 制作経緯

日程調整で、一覧で直感的に参加人数や参加者を把握できるアプリが欲しいと思い、制作しました。
大学の「データベース入門」の授業で MySQL について学び、授業課題として提出したものを改良しました。

## ファイル説明

- ホーム画面

  - index.html
  - style.css

- sql 操作

  - ER.drawio...ER 図
  - sql-create-table.sql...テーブルの作成
  - sql-insert.sql...値の挿入
  - sql-connect-test.php...データベース接続確認
  - sql-connect.php...データベース接続

- 戻るボタン

  - footer.php

- 参加者情報登録フォーム

  - participant-add-form.html...「参加者情報登録フォーム」の画面
  - participant-add.php...参加者情報の送信
  - participant-show.php...参加者情報の閲覧

- 日程調整

  - schedule-add-form.php...「日程調整」の画面
  - schedule-push.php...日程調整
  - schedule-show.php...日程調整結果の閲覧

- 予定の訂正

  - delete.php...「予定の訂正」の画面
  - delete-time.php...特定の時間を削除
  - delete-schedule.php...日程調整結果を削除
  - delete-participant-schedule.php...日程調整結果＋参加者情報を削除
