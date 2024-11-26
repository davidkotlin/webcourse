<!-- 用戶文章頁面 -->
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
                        <li><a href="upload.php">上傳公告</a></li>
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
                        <h1 class="title">管理會員</h1>
                        <div class="form__container">
                            <table class="accountTable">
                                <tr>
                                    <th>會員Email</th>
                                    <th>會員名稱</th>
                                    <th>會員角色</th>
                                    <th>操作</th>
                                </tr>
                                <?php
                                    try {
                                        require_once("db.php");
                                        $stmt = $conn->prepare("SELECT * FROM account_info");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($row = $result->fetch_array()) {
                                            if ($row["account_role"] !== "administrator") {
                                                echo "<tr>";
                                                echo "<td>" . $row["account_email"] . "</td>";
                                                echo "<td>" . $row["account_name"] . "</td>";
                                                echo "<td>" . $row["account_role"] . "</td>";
                                                echo "<td class='operation'><a href='editAccount.php?id=" . $row["account_id"] . "'>編輯</a> | <a href='#' onclick='openModal(" . $row["account_id"] . ")'>刪除</a></td>";
                                                echo "</tr>";
                                            }
                                        }
                                    } catch (Exception $e) {
                                        echo 'Message: ' . $e->getMessage();
                                    } finally {
                                        if (isset($conn) && $conn->ping()) {
                                            $conn->close();
                                        }
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 模態框結構 -->
            <div id="deleteModal" class="modal-overlay" style="display: none;">
                <div class="modal">
                    <h3>確認刪除</h3>
                    <p>您確定要刪除此帳戶嗎？此操作無法恢復！</p>
                    <button class="btn" onclick="confirmDelete()">確認</button>
                    <button class="btn" onclick="closeModal()">取消</button>
                    <form id="deleteForm" method="POST" action="deleteAccount.php">
                        <input type="hidden" id="accountId" name="account_id">
                    </form>
                </div>
            </div>
        <?php elseif ($_SESSION["user_role"] === "secretary"): ?>
            <script>
                alert('您沒有權限使用此頁面');
                window.location.href = 'index.php'; // 回首頁
            </script>
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
    <script src="js/script.js"></script>
</body>
</html>