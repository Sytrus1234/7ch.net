<?php

declare(strict_types=1);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>登録中</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_POST['token']) || isset($_POST['token']) != isset($_SESSION['token'])) {
        die("不正なアクセスです");
    }

    $id = $_POST['id'];
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    // var_dump($_POST);

    try {
        // データベースに接続
        $pdo = new PDO('mysql:dbname=user;host=localhost', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        // echo "登録中です...";

        // 書き込み準備
        $sql = "INSERT INTO user_info(user_id, user_name, pass, mail, registration_date, update_date) VALUES (:id, :name, :pass, :mail, :now_time, :now_time)";

        // 書き込みの設定
        $time = date("Y-m-d");
        $stmt = $pdo->prepare($sql);
        $params = array(
            ':id' => $id,
            ':name' => $name,
            ':pass' => $pass,
            ':mail' => $mail,
            'now_time' => $time
        );

        // 書き込み
        try {
            $stmt->execute($params);

            header("Location: http://localhost/API/finish.php");
        } catch (PDOException $e) {
            echo "ID、もしくはメールアドレスが既に使用されています" . "\n";
            // echo "登録失敗". $e->getMessage(). "\n"; 
    ?>
            <a href="new_member.php">戻る</a>
        <?php
            exit;
        }
    } catch (PDOException $e) {
        echo "接続失敗" . $e->getMessage() . "\n"; ?>
        <a href="new_member.php">戻る</a>
    <?php
        exit;
    }

    ?>
</body>

</html>