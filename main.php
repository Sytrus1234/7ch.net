<?php
declare(strict_types=1);

session_start();
// var_dump($_SESSION);
if (!isset($_SESSION['NAME'])) {
  die('ログインしていません');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
</head>
<body>
  <h1>メイン画面</h1>
  <!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
  <p>ようこそ<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん</p>  <!-- ユーザー名をechoで表示 -->
  <ul>
    <li><a href="Logout.php">ログアウト</a></li>
  </ul>
</body>
</html>