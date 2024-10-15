<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/button.css?v=<?php echo time(); ?>">
    <title>登入</title>
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
    // 檢查表單是否被提交
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 取得使用者輸入的電子郵件和密碼
        $userEmail = $_POST['account'];
        $userPassword = $_POST['password'];
        // 使用準備語句防止SQL注入
        $stmt = $conn->prepare("SELECT * FROM account_info WHERE account_email = ?");
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        // 檢查使用者是否存在
        if ($result->num_rows > 0) {
            // 取得使用者資料
            $user = $result->fetch_assoc();            
            // 驗證密碼
            if ($user['account_password'] == $userPassword) {
                // 重定向到首頁
                $_SESSION['loggedin'] = true; // 設置登入狀態
                // 可以選擇儲存使用者資料
                $_SESSION['user_email'] = $user['account_email'];
                $_SESSION["user_name"] = $user['account_name'];
                $_SESSION["user_role"] = $user['account_role'];
                header("Location: index.php"); // 或者使用其他首頁的URL
                exit(); // 終止腳本執行
            } else {
                echo "<script>alert('密碼錯誤！'); window.location.href='login.php';</script>";
                exit(); // 終止腳本執行
            }
        } else {
            echo "<script>alert('用戶不存在！'); window.location.href='login.php';</script>";
            exit(); // 終止腳本執行
        }
        // 關閉資料庫連線
        $stmt->close();
        $conn->close(); 
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
    <h1 class="title">登入</h1>
    <div class="form__container">      
        <form class="form" id="loginForm" action="login.php" method="post">
            <div class="form__input">
                <label for="account">電子郵件</label>
                <input type="text" id="account" name="account" placeholder="請輸入帳號" required>
            </div>
            <div class="form__input">
                <label for="password">密碼</label>
                <input type="password" id="password" name="password" placeholder="請輸入密碼" required>
            </div>
            <div class="btn__margin">
                <button class="btn" id="loginBtn" type="button">登入</button>    
            </div>    
        </form>
        <div>
            <span>沒有帳號嗎?</span>&nbsp;&nbsp;
            <span class="btn"><a href="register.php">註冊</a></span>
        </div> 
    </div>
    <script src="js/script.js"></script>
    <?php endif; ?> 
</body>
</html>
