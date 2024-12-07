<?php
session_start();
try {
    require_once("db.php");
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // 取得 POST 資料
        $article_id = $_POST["article_id"];
        $title = $_POST["article_title"];
        $content = $_POST["article_content"];
        $industry = $_POST["industry_input"];
        $company_name = $_POST["company_name"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $image_url = $_FILES["image"];
        $attachment_url = $_FILES['file'];
        // 圖片目錄與檔案目錄
        $image_dir = 'uploads/images/';
        $file_dir = 'uploads/files/';
        if (!is_dir($image_dir)) mkdir($image_dir, 0777, true); // 如果目錄不存在則自動建立
        if (!is_dir($file_dir)) mkdir($file_dir, 0777, true); // 如果目錄不存在則自動建立
        // 查詢該 article_id 的現有資料
        $stmt = $conn->prepare("SELECT * FROM articles WHERE article_id = ?");
        $stmt->bind_param("s", $article_id);
        $stmt->execute();
        $result = $stmt->get_result();      
        // 如果找到對應的文章
        if ($row = $result->fetch_array()) {
            // 判斷是否需要更新
            $update_query = "UPDATE articles SET ";
            $params = [];
            $types = "";          
            // 如果某欄位不為空且有變動，進行更新
            if (!empty($title) && $title !== $row['title']) {
                $update_query .= "title = ?, ";
                $params[] = $title;
                $types .= "s";
            }
            if (!empty($content) && $content !== $row['content']) {
                $update_query .= "content = ?, ";
                $params[] = $content;
                $types .= "s";
            }
            if (!empty($industry) && $industry !== $row['industry']) {
                $update_query .= "industry = ?, ";
                $params[] = $industry;
                $types .= "s";
            }
            if (!empty($company_name) && $company_name !== $row['company_name']) {
                $update_query .= "company_name = ?, ";
                $params[] = $company_name;
                $types .= "s";
            }
            if (!empty($start_date) && $start_date !== $row['start_date']) {
                $update_query .= "start_date = ?, ";
                $params[] = $start_date;
                $types .= "s";
            }
            if (!empty($end_date) && $end_date !== $row['end_date']) {
                $update_query .= "end_date = ?, ";
                $params[] = $end_date;
                $types .= "s";
            }
            // 處理檔案上傳
            if ($image_url && $image_url['error'] === UPLOAD_ERR_OK) {
                $image_path = $image_dir . uniqid('img_') . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                if (move_uploaded_file($image_url['tmp_name'], $image_path)) {
                    $update_query .= "image_url = ?, ";
                    $params[] = $image_path;
                    $types .= "s";
                }
            }
            $file_url = null;
            if ($attachment_url && $attachment_url['error'] === UPLOAD_ERR_OK) {
                $file_path = $file_dir . uniqid('file_') . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if (move_uploaded_file($attachment_url['tmp_name'], $file_path)) {
                    $update_query .= "attachment_url = ?, ";
                    $params[] = $file_path;
                    $types .= "s";
                }
            }

            // 如果有任何欄位需要更新
            if (count($params) > 0) {
                // 去掉多餘的逗號
                $update_query = rtrim($update_query, ", ") . " WHERE article_id = ?";
                $params[] = $article_id;
                $types .= "s";
                // 准備並執行更新操作
                $stmt = $conn->prepare($update_query);
                $stmt->bind_param($types, ...$params);
                $stmt->execute();
                header("Location: myArticle.php");
                exit();
            } else {
                echo "資料更新失敗: " . $stmt->error . "<br><a href='myArticle.php'>返回</a>";
            }
        } else {
            echo "未找到該文章！";
        }
        // 關閉資料庫連接
        $stmt->close();
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
} finally {
    // 確保連接在最後關閉
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
}
?>
