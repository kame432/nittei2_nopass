<?php

require_once 'sql-connect.php';
$pdo = get_pdo();

try {
    $query = "SELECT * FROM daytime;";

    // forearchでクエリ結果を1行ずつ取り出し、$rowに格納している
    foreach ($pdo->query($query) as $row) {
        print $row["id"] . "\t";
        print $row["day_of_week"] . "\t";
        print $row["start_end"] . "\t";
        print $row["count"] . "<br />\n";
    }
} catch(PDOException $e) {
    // エラーメッセージを出力
    print $e->getMessage() . "<br />";
} finally {
    // データベースの接続解除
    $pdo = null;
}

require_once 'footer.php';
?>