<!-- 修改會員頁面 -->
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
                        <li><a href="announcement.php">上傳公告</a></li>
                        <li><a href="logout.php">登出</a></li>               
                    </ul>
                </div>
            </nav>
            <h1 class="title">修改會員</h1>
            <!-- 自動獲取會員資料 -->
            <?php
                require_once("db.php");
                // 确认是否有传入 `id` 参数
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    // 使用准备好的语句 (Prepared Statements)
                    $sql = "SELECT * FROM account_info WHERE account_id = ?";
                    $stmt = $conn->prepare($sql);
                    // 检查语句是否准备成功
                    if ($stmt) {
                        // 绑定参数
                        $stmt->bind_param("i", $id); // "i" 表示参数类型为整型                     
                        // 执行查询
                        $stmt->execute();                      
                        // 获取结果
                        $result = $stmt->get_result();
                        // 解析结果
                        if ($row = $result->fetch_assoc()) {
                            $account_email = htmlspecialchars($row["account_email"]);
                            $account_name = htmlspecialchars($row["account_name"]);
                            $account_role = htmlspecialchars($row["account_role"]);
                        } else {
                            echo "找不到對應的會員資料！";
                            exit;
                        }
                        // 关闭语句
                        $stmt->close();
                    } else {
                        echo "SQL 語句準備失敗！";
                        exit;
                    }
                } else {
                    echo "<h1 class='title'>未提供有效的 ID！&nbsp;&nbsp;<a href='managingAccount.php'>返回</a></h1>";
                    exit;
                }
                // 关闭数据库连接
                $conn->close();
            ?>
            <!--  -->
            <div class="form__container" >        
                <form class="form" id="editAccount_form" action="upgrateAccount.php" method="post">
                    <!-- 隱藏的 ID 輸入框，方便提交時攜帶 ID -->
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                    <div class="form__input">
                        <label for="account">該會員電子郵件</label>
                        <input type="text" id="account" name="account" placeholder="請輸入帳號" value="<?php echo $account_email; ?>" required>
                    </div>
                    <div class="form__input">
                        <label for="name">該會員名稱</label>
                        <input type="text" id="name" name="name" placeholder="請輸入名稱" value="<?php echo $account_name; ?>" required>
                    </div>
                    <div class="form__input">
                        <label for="role">該會員角色</label>
                        <select id="role" name="role" required>
                            <option value="" disabled selected>請選擇角色</option>
                            <option value="administrator" <?php echo $account_role === 'administrator' ? 'selected' : ''; ?>>管理員</option>
                            <option value="secretary" <?php echo $account_role === 'secretary' ? 'selected' : ''; ?>>系秘書</option>
                            <option value="student" <?php echo $account_role === 'student' ? 'selected' : ''; ?>>學生</option>         
                        </select>
                    </div>
                    <div class="btn__margin">
                        <button class="btn" id="editAccountBtn" type="button">修改</button>
                    </div>    
                </form>        
            </div>
            <script src="js\script.js"></script>
        <?php elseif ($_SESSION["user_role"] === "secretary"): ?>
            <script>
                alert('您沒有權限使用此頁面！');
                window.location.href = 'index.php'; // 回首頁
            </script>   
        <?php elseif ($_SESSION["user_role"] === "student"): ?>
            <script>
                alert('您沒有權限使用此頁面！');
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