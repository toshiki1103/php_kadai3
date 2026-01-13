<?php

include('funcs.php');
$pdo = db_conn();

// 1. POSTデータを取得
$record_date = $_POST["record_date"];
$count = $_POST["count"];

// 2. 動画ファイルを uploads フォルダに保存
$video_file = $_FILES["video"]["name"];
$tmp_file = $_FILES["video"]["tmp_name"];

// ファイルをアップロード
move_uploaded_file($tmp_file, "uploads/" . $video_file);

// 3. PDOを使用してプリペアドステートメントでデータベースに挿入
try {
    $sql = "INSERT INTO lifting_records (record_date, count, video_filename) 
            VALUES (:date, :count, :filename)";
    $stmt = $pdo->prepare($sql);
    
    // bindValue()を使ってパラメータをバインド
    $stmt->bindValue(':date', $record_date, PDO::PARAM_STR);
    $stmt->bindValue(':count', $count, PDO::PARAM_INT);
    $stmt->bindValue(':filename', $video_file, PDO::PARAM_STR);
    
    // SQL実行
    $stmt->execute();
    
    // 表示ページにリダイレクト
    redirect("display2.php");
} catch (PDOException $e) {
    sql_error($stmt);
}

?>
