<?php

require_once 'sql-connect.php';
$pdo = get_pdo();

try {
    $query = "SELECT * FROM participant;";

    print "<table border=\"1\">\n";
    print "<tr><th>ID</th><th>名前</th><th>所属</th><th>学年</th></tr>\n";
    // forearchでクエリ結果を1行ずつ取り出し、$rowに格納している
    foreach ($pdo->query($query) as $row) {
        print "<tr>";
        print "<td>";
        print $row["id"];
        print "</td>";
        print "<td>";
        print $row["names"];
        print "</td>";
        print "<td>";
        print $row["affiliation"];
        print "</td>";
        print "<td>";
        print $row["school_year"];
        print "</td>";
        print "</tr>\n";
    }
    print "</table>\n";
} catch(PDOException $e) {
    // エラーメッセージを出力
    print $e->getMessage() . "<br />";
} finally {
    // データベースの接続解除
    $pdo = null;
}
  
require_once 'footer.php';
?>