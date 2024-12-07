<!-- 上船報告書、公告、實習資訊 -->
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
        try {
            require_once("db.php");
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                //分辨角色
                // 圖片目錄與檔案目錄
                $image_dir = 'uploads/images/';
                $file_dir = 'uploads/files/';
                if (!is_dir($image_dir)) mkdir($image_dir, 0777, true); // 如果目錄不存在則自動建立
                if (!is_dir($file_dir)) mkdir($file_dir, 0777, true); // 如果目錄不存在則自動建立
                // 處理圖片
                $image_url = null; 
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $image_path = $image_dir . uniqid('img_') . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    //uniqid()它會生成一個唯一的 ID，'img_' 是這個唯一 ID 的前綴
                    //pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION): 這一部分取得上傳檔案的副檔名
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                        //move_uploaded_file(): 這個函數會將檔案從暫存位置移動到你指定的目標位置
                        //$_FILES['image']['tmp_name'] 是 PHP 系統為每個上傳的檔案暫時存放的路徑
                        // $image_path 上面設定的目標路徑
                        $image_url = $image_path; // 成功上傳，儲存圖片的相對路徑
                    } else {
                        if ($_SESSION['user_role'] === "administrator") {
                            $image_url = 'img/announcement.png'; // 上傳失敗，保留為空值        
                        }
                        elseif ($_SESSION['user_role'] === "secretary") {
                            $image_url = 'img/suitcase.png'; // 上傳失敗，保留為空值        
                        }
                        elseif ($_SESSION['user_role'] === "student") {
                            $image_url = 'img/report.png'; // 上傳失敗，保留為空值        
                        }
                    }
                }
                else{
                    if ($_SESSION['user_role'] === "administrator") {
                        $image_url = 'img/announcement.png'; // 上傳失敗，保留為空值        
                    }
                    elseif ($_SESSION['user_role'] === "secretary") {
                        $image_url = 'img/suitcase.png'; // 上傳失敗，保留為空值        
                    }
                    elseif ($_SESSION['user_role'] === "student") {
                        $image_url = 'img/report.png'; // 上傳失敗，保留為空值        
                    }
                }
                // 處理附加檔案
                $file_url = null; // 預設為空值
                if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                    $file_path = $file_dir . uniqid('file_') . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                        $file_url = $file_path; // 成功上傳，儲存檔案的相對路徑
                    } else {
                        $file_url = null; // 上傳失敗，保留為空值
                    }
                }
                // 獲取其他表單數據
                $account_id = $_SESSION['user_id'];
                $article_id = $account_id . uniqid($_SESSION['user_email']);
                $article_title = $_POST['article_title'];
                $industry_input = $_POST['industry_input'];
                $article_content =  $_POST['article_content'];
                
                if ($_SESSION['user_role'] === "administrator") {
                    $article_type = 'announcement';
                }
                elseif ($_SESSION['user_role'] === "secretary") {
                    $article_type = 'internship';
                }
                elseif ($_SESSION['user_role'] === "student") {
                    $article_type = 'report';
                }
                $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : null;
                $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
                $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;
                // 將數據插入到資料庫中
                $stmt = $conn->prepare("INSERT INTO articles (article_id, title, content, article_type, industry, company_name, start_date, end_date, attachment_url, image_url, account_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssssi", $article_id, $article_title, $article_content, $article_type, $industry_input, $company_name, $start_date, $end_date, $file_url, $image_url, $account_id);
                if ($stmt->execute()) {
                    header("Location: index.php");
                    exit();
                }
                else {
                    echo "<script>alert('上傳失敗'); window.location.href='upload.php';</script>";
                }
                // 關閉語句
                $stmt->close();
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
            <h1 class="title">上傳公告</h1>
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
                        <label for="industry_input">產業種類</label>
                        <div class="dropdown">
                            <input type="text" id="industry_input" name="industry_input" placeholder="搜尋或選取產業種類" required>
                            <div id="dropdown_list" class="dropdown-list"></div>
                        </div>
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
                        <li><a href="upload.php">上傳實習資訊</a></li>
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
                        <label for="industry_input">產業種類</label>
                        <div class="dropdown">
                            <input type="text" id="industry_input" name="industry_input" placeholder="搜尋或選取產業種類" required>
                            <div id="dropdown_list" class="dropdown-list"></div>
                        </div>
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
            <h1 class="title">上傳報告書</h1>
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
                        <label for="industry_input">產業種類</label>
                        <div class="dropdown">
                            <input type="text" id="industry_input" name="industry_input" placeholder="搜尋或選取產業種類" required>
                            <div id="dropdown_list" class="dropdown-list"></div>
                        </div>
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
        <?php endif; ?>
    <?php else: ?>
        <script>
            alert('您尚未登入！');
            window.location.href = 'index.php'; // 回首頁
        </script>
    <?php endif; ?>    
</body>
</html>