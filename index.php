<?php

declare(strict_types=1);

require_once("random_fnc.php");
session_start();
$token = random(32);
// var_dump($token);
$_SESSION['token'] = $token;
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <title>ようこそ</title>
</head>

<body>
    <h1>ようこそ</h1>

    <br>

    <!-- ログイン -->
    <div class="login">
        <table border="0">
            <thead>
                <tr>
                    <h2>ログインの方</h2>
                </tr>
            </thead>
            <form action="method.php" method="POST">
                <tr>
                    <td class="tb"><label for="logID">ユーザーID：</label></td>
                    <td><input type="text" name="login_userID" size="32" maxlength="30" required id="logID"></td>
                </tr>
                <tr>
                    <td class="tb"><label for="logPS">パスワード：</label></td>
                    <td><input type="password" name="login_password" size="32" maxlength="32" required id="logPS"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="ログイン" class="login_submit"></td>
                </tr>
                <!-- hidden -->
                <input type="hidden" value="login_method" name="method">
                <input type="hidden" value="<?php $token; ?>" name="token">
            </form>
        </table>
    </div>

    <br>

    <!-- 新規登録 -->
    <div class="signUp">
        <table border="0">
            <thead>
                <tr>
                    <h2>新規登録の方</h2>
                </tr>
            </thead>
            <form action="method.php" method="POST">
                <tr>
                    <td class="tb"><label for="siID">ユーザーID：</label></td>
                    <td><input type="text" name="signUp_userID" size="32" maxlength="30" required id="siID"></td>
                </tr>
                <tr>
                    <td class="tb"><label for="siNa">ユーザー名：</label></td>
                    <td><input type="text" name="signUp_userName" size="32" maxlength="30" id="siNa"></td>
                </tr>
                <tr>
                    <td class="tb"><label for="siPS">パスワード：</label></td>
                    <td><input type="password" name="signUp_password" size="32" maxlength="32" required id="siPS" placeholder="最大32文字まで"></td>
                </tr>
                <tr>
                    <td class="tb"><label for="siMa">メールアドレス：</label></td>
                    <td><input type="email" name="signUp_email" size="32" maxlength="300" required id="siMa" placeholder="example@example.com"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="新規登録" class="signUp_submit"></td>
                </tr>
                <!-- hidden -->
                <input type="hidden" value="signUp_method" name="method">
                <input type="hidden" value="<?php $token; ?>" name="token">
            </form>
        </table>
    </div>
</body>

</html>