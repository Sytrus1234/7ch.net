<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>新規登録</title>
    <?php
    require_once("random_fnc.php");
    session_start();
    $token = random(32);
    // var_dump($token);
    $_SESSION['token'] = $token;

    ?>
</head>

<body>
    <table border="0">
        <form method="POST" action="new.php">
            <tr>
                <td align="right">ユーザーID：</td>
                <td><input type="text" name="id" size="50" maxlength="32" required></td>
            </tr>
            <tr>
                <td align="right">ユーザー名：</td>
                <td><input type="text" name="name" size="50" maxlength="20" required></td>
            </tr>
            <tr>
                <td align="right">メールアドレス：</td>
                <td><input type="email" name="mail" size="50" maxlength="225"></td>
            </tr>
            <tr>
                <td align="right">パスワード：</td>
                <td><input type="password" name="pass" size="50" maxlength="32" required></td>
            </tr>
            <tr>
                <td><input type="submit" value="登録"></td>
            </tr>
            <input type="hidden" value="<?php print $token; ?>" name="token">
        </form>
    </table>
</body>

</html>