<!-- 上船實習資訊 -->
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
            <h1 class="title">上傳實習資訊</h1>
            <div class="form__container" >        
                <form class="form" id="upload_form" action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form__input">
                        <label for="image">選擇圖片</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                    <div class="form__input">
                        <label for="article_title">標題</label>
                        <input type="text" id="article_title" name="article_title" placeholder="請輸入標題" required>
                    </div>
                    <div class="form__input">
                        <label for="company_name">企業名稱</label>
                        <input type="text" id="company_name" name="company_name" placeholder="請輸入企業名稱" required>
                    </div>
                    <div class="form__input">
                        <label for="start_date">開始時間</label>
                        <input type="date" id="start_date" name="start_date" required>
                    </div>
                    <div class="form__input">
                        <label for="end_date">結束時間</label>
                        <input type="date" id="end_date" name="end_date" required>
                    </div>
                    <div class="form__input">
                        <label for="article_content">內容</label>
                        <textarea id="article_content" name="article_content" placeholder="請輸入內容" required></textarea>
                    </div>
                    <div class="form__input">
                        <label for="file">附加檔案</label>
                        <input type="file" id="file" name="file" >
                    </div>
                    <div class="btn__margin">
                        <button class="btn" id="submitBtn" type="button">上傳</button>
                    </div>    
                </form>        
            </div>
            <script src="js\script.js"></script>
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
            <h1 class="title">上傳實習資訊</h1>
            <div class="form__container" >        
                <form class="form" id="upload_form" action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form__input">
                        <label for="image">選擇圖片</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                    <div class="form__input">
                        <label for="article_title">標題</label>
                        <input type="text" id="article_title" name="article_title" placeholder="請輸入標題" required>
                    </div>
                    <div class="form__input">
                        <label for="company_name">企業名稱</label>
                        <input type="text" id="company_name" name="company_name" placeholder="請輸入企業名稱" required>
                    </div>
                    <div class="form__input">
                        <label for="start_date">開始時間</label>
                        <input type="date" id="start_date" name="start_date" required>
                    </div>
                    <div class="form__input">
                        <label for="end_date">結束時間</label>
                        <input type="date" id="end_date" name="end_date" required>
                    </div>
                    <div class="form__input">
                        <label for="article_content">內容</label>
                        <textarea id="article_content" name="article_content" placeholder="請輸入內容" required></textarea>
                    </div>
                    <div class="form__input">
                        <label for="file">附加檔案</label>
                        <input type="file" id="file" name="file" >
                    </div>
                    <div class="btn__margin">
                        <button class="btn" id="submitBtn" type="button">上傳</button>
                    </div>    
                </form>        
            </div>
            <script src="js\script.js"></script>
        <?php elseif ($_SESSION["user_role"] === "student"): ?>
            <script>
                alert('您沒有權限使用此頁面');
                window.location.href = 'index.php'; // 回首頁
            </script>
        <?php endif; ?>
    <?php else: ?>
        <script>
            alert('您尚未登入！');
            window.location.href = 'index.php'; // 回首頁
        </script>
    <?php endif; ?>    
</body>
</html>