<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ログイン</title>
    <?php
    require_once("random_fnc.php");
    session_start();
    $token_login = random(32);
    // var_dump($token);
    $_SESSION['token_login'] = $token_login;

    ?>
</head>

<body>
    <table border="0">
        <form method="POST" action="log_in_check.php">
            <tr>
                <td align="right">ユーザーID：</td>
                <td><input type="text" name="id" size="50" maxlength="32" required></td>
            </tr>
            <tr>
                <td align="right">パスワード：</td>
                <td><input type="password" name="pass" size="50" maxlength="32" required></td>
            </tr>
            <tr>
                <td><input type="submit" value="ログイン"></td>
            </tr>
            <input type="hidden" value="<?php print $token_login; ?>" name="token_login">
        </form>
    </table>

</html>
</body>