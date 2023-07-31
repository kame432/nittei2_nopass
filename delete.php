<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Select Rental Shoes</title>
</head>
<body>

  <form action="delete-time.php" method="post">
参加不可に変更したい項目があれば、チェックを付けてください<br />
<?php
require_once 'sql-connect.php';
$pdo = get_pdo();

try {
    // 表示
    $query = "SELECT schedule.id, participant.names, daytime.day_of_week, daytime.start_end
                FROM schedule
                JOIN participant ON schedule.participant_id = participant.id
                JOIN daytime ON schedule.daytime_id = daytime.id;";

    print "<table border=\"1\">\n";
    print "<tr><th>氏名</th><th>曜日</th><th>開始〜終了時間</th><th>参加不可に変更</th></tr>\n";
    // forearchでクエリ結果を1行ずつ取り出し、$rowに格納している
    // radio→checkbox
    foreach ($pdo->query($query) as $row) {
        print "<tr>";
        print "<td>";
        print $row["names"];
        print "</td>";
        print "<td>";
        print $row["day_of_week"];
        print "</td>";
        print "<td>";
        print $row["start_end"];
        print "</td>";
        print "<td>";
        print "<input type=\"checkbox\" name=\"selected_ids[]\" value=\"{$row["id"]}\">";
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
?>
    <p><input type="submit" name="submitBtn" value="　送信　"></p>
  </form>

  <br>

  <p>全ての予定を削除したい場合は、以下のボタンを押してください</p>
  <form action="delete-schedule.php" method="post">
    <p><input type="submit" name="submitBtn" value="　日程調整結果をクリア　"></p>
  </form>
  <form action="delete-participant-schedule.php" method="post">
    <p><input type="submit" name="submitBtn" value="　日程調整結果結果＋参加者情報をクリア　"></p>
  </form>

  <br>
  <br>

<?php
require_once 'footer.php';
?>
</body>
</html>