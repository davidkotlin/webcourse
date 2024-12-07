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
            <h1 class="title">修改上傳公告</h1>
            <!-- 自動獲取文章資料 -->
            <?php
                require_once("db.php");
                if (isset($_GET['article_id'])) {
                  $article_id = $_GET['article_id'];
                  $stmt = $conn->prepare("SELECT * FROM articles WHERE article_id = ?");
                  $stmt->bind_param("s", $article_id);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  if ($row = $result->fetch_array()) {
                      $article_title = $row['title'];
                      $article_content = $row['content'];
                      $industry = $row['industry'];
                      $attachment_url = $row['attachment_url'];
                      $image_url = $row['image_url'];
                  } else {
                      echo "<script>alert('未提供有效的 ID！');window.location.href='myArticle.php';</script>";
                      exit;
                  }
                } else {
                    echo "<h1 class='title'>未提供有效的 ID！&nbsp;&nbsp;<a href='myArticle.php'>返回</a></h1>";
                    exit;
                }
                // 关闭数据库连接
                $conn->close();
            ?>
            <!--  -->
            <div class="form__container" >        
                <form class="form" id="revise_form" action="upgrateArticle.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="article_id" name="article_id" value=<?php echo $article_id; ?>>
                    <div class="form__input">
                        <label for="image">選擇新圖片</label>
                        <p class="old-data" id="old-image">原圖片:<?php echo $image_url; ?></p>
                        <input type="file" id="image" name="image" accept="image/* value=<?php echo $image_url; ?>">
                    </div>
                    <div class="form__input">
                        <label for="article_title">修改標題</label>
                        <input type="text" id="article_title" name="article_title" placeholder="請輸入標題" value="<?php echo $article_title; ?>" required>
                    </div>
                    <div class="form__input">
                        <label for="industry_input">修改產業種類</label>
                        <div class="dropdown">
                            <input type="text" id="industry_input" name="industry_input" placeholder="搜尋或選取產業種類" value="<?php echo $industry; ?>" required>
                            <div id="dropdown_list" class="dropdown-list"></div>
                        </div>
                    </div>
                    <div class="form__input">
                        <label for="article_content">修改內容</label>
                        <textarea id="article_content" name="article_content" placeholder="請輸入內容" required><?php echo $article_content; ?></textarea>
                    </div>
                    <div class="form__input">
                        <label for="file">修改附加檔案</label>
                        <?php
                            echo isset($attachment_url) ? "<p class='old-data' id='old-attachment'>原附加檔案".$attachment_url."</p>" : "<p class='old-data' id='old-attachment'>無附加檔案紀錄</p>";
                        ?>
                        <input type="file" id="file" name="file">
                    </div>
                    <div class="submitOrCancel">
                        <div class="btn__margin">
                            <a href="myArticle.php"><button class="btn" type="button">取消</button></a>
                        </div> 
                        <div class="btn__margin">
                            <button class="btn" id="reviseArticleBtn" type="button">上傳</button>
                        </div> 
                    </div>   
                </form>        
            </div>
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
            <h1 class="title">修改上傳實習資訊</h1>
            <!-- 自動獲取文章資料 -->
            <?php
                require_once("db.php");
                if (isset($_GET['article_id'])) {
                  $article_id = $_GET['article_id'];
                  $stmt = $conn->prepare("SELECT * FROM articles WHERE article_id = ?");
                  $stmt->bind_param("s", $article_id);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  if ($row = $result->fetch_array()) {
                      $article_title = $row['title'];
                      $article_content = $row['content'];
                      $industry = $row['industry'];
                      $company_name = $row['company_name'];
                      $start_date = $row["start_date"];
                      $end_date = $row["end_date"];
                      $attachment_url = $row['attachment_url'];
                      $image_url = $row['image_url'];
                  } else {
                      echo "<script>alert('未提供有效的 ID！');window.location.href='myArticle.php';</script>";
                      exit;
                  }
                } else {
                    echo "<h1 class='title'>未提供有效的 ID！&nbsp;&nbsp;<a href='myArticle.php'>返回</a></h1>";
                    exit;
                }
                // 关闭数据库连接
                $conn->close();
            ?>
            <!--  -->
            <div class="form__container" >        
                <form class="form" id="revise_form" action="upgrateArticle.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="article_id" name="article_id" value=<?php echo $article_id; ?>>
                    <div class="form__input">
                        <label for="image">選擇新圖片</label>
                        <p class="old-data" id="old-image">原圖片:<?php echo $image_url; ?></p>
                        <input type="file" id="image" name="image" accept="image/* value=<?php echo $image_url; ?>">
                    </div>
                    <div class="form__input">
                        <label for="article_title">修改標題</label>
                        <input type="text" id="article_title" name="article_title" placeholder="請輸入標題" value="<?php echo $article_title; ?>" required>
                    </div>
                    <div class="form__input">
                        <label for="company_name">修改企業名稱</label>
                        <input type="text" id="company_name" name="company_name" placeholder="請輸入企業名稱" value="<?php echo $company_name; ?>" required>
                    </div>
                    <div class="form__input">
                        <label for="industry_input">修改產業種類</label>
                        <div class="dropdown">
                            <input type="text" id="industry_input" name="industry_input" placeholder="搜尋或選取產業種類" value="<?php echo $industry; ?>" required>
                            <div id="dropdown_list" class="dropdown-list"></div>
                        </div>
                    </div>
                    <div class="form__input">
                        <label for="start_date">修改開始時間</label>
                        <input type="date" id="start_date" name="start_date" value="<?php echo ($start_date !== '0000-00-00' && !empty($start_date)) ? $start_date : ''; ?>" required>
                    </div>
                    <div class="form__input">
                        <label for="end_date">修改結束時間</label>
                        <input type="date" id="end_date" name="end_date" value="<?php echo ($end_date !== '0000-00-00' && !empty($end_date)) ? $end_date : ''; ?>" required>
                    </div>
                    <div class="form__input">
                        <label for="article_content">修改內容</label>
                        <textarea id="article_content" name="article_content" placeholder="請輸入內容" required><?php echo $article_content; ?></textarea>
                    </div>
                    <div class="form__input">
                        <label for="file">修改附加檔案</label>
                        <?php
                            echo isset($attachment_url) ? "<p class='old-data' id='old-attachment'>原附加檔案".$attachment_url."</p>" : "<p class='old-data' id='old-attachment'>無附加檔案紀錄</p>";
                        ?>
                        <input type="file" id="file" name="file">
                    </div>
                    <div class="submitOrCancel">
                        <div class="btn__margin">
                            <a href="myArticle.php"><button class="btn" type="button">取消</button></a>
                        </div> 
                        <div class="btn__margin">
                            <button class="btn" id="reviseArticleBtn" type="button">上傳</button>
                        </div> 
                    </div>   
                </form>        
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
            <h1 class="title">修改上傳報告書</h1>
            <!-- 自動獲取文章資料 -->
            <?php
                require_once("db.php");
                if (isset($_GET['article_id'])) {
                  $article_id = $_GET['article_id'];
                  $stmt = $conn->prepare("SELECT * FROM articles WHERE article_id = ?");
                  $stmt->bind_param("s", $article_id);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  if ($row = $result->fetch_array()) {
                      $article_title = $row['title'];
                      $article_content = $row['content'];
                      $industry = $row['industry'];
                      $attachment_url = $row['attachment_url'];
                      $image_url = $row['image_url'];
                  } else {
                      echo "<script>alert('未提供有效的 ID！');window.location.href='myArticle.php';</script>";
                      exit;
                  }
                } else {
                    echo "<h1 class='title'>未提供有效的 ID！&nbsp;&nbsp;<a href='myArticle.php'>返回</a></h1>";
                    exit;
                }
                // 关闭数据库连接
                $conn->close();
            ?>
            <!--  -->
            <div class="form__container" >        
                <form class="form" id="revise_form" action="upgrateArticle.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="article_id" name="article_id" value=<?php echo $article_id; ?>>
                    <div class="form__input">
                        <label for="image">選擇新圖片</label>
                        <p class="old-data" id="old-image">原圖片:<?php echo $image_url; ?></p>
                        <input type="file" id="image" name="image" accept="image/* value=<?php echo $image_url; ?>">
                    </div>
                    <div class="form__input">
                        <label for="article_title">修改標題</label>
                        <input type="text" id="article_title" name="article_title" placeholder="請輸入標題" value="<?php echo $article_title; ?>" required>
                    </div>
                    <div class="form__input">
                        <label for="industry_input">修改產業種類</label>
                        <div class="dropdown">
                            <input type="text" id="industry_input" name="industry_input" placeholder="搜尋或選取產業種類" value="<?php echo $industry; ?>" required>
                            <div id="dropdown_list" class="dropdown-list"></div>
                        </div>
                    </div>
                    <div class="form__input">
                        <label for="article_content">修改內容</label>
                        <textarea id="article_content" name="article_content" placeholder="請輸入內容" required><?php echo $article_content; ?></textarea>
                    </div>
                    <div class="form__input">
                        <label for="file">修改附加檔案</label>
                        <?php
                            echo isset($attachment_url) ? "<p class='old-data' id='old-attachment'>原附加檔案".$attachment_url."</p>" : "<p class='old-data' id='old-attachment'>無附加檔案紀錄</p>";
                        ?>
                        <input type="file" id="file" name="file">
                    </div>
                    <div class="submitOrCancel">
                        <div class="btn__margin">
                            <a href="myArticle.php"><button class="btn" type="button">取消</button></a>
                        </div> 
                        <div class="btn__margin">
                            <button class="btn" id="reviseArticleBtn" type="button">上傳</button>
                        </div> 
                    </div>   
                </form>        
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