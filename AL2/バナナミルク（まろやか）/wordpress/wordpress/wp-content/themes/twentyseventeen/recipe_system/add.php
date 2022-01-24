<?php
require_once '\MAMP\db_config.php';

define("FILE_DIR","./recipe_image/");

$recipe_name = $_POST['recipe_name'];
$howto = $_POST['howto'];
$category = (int)$_POST['category'];
$difficulty = (int)$_POST['difficulty'];
$budget = (int)$_POST['budget'];

try {
    if(!empty($_FILES['picture']['tmp_name'])){
        $upload_res = move_uploaded_file($_FILES['picture']['tmp_name'],FILE_DIR.$_FILES['picture']['name']);
        
        if($upload_res !== true){
            echo "ファイルのアップロードに失敗しました。<br>";
        }else{
            $picture = FILE_DIR.$_FILES['picture']['name'];
        }
    }
    
    $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO recipes (recipe_name, category, difficulty, budget, howto, picture) VALUES (?,?,?,?,?,?)";
    $stmt = $dbh->prepare($sql);
    
    $stmt->bindValue(1, $recipe_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $category, PDO::PARAM_INT);
    $stmt->bindValue(3, $difficulty, PDO::PARAM_INT);
    $stmt->bindValue(4, $budget, PDO::PARAM_INT);
    $stmt->bindValue(5, $howto, PDO::PARAM_STR);
    $stmt->bindValue(6, $picture, PDO::PARAM_STR);
    
    $stmt->execute();
    
    echo "レシピの登録が完了しました。";
    
    echo "<br><a href='/wordpress/index_recipe/'>トップページに戻る</a>";
    
    $dbh = null;
} catch (Exception $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, UTF-8) . "<br>";
    echo "<br><a href='/wordpress/index_recipe/'>トップページに戻る</a>";
    
    die();
}
?>