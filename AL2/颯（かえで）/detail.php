<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="default.css?1">
    <title>詳細</title>
</head>
    
<body>
    <header>
        <div>
        <a href="Home.php">HOME</a>
        <a href="index.html">投稿</a>
            <ul id="nav">
                <li><a href="home.php?category=1">音楽</a></li>
                <li><a href="home.php?category=2">メディア</a></li>
                <li><a href="home.php?category=3">映画</a></li>
                <li><a href="home.php?category=4">スポーツ</a></li>
                <li><a href="home.php?category=5">娯楽</a></li>
                <li><a href="home.php?category=6">漫画・アニメ・ゲーム</a></li>
                <li><a href="home.php?category=7">旅行・アミューズメントパーク・アウトドア</a></li>
                <li><a href="home.php?category=8">食</a></li>
                <li><a href="home.php?category=9">生活</a></li>
                <li><a href="home.php?category=10">教養</a></li>
                <li><a href="home.php?category=11">その他</a></li>
            </ul>
        </div>
    </header>
    <div class = "margin"></div>

<?php
    $user = "root";
    $pass = "root";
    
    $category_list = array
    (
        1    => "音楽",
        2    => "メディア",
        3    => "映画",
        4    => "スポーツ",
        5    => "娯楽",
        6    => "漫画・アニメ・ゲーム",
        7    => "旅行・アミューズメントパーク・アウトドア",
        8    => "食",
        9    => "生活",
        10    => "教養",
        11    => "その他",
    );
    
    try
    {
        if (empty($_GET['thread_id'])) throw new Exception('ID不正');
        $thread_id = (int) $_GET['thread_id'];
        $dbh = new PDO('mysql:host=localhost;dbname=thread;charset=utf8', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM thread WHERE thread_id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $thread_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //詳細表示
        echo "<div>\n";
        echo "<div>" . htmlspecialchars($result['title'],ENT_QUOTES,'UTF-8') . "</div>\n";
        echo "<p>" . nl2br(htmlspecialchars($result['content'],ENT_QUOTES,'UTF-8')) . "<br>\n";
        echo "<a href=home.php?category=" . htmlspecialchars($result['category'],ENT_QUOTES,'UTF-8') . ">";
        echo $category_list[$result['category']];
        echo "</a>\n " . htmlspecialchars($result['date'],ENT_QUOTES,'UTF-8') . "</p>\n";
        echo "</div>\n";
        $dbh = null;
    }
    catch(Exception $e)
    {
        echo "エラー発生: " .htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
        die();
    }

?>
    <form method="post" action="commentpost.php?thread_id=<?php echo $thread_id; ?>">
    コメント<br>
    <textarea name="comment" maxlength="150" rows="4" cols="40" align ="top"></textarea>
    <input type="submit" value="コメントする">
    <br>
    </form>
    
<?php
    try
    {
        $dbh = new PDO('mysql:host=localhost;dbname=thread;charset=utf8', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM comment WHERE thread_id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $thread_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        //コメント一覧表示
        foreach($result as $row)
        {
            echo "<div class=\"comment\">\n";
            echo nl2br(htmlspecialchars($row['comment'],ENT_QUOTES,'UTF-8')) . "<br>\n";
            echo htmlspecialchars($row['date'],ENT_QUOTES,'UTF-8');
            echo "</div>\n";
        }
        
    }
    catch(Exception $e)
    {
        echo "エラー発生: " .htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
        die();
    }
?>
</body>