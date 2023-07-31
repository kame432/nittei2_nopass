<?php

require_once 'sql-connect.php';
$pdo = get_pdo();

$names = $_POST["names"];
$affiliation = $_POST["affiliation"];
$school_year = $_POST["school_year"];

$query = "INSERT INTO participant (names, affiliation, school_year)
            VALUES ('{$names}', '{$affiliation}', '{$school_year}');"; 
print "Query: {$query}<br />";

try {
    $statement = $pdo->prepare($query);
    $flag = $statement->execute();
    if ($flag){
        echo '<br>';
        print "上記の操作が正常に終了しました。<br />";
    }else{
        print "Failed<br />";
    }
} catch(PDOException $e) {
    // エラーメッセージを出力
    print $e->getMessage() . "<br />";
} finally {
    // データベースの接続解除
    $pdo = null;
}

echo '<br>';
require_once 'footer.php';
?>

