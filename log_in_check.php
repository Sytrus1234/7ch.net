<?php

declare(strict_types=1);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ログイン中</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_POST['token_login']) || isset($_POST['token_login']) != isset($_SESSION['token_login'])) {
        die("不正なアクセスです");
    }

    $id = $_POST['id'];
    $pass = $_POST['pass'];
    // var_dump($_POST);

    try {
        // データベースに接続
        $pdo = new PDO('mysql:dbname=user;host=localhost', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        // データベース参照
        $sql = "SELECT * FROM user_info WHERE user_id = ':id' AND pass =':pass'";
        $stmt =$pdo->prepare($sql);
        $params = array(
            ':id' => $id,
            ':pass' => $pass
        );

        // 検索
        try {
            $stmt ->execute($params);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($row);
        } catch (PDOException $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        if (!isset($row['user_id'])) {
            echo 'ユーザーID又はパスワードが間違っています';
            return false;
        }


    } catch (PDOException $e) {
        echo "接続失敗" . $e->getMessage() . "\n";?>
        <a href="log_in.php">戻る</a>
    <?php
        exit;
    }
    ?>
</body>