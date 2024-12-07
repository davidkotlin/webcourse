<?php
try {
    require_once('db.php');
    $article_id = $_GET['article_id'];
    if ($article_id) {
        $stmt = $conn->prepare("DELETE FROM articles WHERE article_id = ?");
        $stmt->bind_param("s", $article_id);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: myArticle.php");
            exit();
        } else {
            echo "資料刪除失敗: " . $stmt->error . "<br><a href='myArticle.php'>返回</a>";
            $stmt->close();
            exit();
        } 
    } else {
        echo "<h1 class='title'>未提供有效的 ID！</h1>";
        exit();
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("Location: myArticle.php");
    exit();
} finally {
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
} 
?>