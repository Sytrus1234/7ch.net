<?php
declare(strict_types=1);
session_start();
if (!isset($_POST['token']) || isset($_POST['token']) != isset($_SESSION['token'])) {
    die('不正なアクセスを検出しました');
}
var_dump($_POST);
// var_dump($_SESSION['token']);

$db['host'] = "localhost";
$db['user'] = "root";
$db['pass'] = "";
$db['dbname'] = "user";

// ログイン処理
// if (isset($_POST['login_method']))
if (isset($_POST['method']) == "login_method") {
    if (!empty($_POST["login_userID"]) && !empty($_POST["login_password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["login_userID"];
        try {
            $pdo = new PDO("mysql:dbname={$db['dbname']};host={$db['host']}", $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $stmt = $pdo->prepare("SELECT * FROM `user_info` WHERE `user_id` = :id");
            $stmt->bindParam(':id', $userid, PDO::PARAM_STR);
            $stmt->execute();

            $password = $_POST['login_password'];

            if ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                var_dump($row);
                if (password_verify($password, $row['pass'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['user_id'];
                    $sql = $pdo->prepare("SELECT * FROM `user_info` WHERE `user_id` = :id");
                    $sql->bindParam(':id', $userid, PDO::PARAM_STR);
                    $sql->execute();
                    foreach ($sql as $row) {
                        $row['user_id'];
                        // var_dump($row);
                    }
                    $_SESSION["NAME"] = $row['user_name'];
                    header("Location: main.php");
                    exit();
                } else {
                    echo "認証失敗、ユーザーID";
                }
            } else {
                echo "認証失敗、パスワード";
            }
        } catch (PDOException $e) {
            echo "接続失敗" . $e->getMessage();
        }
    }
}



// // 新規登録処理
// if (isset($_POST['method']) == "signUp_method") {
//     try {
//         $pdo = new PDO("mysql:dbname={$db['dbname']};host={$db['host']}", $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//         $sql = "INSERT INTO user_info(user_id, user_name, pass, mail, registration_date, update_date) VALUES (:id, :name, :pass, :mail, :now_time, :now_time)";
//         $time = date("Y-m-d");
//         $params = array(
//             ':id' => $_POST['signUp_userID'],
//             ':name' => $_POST['signUp_userName'],
//             ':pass' => password_hash($_POST['signUp_password'], PASSWORD_DEFAULT),
//             ':mail' => $_POST['signUp_email'],
//             ':now_time' => $time
//         );
//         $stmt = $pdo->prepare($sql);
//         try {
//             $stmt->execute($params);
//             header("Location:index.php");
//             echo "登録完了";
//         } catch (PDOException $e) {
//             echo "登録失敗";
//         }
//     } catch (PDOException $e) {
//         echo "接続失敗";
//     }
// }