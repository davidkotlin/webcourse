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
    <?php session_start(); ?>
    <?php if ( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ): ?>
        <?php if ($_SESSION["user_role"] === "administrator"): ?>
            <nav class="navbar">
                <div class="navbar__container">
                    <a class="navbar__logo" href="index.php">產業實習平台</a>
                    <ul class="navbar__menu">
                        <li><a href="user.php"><?php echo $_SESSION["user_name"]."&nbsp;&nbsp;".$_SESSION["user_role"]; ?></a></li>
                        <li><a href="index.php">首頁</a></li>                
                        <li><a href="post.php">上傳實習資訊</a></li>              
                        <li><a href="upload.php">上傳報告書</a></li>
                        <li><a href="logout.php">登出</a></li>                
                    </ul>
                </div>
            </nav>
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
        <?php endif; ?>
        <div class="main">
            <div class="sidebar">
                <button id="sidebarBtn" type="button">個人資料</button>
                <button id="sidebarBtn" type="button">精選實習</button>
                <button id="sidebarBtn" type="button">修該上傳</button>
            </div>
            <div class="mainContent">
                <h1 class="title">個人資料</h1>
                <div class="form__container">
                    <form class="form" id="editUserForm" action="user.php" method="post">
                        <div class="form__input">
                            <label for="name">修改名稱</label>
                            <input type="text" id="name" name="name" placeholder="請輸入名稱" required>
                        </div>
                        <div class="btn__margin">
                            <button class="btn" id="editNameBtn" type="button">修改</button>
                        </div>
                        <div class="form__input">
                            <label for="password">修改密碼</label>
                            <input type="password" id="password" name="password" placeholder="請輸入密碼" required>
                        </div>
                        <div class="btn__margin">
                            <button class="btn" id="editPasswordBtn" type="button">修改</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    <?php else: ?>
        <script>
            alert('您尚未登入！');
            window.location.href = 'index.php'; // 回首頁
        </script>
    <?php endif; ?>   
</body>
</html>