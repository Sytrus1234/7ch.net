<?php

declare(strict_types=1);
require_once("random_fnc.php");

class db
{
    private $pdo;
    private $dsn;
    private $query;
    private $stmt;
    private $time;
    private $params;

    private $errorcode;

    // public function U()
    // {
    //     echo "読み込み成功";
    // }

    // コンストラクタ
    public function __construct($db)
    {
        $this->dsn = sprintf('mysql:dbname=%s;host=%s', $db['dbname'], $db['host']);
        try {
            $this->pdo = new PDO($this->dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            $this->errorcode = "接続失敗。<br />";
            echo $this->errorcode;
?>
            <details>
                <summary>エラーを表示</summary>
                <?php echo $e->getMessage(); ?>
            </details>
        <?php
        }
    }

    // 書き込み
    public function record($query, $params, $destination, $token)
    {
        // クエリ登録
        $this->query = $query;
        $this->time = array(':now_time' => date("Y-m-d"));
        $this->params = array_merge($params, $this->time);
        // var_dump($this->params);
        $this->stmt = $this->pdo->prepare($this->query);

        try {
            // 実行 & ページ遷移
            $this->stmt->execute($this->params);
            $token = random(32);
            $_SESSION['token'] = $token;
            setcookie('token', $token);
            $_SESSION['flag'] = "record";
            setcookie('userID', $this->params[':id']);
            setcookie('userName', $this->params[':name']);
            header("Location: $destination");
        } catch (PDOException $e) {
            $this->errorcode = "登録失敗。<br />ユーザーID、又はメールアドレスが既に使用されています<br />";
            echo $this->errorcode;
        ?>
            <details>
                <summary>エラーを表示</summary>
                <?php echo $e->getMessage(); ?>
            </details>
<?php
        }
    }
}
