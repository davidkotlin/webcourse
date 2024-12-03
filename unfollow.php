<?php
ob_start();
session_start();
try {
    require_once("db.php");
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "無效的 JSON 數據"]);
            exit();
        }
        if (isset($data["article_id"]) && isset($_SESSION["user_id"])) {
            $stmt = $conn->prepare("DELETE FROM follows WHERE account_id = ? AND article_id = ?");
            $stmt->bind_param("is", $_SESSION["user_id"], $data["article_id"]);
            if ($stmt->execute()) {
                ob_clean();
                header("Content-Type: application/json");
                echo json_encode(["success" => true, "message" => "取消關注成功"]);
            } else {
                ob_clean();
                header("Content-Type: application/json");
                echo json_encode(["success" => false, "message" => "取消關注失敗: " . $stmt->error]);
            }
            $stmt->close();
        }
    }
} catch (Exception $e) {
    ob_clean();
    header("Content-Type: application/json");
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
} finally {
    $conn->close();
}
?>
