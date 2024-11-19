<?php
ob_start(); // 开启输出缓冲区
session_start();
try {
    require_once("db.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            ob_clean(); // 清空缓冲区
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "无效的 JSON 数据"]);
            exit();
        }
        if (isset($data["userId"]) && isset($data["userEmail"])) {
            $stmt = $conn->prepare("UPDATE account_info SET account_email = ? WHERE account_id = ?");
            $stmt->bind_param("si", $data["userEmail"], $data["userId"]);

            if ($stmt->execute()) {
                ob_clean(); // 清空缓冲区
                header('Content-Type: application/json');
                echo json_encode(["success" => true, "message" => "Email 更新成功"]);
            } else {
                ob_clean();
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "message" => "資料更新失敗: " . $stmt->error]);
            }
            $stmt->close();
        }
        else if (isset($data["userId"]) && isset($data["userName"])) {
            $stmt = $conn->prepare("UPDATE account_info SET account_name = ? WHERE account_id = ?");
            $stmt->bind_param("si", $data["userName"], $data["userId"]);

            if ($stmt->execute()) {
                ob_clean(); // 清空缓冲区
                $_SESSION['user_name'] = $data["userName"];
                header('Content-Type: application/json');
                echo json_encode(["success" => true, "message" => "姓名更新成功"]);
            } else {
                ob_clean();
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "message" => "資料更新失敗: " . $stmt->error]);
            }
            $stmt->close();
        } 
        else if (isset($data["userId"]) && isset($data["userPassword"])) {
            $stmt = $conn->prepare("UPDATE account_info SET account_password = ? WHERE account_id = ?");
            $stmt->bind_param("si", $data["userPassword"], $data["userId"]);

            if ($stmt->execute()) {
                ob_clean(); // 清空缓冲区
                header('Content-Type: application/json');
                echo json_encode(["success" => true, "message" => "密碼更新成功"]);
            } else {
                ob_clean();
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "message" => "資料更新失敗: " . $stmt->error]);
            }
            $stmt->close();
        }
        else {
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "缺少必要的字段"]);
        }
    }
} catch (Exception $e) {
    ob_clean(); // 清空缓冲区
    header('Content-Type: application/json');
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
} finally {
    $conn->close();
}
?>