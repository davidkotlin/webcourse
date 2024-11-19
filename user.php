<!-- 用戶頁面 -->
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
                        <h1 class="title">個人資料</h1>
                        <!-- 自動獲取個人資料 -->
                        <?php
                            require_once("db.php");
                            $id = $_SESSION["user_id"];
                            if ($id) {
                                $sql = "SELECT * FROM account_info WHERE account_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($row = $result->fetch_assoc()) {
                                    $account_email = $row["account_email"];
                                    $account_name = $row["account_name"];
                                    $account_password = $row["account_password"];
                                }
                            } else {
                                echo "<h1 class='title'>未提供有效的 ID！</h1>";
                                exit;
                            }
                            // 关闭数据库连接
                            $conn->close();
                        ?>
                        <!--  -->
                        <div class="form__container">
                            <form class="form" id="editUserForm" action="" method="post">
                                <input type="hidden" id="userId" name="id" value="<?php echo $_SESSION["user_id"]; ?>">
                                <div class="form__input">
                                    <label for="account">修改email</label>
                                    <input type="text" id="account" name="account" placeholder="請輸入名稱" value="<?php echo $account_email; ?>" required>
                                </div>
                                <div class="btn__margin">
                                    <button class="btn" id="editEmailBtn" type="button">修改</button>
                                </div>
                                <div class="form__input">
                                    <label for="name">修改名稱</label>
                                    <input type="text" id="name" name="name" placeholder="請輸入名稱" value="<?php echo $account_name; ?>" required>
                                </div>
                                <div class="btn__margin">
                                    <button class="btn" id="editNameBtn" type="button">修改</button>
                                </div>
                                <div class="form__input">
                                    <label for="password">修改密碼</label>
                                    <input type="text" id="password" name="password" placeholder="請輸入密碼" value="<?php echo $account_password; ?>" required>
                                </div>
                                <div class="btn__margin">
                                    <button class="btn" id="editPasswordBtn" type="button">修改</button>
                                </div>
                            </form>
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
                        <h1 class="title">個人資料</h1>
                        <!-- 自動獲取個人資料 -->
                        <?php
                            require_once("db.php");
                            $id = $_SESSION["user_id"];
                            if ($id) {
                                $sql = "SELECT * FROM account_info WHERE account_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($row = $result->fetch_assoc()) {
                                    $account_email = $row["account_email"];
                                    $account_name = $row["account_name"];
                                    $account_password = $row["account_password"];
                                }
                            } else {
                                echo "<h1 class='title'>未提供有效的 ID！</h1>";
                                exit;
                            }
                            // 关闭数据库连接
                            $conn->close();
                        ?>
                        <!--  -->
                        <div class="form__container">
                            <form class="form" id="editUserForm" action="" method="post">
                                <input type="hidden" id="userId" name="id" value="<?php echo $_SESSION["user_id"]; ?>">
                                <div class="form__input">
                                    <label for="account">修改email</label>
                                    <input type="text" id="account" name="account" placeholder="請輸入名稱" value="<?php echo $account_email; ?>" required>
                                </div>
                                <div class="btn__margin">
                                    <button class="btn" id="editEmailBtn" type="button">修改</button>
                                </div>
                                <div class="form__input">
                                    <label for="name">修改名稱</label>
                                    <input type="text" id="name" name="name" placeholder="請輸入名稱" value="<?php echo $account_name; ?>" required>
                                </div>
                                <div class="btn__margin">
                                    <button class="btn" id="editNameBtn" type="button">修改</button>
                                </div>
                                <div class="form__input">
                                    <label for="password">修改密碼</label>
                                    <input type="text" id="password" name="password" placeholder="請輸入密碼" value="<?php echo $account_password; ?>" required>
                                </div>
                                <div class="btn__margin">
                                    <button class="btn" id="editPasswordBtn" type="button">修改</button>
                                </div>
                            </form>
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
                        <h1 class="title">個人資料</h1>
                        <!-- 自動獲取個人資料 -->
                        <?php
                            require_once("db.php");
                            $id = $_SESSION["user_id"];
                            if ($id) {
                                $sql = "SELECT * FROM account_info WHERE account_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($row = $result->fetch_assoc()) {
                                    $account_email = $row["account_email"];
                                    $account_name = $row["account_name"];
                                    $account_password = $row["account_password"];
                                }
                            } else {
                                echo "<h1 class='title'>未提供有效的 ID！</h1>";
                                exit;
                            }
                            // 关闭数据库连接
                            $conn->close();
                        ?>
                        <!--  -->
                        <div class="form__container">
                            <form class="form" id="editUserForm" action="" method="post">
                                <input type="hidden" id="userId" name="id" value="<?php echo $_SESSION["user_id"]; ?>">
                                <div class="form__input">
                                    <label for="account">修改email</label>
                                    <input type="text" id="account" name="account" placeholder="請輸入名稱" value="<?php echo $account_email; ?>" required>
                                </div>
                                <div class="btn__margin">
                                    <button class="btn" id="editEmailBtn" type="button">修改</button>
                                </div>
                                <div class="form__input">
                                    <label for="name">修改名稱</label>
                                    <input type="text" id="name" name="name" placeholder="請輸入名稱" value="<?php echo $account_name; ?>" required>
                                </div>
                                <div class="btn__margin">
                                    <button class="btn" id="editNameBtn" type="button">修改</button>
                                </div>
                                <div class="form__input">
                                    <label for="password">修改密碼</label>
                                    <input type="text" id="password" name="password" placeholder="請輸入密碼" value="<?php echo $account_password; ?>" required>
                                </div>
                                <div class="btn__margin">
                                    <button class="btn" id="editPasswordBtn" type="button">修改</button>
                                </div>
                            </form>
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