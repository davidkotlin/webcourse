<?php
ob_start();
session_start();
try {
    require_once("db.php");
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            ob_clean(); // 清空缓冲区
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "无效的 JSON 数据"]);
            exit();
        }
        if (isset($data["article_id"]) && isset($_SESSION["user_id"])) {
            $checkStmt = $conn->prepare("SELECT * FROM follows WHERE account_id = ? AND article_id = ?");
            $checkStmt->bind_param("is", $_SESSION["user_id"], $data["article_id"]);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            if ($checkResult->num_rows > 0) {
                // 已經關注，返回提示
                ob_clean();
                header("Content-Type: application/json");
                echo json_encode(["success" => false, "message" => "已經關注"]);
                exit();
            }
            // 插入新記錄
            $stmt = $conn->prepare("INSERT INTO follows (account_id, article_id) VALUES (?, ?)");
            $stmt->bind_param("is", $_SESSION["user_id"], $data["article_id"]);
            if ($stmt->execute()) {
                ob_clean();
                header("Content-Type: application/json");
                echo json_encode(["success" => true, "message" => "成功follow"]);
            } else {
                ob_clean();
                header("Content-Type: application/json");
                echo json_encode(["success" => false, "message" => "follow失敗: " . $stmt->error]);
            }
            $stmt->close();
        }     
    }
} catch (Exception $e) {
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
} finally {
    $conn->close();
}
?>