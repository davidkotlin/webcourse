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
    <nav class="navbar">
        <div class="navbar__container">
            <a class="navbar__logo" href="index.php">產業實習平台</a>
            <ul class="navbar__menu">               
                <?php if ( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ): ?>
                    <?php if ($_SESSION["user_role"] === "administrator"): ?>
                        <li><a href="user.php"><?php echo $_SESSION["user_name"]."&nbsp;&nbsp;".$_SESSION["user_role"]; ?></a></li>
                        <li><a href="index.php">首頁</a></li>
                        <li><a href="announcement.php">上傳公告</a></li>
                        <li><a href="logout.php">登出</a></li>
                    <?php elseif ($_SESSION["user_role"] === "secretary"): ?>
                        <li><a href="user.php"><?php echo $_SESSION["user_name"]."&nbsp;&nbsp;".$_SESSION["user_role"]; ?></a></li>
                        <li><a href="index.php">首頁</a></li>
                        <li><a href="post.php">上傳實習資訊</a></li>
                        <li><a href="logout.php">登出</a></li>
                    <?php elseif ($_SESSION["user_role"] === "student"): ?>                       
                        <li><a href="user.php"><?php echo $_SESSION["user_name"]."&nbsp;&nbsp;".$_SESSION["user_role"]; ?></a></li>
                        <li><a href="index.php">首頁</a></li>
                        <li><a href="upload.php">上傳報告書</a></li>
                        <li><a href="logout.php">登出</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <li><a href="index.php">首頁</a></li>
                    <li><a href="login.php">上傳</a></li>
                    <li><a href="login.php">登入</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="main">
        <div class="sidebar">
            <button class="sidebarBtn" id="type1Btn" type="button">電子電機</button>
            <button class="sidebarBtn" id="type2Btn" type="button">電腦周邊</button>
            <button class="sidebarBtn" id="type3Btn" type="button">半導體</button>
            <button class="sidebarBtn" id="type4Btn" type="button">通訊網路</button>
            <button class="sidebarBtn" id="type5Btn" type="button">資訊服務</button>
            <button class="sidebarBtn" id="type6Btn" type="button">金融保險</button>
            <button class="sidebarBtn" id="type6Btn" type="button">生技醫療</button>
            <button class="sidebarBtn" id="type6Btn" type="button">紡織纖維</button>
            <button class="sidebarBtn" id="type6Btn" type="button">化學工業</button>
            <button class="sidebarBtn" id="type6Btn" type="button">食品工業</button>
            <button class="sidebarBtn" id="type6Btn" type="button">觀光餐旅</button>
            <button class="sidebarBtn" id="type6Btn" type="button">其他</button>
        </div>
        <div class="mainContent">
            <div class="showSection">
            <h1 class="title">實習資訊</h1>
            <div class="container">
                <div class="posts">
                    <section class="post"></section>
                </div>
            </div>
            </div>
        </div>       
    </div>
</body>
</html>