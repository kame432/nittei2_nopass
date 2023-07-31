<?php

require_once 'sql-connect.php';
$pdo = get_pdo();

// 日程id全てを取得
$selected_ids = $_POST["selected_ids"];

try {
    $pdo->beginTransaction();
    
    // 値更新。チェックボックスで複数更新。
    foreach($selected_ids as $selected_id){
        // UPDATE
        $query = "UPDATE daytime JOIN schedule ON schedule.daytime_id = daytime.id SET daytime.count=daytime.count-1 WHERE schedule.id='{$selected_id}'";
        print "Query: {$query};<br />";
        $statement = $pdo->query($query);
        # クエリ結果からIDを取り出す
        $result = $statement->fetch();

        $query = "DELETE FROM schedule WHERE id = '{$selected_id}';";
            print "Query: {$query}<br />";
            $pdo->query($query);
    }
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

