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
                        <li><a href="index.php">首頁</a></li>                
                        <li><a href="post.php">上傳實習資訊</a></li>              
                        <li><a href="upload.php">上傳報告書</a></li>
                        <li><a href="user.php">個人檔案</a></li>
                        <li><a href="logout.php">登出</a></li>                
                    </ul>
                </div>
            </nav>
        <?php elseif ($_SESSION["user_role"] === "secretary"): ?>
            <nav class="navbar">
                <div class="navbar__container">
                    <a class="navbar__logo" href="index.php">產業實習平台</a>
                    <ul class="navbar__menu">
                        <li><a href="index.php">首頁</a></li>                
                        <li><a href="post.php">上傳實習資訊</a></li>              
                        <li><a href="user.php">個人檔案</a></li>
                        <li><a href="logout.php">登出</a></li>                
                    </ul>
                </div>
            </nav>
        <?php elseif ($_SESSION["user_role"] === "student"): ?>
            <nav class="navbar">
                <div class="navbar__container">
                    <a class="navbar__logo" href="index.php">產業實習平台</a>
                    <ul class="navbar__menu">
                        <li><a href="index.php">首頁</a></li>                              
                        <li><a href="upload.php">上傳報告書</a></li>
                        <li><a href="user.php">個人檔案</a></li>
                        <li><a href="logout.php">登出</a></li>                
                    </ul>
                </div>
            </nav>
        <?php endif; ?>   
            <h1 class="title">個人資料</h1> 
    <?php else: ?>
        <script>
            alert('您尚未登入！');
            window.location.href = 'index.php'; // 回首頁
        </script>
    <?php endif; ?>   
</body>
</html>