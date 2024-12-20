<!-- 顯示你的精選 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/button.css?v=<?php echo time(); ?>">
    <title>產業實習平台</title>
</head>
<body>
<?php 
    session_start();
?>
    <?php if ( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ): ?>
        <?php if ($_SESSION["user_role"] === "administrator"): ?>
            <nav class="navbar">
                <div class="navbar__container">
                    <a class="navbar__logo" href="index.php">產業實習平台</a>
                    <ul class="navbar__menu">
                        <li><a href="user.php"><?php echo $_SESSION["user_name"]."&nbsp;&nbsp;".$_SESSION["user_role"]; ?></a></li>
                        <li><a href="index.php">首頁</a></li>                
                        <li><a href="upload.php">上傳公告</a></li>
                        <li><a href="logout.php">登出</a></li>                
                    </ul>
                </div>
            </nav>
            <div class="main">
                <div class="sidebar">
                    <button class="sidebarBtn" id="userBtn" type="button">個人資料</button>
                    <button class="sidebarBtn" id="selectBtn" type="button">精選實習</button>
                    <button class="sidebarBtn" id="editArticleBtn" type="button">修改上傳</button>
                    <button class="sidebarBtn" id="manageAccountBtn" type="button">管理會員</button>
                </div>
                <div class="mainContent">
                    <div class="showSection">
                        <h1 class="title">精選文章</h1>
                        <div class="searchArea">
                            <label for="searchInput">搜尋:</label>
                            <input type="text" id="searchInput" name="searchInput" placeholder="請輸入文章名稱或企業名稱">
                            <button class="btn" id="searchBtn" data-page="select" type="button">搜尋</button>
                        </div>
                        <div class="container">
                            <?php
                                try{
                                    require_once("db.php");
                                    $stmt = $conn->prepare("SELECT * FROM articles INNER JOIN follows ON follows.article_id = articles.article_id WHERE follows.account_id = $_SESSION[user_id] ORDER BY follows.created_at DESC");
                                    $stmt ->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_array()){
                                        echo "<section class='post'>";
                                        echo "<div class='leftArticlePart'>";                             
                                        echo "<img class='articleImage' src=" . $row["image_url"] . ">";
                                        echo "</div>";
                                        echo "<div class='rightArticlePart'>";
                                        echo "<h2>" . $row["title"] . "</h2>";
                                        echo "<div>" . $row["content"] . "</div>";
                                        echo "<p>產業類別：" . $row["industry"] . "</p>";
                                        if (isset($row["company_name"])) {
                                            echo "<p>公司名稱：" . $row["company_name"] . "</p>";
                                        }
                                        if (isset($row["start_date"]) && $row["start_date"] !== "0000-00-00") {
                                            echo "<p>開始日期：" . $row["start_date"] . "</p>";
                                        }
                                        elseif (isset($row["start_date"]) && $row["start_date"] === "0000-00-00") {
                                            echo "<p>開始日期：未公佈 </p>";
                                        }
                                        if (isset($row["end_date"]) && $row["end_date"] !== "0000-00-00") {
                                            echo "<p>結束日期：" . $row["end_date"] . "</p>";
                                        }
                                        elseif (isset($row["end_date"]) && $row["end_date"] === "0000-00-00") {
                                            echo "<p>結束日期：未公佈 </p>";
                                        }
                                        if (isset($row["attachment_url"])) {
                                            echo "<p><a href='" . $row["attachment_url"] . "' download>下載附加檔案</a></p>";
                                        }
                                        echo "<p>發佈時間：" . $row["created_at"] . "</p>";
                                        echo "<input type='hidden' id='articleId' value='" . $row["article_id"] . "'>";
                                        echo "</div>";
                                        echo "</section>";
                                    }
                                } catch (Exception $e) {
                                    echo 'Message: ' . $e->getMessage();
                                } finally {
                                    if (isset($conn) && $conn->ping()) {
                                        $conn->close();
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($_SESSION["user_role"] === "secretary"): ?>
            <nav class="navbar">
                <div class="navbar__container">
                    <a class="navbar__logo" href="index.php">產業實習平台</a>
                    <ul class="navbar__menu">
                        <li><a href="user.php"><?php echo $_SESSION["user_name"]."&nbsp;&nbsp;".$_SESSION["user_role"]; ?></a></li>
                        <li><a href="index.php">首頁</a></li>                
                        <li><a href="upload.php">上傳實習資訊</a></li>              
                        <li><a href="logout.php">登出</a></li>                
                    </ul>
                </div>
            </nav>
            <div class="main">
                <div class="sidebar">
                    <button class="sidebarBtn" id="userBtn" type="button">個人資料</button>
                    <button class="sidebarBtn" id="selectBtn" type="button">精選實習</button>
                    <button class="sidebarBtn" id="editArticleBtn" type="button">修改上傳</button>
                </div>
                <div class="mainContent">
                    <div class="showSection">
                        <h1 class="title">精選文章</h1>
                        <div class="searchArea">
                            <label for="searchInput">搜尋:</label>
                            <input type="text" id="searchInput" name="searchInput" placeholder="請輸入文章名稱或企業名稱">
                            <button class="btn" id="searchBtn" data-page="select" type="button">搜尋</button>
                        </div>
                        <div class="container">
                            <?php
                                try{
                                    require_once("db.php");
                                    $stmt = $conn->prepare("SELECT * FROM articles INNER JOIN follows ON follows.article_id = articles.article_id WHERE follows.account_id = $_SESSION[user_id] ORDER BY follows.created_at DESC");
                                    $stmt ->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_array()){
                                        echo "<section class='post'>";
                                        echo "<div class='leftArticlePart'>";                             
                                        echo "<img class='articleImage' src=" . $row["image_url"] . ">";
                                        echo "</div>";
                                        echo "<div class='rightArticlePart'>";
                                        echo "<h2>" . $row["title"] . "</h2>";
                                        echo "<div>" . $row["content"] . "</div>";
                                        echo "<p>產業類別：" . $row["industry"] . "</p>";
                                        if (isset($row["company_name"])) {
                                            echo "<p>公司名稱：" . $row["company_name"] . "</p>";
                                        }
                                        if (isset($row["start_date"]) && $row["start_date"] !== "0000-00-00") {
                                            echo "<p>開始日期：" . $row["start_date"] . "</p>";
                                        }
                                        elseif (isset($row["start_date"]) && $row["start_date"] === "0000-00-00") {
                                            echo "<p>開始日期：未公佈 </p>";
                                        }
                                        if (isset($row["end_date"]) && $row["end_date"] !== "0000-00-00") {
                                            echo "<p>結束日期：" . $row["end_date"] . "</p>";
                                        }
                                        elseif (isset($row["end_date"]) && $row["end_date"] === "0000-00-00") {
                                            echo "<p>結束日期：未公佈 </p>";
                                        }
                                        if (isset($row["attachment_url"])) {
                                            echo "<p><a href='" . $row["attachment_url"] . "' download>下載附加檔案</a></p>";
                                        }
                                        echo "<p>發佈時間：" . $row["created_at"] . "</p>";
                                        echo "<input type='hidden' id='articleId' value='" . $row["article_id"] . "'>";
                                        echo "</div>";
                                        echo "</section>";
                                    }
                                } catch (Exception $e) {
                                    echo 'Message: ' . $e->getMessage();
                                } finally {
                                    if (isset($conn) && $conn->ping()) {
                                        $conn->close();
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($_SESSION["user_role"] === "student"): ?>
            <nav class="navbar">
                <div class="navbar__container">
                    <a class="navbar__logo" href="index.php">產業實習平台</a>
                    <ul class="navbar__menu">
                        <li><a href="user.php"><?php echo $_SESSION["user_name"]."&nbsp;&nbsp;".$_SESSION["user_role"]; ?></a></li>
                        <li><a href="index.php">首頁</a></li>                              
                        <li><a href="upload.php">上傳報告書</a></li>
                        <li><a href="logout.php">登出</a></li>                
                    </ul>
                </div>
            </nav>
            <div class="main">
                <div class="sidebar">
                    <button class="sidebarBtn" id="userBtn" type="button">個人資料</button>
                    <button class="sidebarBtn" id="selectBtn" type="button">精選實習</button>
                    <button class="sidebarBtn" id="editArticleBtn" type="button">修改上傳</button>
                </div>
                <div class="mainContent">
                    <div class="showSection">
                        <h1 class="title">精選文章</h1>
                        <div class="searchArea">
                            <label for="searchInput">搜尋:</label>
                            <input type="text" id="searchInput" name="searchInput" placeholder="請輸入文章名稱或企業名稱">
                            <button class="btn" id="searchBtn" data-page="select" type="button">搜尋</button>
                        </div>
                        <div class="container">
                            <?php
                                try{
                                    require_once("db.php");
                                    $stmt = $conn->prepare("SELECT * FROM articles INNER JOIN follows ON follows.article_id = articles.article_id WHERE follows.account_id = $_SESSION[user_id] ORDER BY follows.created_at DESC");
                                    $stmt ->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_array()){
                                        echo "<section class='post'>";
                                        echo "<div class='leftArticlePart'>";                             
                                        echo "<img class='articleImage' src=" . $row["image_url"] . ">";
                                        echo "</div>";
                                        echo "<div class='rightArticlePart'>";
                                        echo "<h2>" . $row["title"] . "</h2>";
                                        echo "<div>" . $row["content"] . "</div>";
                                        echo "<p>產業類別：" . $row["industry"] . "</p>";
                                        if (isset($row["company_name"])) {
                                            echo "<p>公司名稱：" . $row["company_name"] . "</p>";
                                        }
                                        if (isset($row["start_date"]) && $row["start_date"] !== "0000-00-00") {
                                            echo "<p>開始日期：" . $row["start_date"] . "</p>";
                                        }
                                        elseif (isset($row["start_date"]) && $row["start_date"] === "0000-00-00") {
                                            echo "<p>開始日期：未公佈 </p>";
                                        }
                                        if (isset($row["end_date"]) && $row["end_date"] !== "0000-00-00") {
                                            echo "<p>結束日期：" . $row["end_date"] . "</p>";
                                        }
                                        elseif (isset($row["end_date"]) && $row["end_date"] === "0000-00-00") {
                                            echo "<p>結束日期：未公佈 </p>";
                                        }
                                        if (isset($row["attachment_url"])) {
                                            echo "<p><a href='" . $row["attachment_url"] . "' download>下載附加檔案</a></p>";
                                        }
                                        echo "<p>發佈時間：" . $row["created_at"] . "</p>";
                                        echo "<input type='hidden' id='articleId' value='" . $row["article_id"] . "'>";
                                        echo "</div>";
                                        echo "</section>";
                                    }
                                } catch (Exception $e) {
                                    echo 'Message: ' . $e->getMessage();
                                } finally {
                                    if (isset($conn) && $conn->ping()) {
                                        $conn->close();
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>    
    <?php else: ?>
        <script>
            alert('您尚未登入！');
            window.location.href = 'index.php'; // 回首頁
        </script>
    <?php endif; ?>
    <script src="js/script.js"></script>
</body>
</html>