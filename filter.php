<?php
    ob_start();
    try {
        require_once("db.php");
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                ob_clean();
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "message" => "無效的 JSON 數據"]);
                exit();
            }
            if (isset($data["filterInput"])) {
                $stmt = $conn->prepare("SELECT * FROM articles WHERE industry LIKE ? ORDER BY created_at DESC");
                $filterTerm = "%" . $data["filterInput"] . "%";
                $stmt->bind_param("s", $filterTerm);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                if ($result->num_rows > 0) {
                    $searchResults = [];
                    while ($row = $result->fetch_array()) {
                        $searchResults[] = $row;
                    }
                    ob_clean();
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "searchResults" => $searchResults]);
                }
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