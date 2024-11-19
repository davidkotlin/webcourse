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
    try {
        require_once("db.php");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $account_email = $_POST["account"];
            $account_name = $_POST["name"];
            $account_password = $_POST["password"];
            $account_role = $_POST["role"];
            // 檢查 account_email 是否已經存在
            $check_stmt = $conn->prepare("SELECT 1 FROM account_info WHERE account_email = ?");
            $check_stmt->bind_param("s", $account_email);
            $check_stmt->execute();
            $check_stmt->store_result();//確認記錄是否存在，將結果暫存到緩存中
            if ($check_stmt->num_rows > 0) {
                // 如果 email 已存在，顯示提示並返回 login.php
                echo "<script>alert('這個電子郵件已經註冊過'); window.location.href='login.php';</script>";
                $check_stmt->close();
            } 
            else {
                // 插入新帳戶
                $check_stmt->close(); // 關閉檢查語句
                $stmt = $conn->prepare("INSERT INTO account_info (account_email, account_name, account_password, account_role) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $account_email, $account_name, $account_password, $account_role);
                // 執行語句並檢查是否成功
                if ($stmt->execute()) {
                    // 获取插入记录的 ID
                    $account_id = $conn->insert_id;
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_email'] = $account_email;
                    $_SESSION['user_name'] = $account_name;
                    $_SESSION['user_role'] = $account_role;
                    // 重定向到首頁
                    header("Location: index.php");
                    exit();
                } 
                else {
                    echo "<script>alert('註冊失敗'); window.location.href='register.php';</script>";
                }
                // 關閉語句
                $stmt->close();
            }
        }
    }
    catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
    finally {
        // 確保連接在最後關閉
        if (isset($conn) && $conn->ping()) {
            $conn->close();
        }
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
    <script src="js/script.js"></script>
    <?php endif; ?>  
</body>
</html>
