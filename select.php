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
                        <li><a href="announcement.php">上傳公告</a></li>
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
                        <li><a href="post.php">上傳實習資訊</a></li>              
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