<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/button.css?v=<?php echo time(); ?>">
    <title>註冊</title>
</head>
<!-- php -->
<?php 
    session_start(); // 設定session紀錄登入資訊
    $host = 'localhost'; // 資料庫主機
    $dbname = 'internship'; // 請替換為您的資料庫名稱
    $username = 'root'; // 使用者名稱
    $password = ''; // 如果沒有密碼，則留空
    // 建立資料庫連線
    $conn = new mysqli($host, $username, $password, $dbname);
    // 檢查連線是否成功
    if ($conn->connect_error) {
        die("連線失敗: " . $conn->connect_error);
    } 
?>
<!--  -->
<body>
    <?php if ( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ): ?>
        <script>
            alert("你已登入")
            window.location.href="index.php"
        </script>
    <?php else: ?>
    <nav class="navbar">
        <div class="navbar__container">
            <a class="navbar__logo" href="index.php">產業實習平台</a>
            <ul class="navbar__menu">
                <li><a href="index.php">首頁</a></li>
                <li><a href="upload.php">上傳</a></li>
                <li><a href="login.php">登入</a></li>
            </ul>
        </div>
    </nav>
    <h1 class="title">註冊</h1>
    <div class="form__container">       
        <form class="form" id="registerForm" action="register.php" method="post">
            <div class="form__input">
                <label for="account">電子郵件</label>
                <input type="text" id="account" name="account" placeholder="請輸入帳號" required>
            </div>
            <div class="form__input">
                <label for="name">名稱</label>
                <input type="text" id="name" name="name" placeholder="請輸入名稱" required>
            </div>
            <div class="form__input">
                <label for="password">密碼</label>
                <input type="password" id="password" name="password" placeholder="請輸入密碼" required>
            </div>
            <div class="form__input">
                <label for="role">選擇角色</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>請選擇角色</option>
                    <option value="administrator">管理員</option>  
                    <option value="secretary">系秘書</option>     
                    <option value="student">學生</option>         
                </select>
            </div>
            <div class="btn__margin">
                <button class="btn" id="registerBtn" type="button">註冊</button>
            </div>
        </form>
    </div>
    <?php endif; ?>  
</body>
</html>
