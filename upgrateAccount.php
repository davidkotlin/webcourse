<!-- 管理員的更新 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    try{
        require_once("db.php");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $accont_id = $_POST["id"];
            $account_name = $_POST["name"];
            $account_email = $_POST["account"];
            $account_role = $_POST["role"];
            if(!empty($accont_id) && !empty($account_name) && !empty($account_email) && !empty($account_role)){
                // 更新資料
                $stmt = $conn->prepare("UPDATE account_info SET account_name = ?, account_email = ?, account_role = ? WHERE account_id = ?");
                $stmt->bind_param("sssi", $account_name, $account_email, $account_role, $accont_id);
                if ($stmt->execute()) {
                    header("Location: managingAccount.php");
                    exit();
                } else {
                    echo "資料更新失敗: " . $stmt->error . "<br><a href='managingAccount.php'>返回</a>";
                }
                $stmt->close();
            }
        }
    } catch (Exception $e) {
        // 捕捉例外並顯示錯誤訊息
        echo "錯誤: " . $e->getMessage();
    } finally {
        // 關閉資料庫連線
        $conn->close();
    }
?>
</body>
</html>