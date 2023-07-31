<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Select Rental Shoes</title>
</head>
<body>

<br />
氏名を選択してください<br />
  <form action="schedule-push.php" method="post">
    <select name="participant_id">
<?php
require_once 'sql-connect.php';
$pdo = get_pdo();

try {
    # 順番に1行ずつ取り出す
    $query = "SELECT * FROM participant;";
    foreach ($pdo->query($query) as $row) {
        # "を文字列として入れたい場合は\"
        print "<option value=\"{$row["id"]}\">{$row["names"]}</option>\n";
    }
} catch(PDOException $e) {
    // エラーメッセージを出力
    print $e->getMessage() . "<br />";
} finally {
    // データベースの接続解除
    $pdo = null;
}
?>
    </select>
<br /><br />
<p>参加可能な日時を選択してください。<br />
※09時は09〜10時を表します。</p>
<?php
$pdo = get_pdo();

try {
    $query = "SELECT * FROM daytime;";
    $result = $pdo->query($query);
    
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
        print "<input type=\"checkbox\" name=\"selected_ids[]\" value=\"{$row["id"]}\">";
        print "</td>";
    }
    print "</tr>\n"; 
    
    print "</table>\n";
} catch(PDOException $e) {
    print $e->getMessage() . "<br />";
} finally {
    $pdo = null;
}
?>
    <p><input type="submit" name="submitBtn" value="　送信　"></p>
  </form>

<?php
require_once 'footer.php';
?>
</body>
</html>
