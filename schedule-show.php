<?php

require_once 'sql-connect.php';
$pdo = get_pdo();

try {
    $query = "SELECT * FROM daytime;";
    $result = $pdo->query($query);
    
    print "日程ごとの参加可能人数";
    print "<table border=\"1\">\n";
    print "<tr><th></th><th>09時</th><th>10時</th><th>11時</th><th>12時</th><th>13時</th><th>14時</th><th>15時</th><th>16時</th><th>17時</th><th>18時</th><th>19時</th><th>20時</th><th>21時</th><th>22時</th><th>23時</th></tr>\n";
    
    $previous_day_of_week = ""; // 前の曜日を記録する変数
    
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $day_of_week = $row["day_of_week"];
        
        // 新しい曜日が始まった時に処理を実行
        if ($day_of_week != $previous_day_of_week) {
            // 曜日の開始
            print "<tr>"; // 行開始
            print "<td>{$day_of_week}</td>"; // 曜日の表示
            $previous_day_of_week = $day_of_week; //折り返し
        }

        print "<td>";
        print $row["count"];
        print "</td>";
    }
    print "</tr>\n"; 
    
    print "</table>\n";

    // 改行
    echo '<br>';
    print "参加可能人数が多い順";
    print "（誰も参加できない日程は非表示）";
    echo '<br>';
    
    // ORDER BY count DESCを追加して参加人数を多い順に
    $query = "SELECT * FROM daytime WHERE count > 0 ORDER BY count DESC;";

    print "<table border=\"1\">\n";
    print "<tr><th>曜日</th><th>開始〜終了時刻</th><th>参加可能人数</th><th>回答者</th></tr>\n";
    // forearchでクエリ結果を1行ずつ取り出し、$rowに格納している
    foreach ($pdo->query($query) as $row) {
        print "<tr>";
        print "<td>";
        print $row["day_of_week"];
        print "</td>";
        print "<td>";
        print $row["start_end"];
        print "</td>";
        print "<td>";
        print $row["count"];
        print "</td>";
        print "<td>";
        $query2 = "SELECT names FROM schedule
                JOIN participant on schedule.participant_id = participant.id
                WHERE daytime_id='$row[id]';";
        foreach ($pdo->query($query2) as $participant) {
            print $participant["names"];
            print "　";
        }
        print "</td>";
        print "</tr>\n";
    }
    print "</table>\n";
    print "※「曜日」〜「開始〜終了時間」をドラッグすると、そのまま結果をコピーできます";
} catch(PDOException $e) {
    // エラーメッセージを出力
    print $e->getMessage() . "<br />";
} finally {
    // データベースの接続解除
    $pdo = null;
}

echo '<br>';
echo '<br>';
require_once 'footer.php';
?>
