<?php

require_once 'sql-connect.php';
$pdo = get_pdo();

try {
    $pdo->beginTransaction();

    $query = "UPDATE daytime SET daytime.count=0 WHERE daytime.count>0;";
    print "Query: {$query};<br />";
    $statement = $pdo->query($query);
    $result = $statement->fetch();

    $query = "DELETE FROM schedule;";
    print "Query: {$query}<br />";
    $pdo->query($query);

    $query = "DELETE FROM participant;";
    print "Query: {$query}<br />";
    $pdo->query($query);

    echo '<br>';
    print "上記の操作が正常に終了しました。";
    echo '<br>';

    # ここまでの処理が問題がなければコミットする（実際にDBに書き込む）
    $pdo->commit();
} catch(PDOException $e) {
    # ここまでで何か失敗した場合はロールバックする（変更をDBに書き込まずに破棄する）
    $pdo->rollBack();
    // エラーメッセージを出力
    print $e->getMessage() . "<br />";
} finally {
    // データベースの接続解除
    $pdo = null;
}

echo '<br>';
require_once 'footer.php';
?>

