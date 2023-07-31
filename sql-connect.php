<?php

// データベースに接続（MySQLログイン時のユーザ名、パスワードは各自の環境に合わせて変更すること）
function get_pdo() {
  $username = ''; // ここに自分のmysql
  $password = ''; // 設定したパスワード

  return new PDO('mysql:charset=UTF8;dbname=nittei2;host=localhost', $username, $password);
}

?>