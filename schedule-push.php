<?php

require_once 'sql-connect.php';
$pdo = get_pdo();

// POSTされた値をそれぞれ変数名として受け取る
$participant_id = $_POST["participant_id"];
// 日程idを取得
$selected_ids = $_POST["selected_ids"];

try {
    $pdo->beginTransaction();
    
    // 値を更新。チェックボックス全て
    foreach($selected_ids as $selected_id){
        // UPDATE
        $query = "UPDATE daytime SET count=count+1 WHERE id='{$selected_id}'";
        print "Query: {$query};<br />";
        $statement = $pdo->query($query);
        # クエリ結果からIDを取り出す
        $result = $statement->fetch();

        $query = "INSERT INTO schedule (participant_id, daytime_id)  VALUES ('{$participant_id}', '{$selected_id}')";
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


