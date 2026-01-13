<?php

// XSS対策：htmlspecialchars()関数の短縮版
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// DB接続：db_conn()
function db_conn() {
    $host = "mysql3112.db.sakura.ne.jp";
    $user = "limedingo815_kadai2";
    $password = "satoshi123-";
    $dbname = "limedingo815_kadai2";
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "接続エラー: " . $e->getMessage();
        exit;
    }
}

// SQLエラー処理：sql_error()
function sql_error($stmt) {
    $error = $stmt->errorInfo();
    exit('ErrorQuery: ' . $error[2]);
}

// リダイレクト：redirect()
function redirect($file_name) {
    header('Location: ' . $file_name);
    exit();
}

?>
