<?php
	    $accountList = array( "student1" => "1", "student2" => "2", "student3" => "3");
	
	    $msg = $_GET["msg"] ?? "";
	
	    // 檢查是否取得POST內容
	    if ($_POST) { 
	        // 如果POST有內容，進行以下的登入檢查
	        $account = $_POST["account"] ?? "";
	        $password = $_POST["password"] ?? "";
            // 給定一組假帳密
            $defaultAccount = "123";
            $defaultPassword = "password";
	        // 驗證帳號和密碼是否匹配
	        if (isset($account) && $account === $defaultAccount && isset($password) && $defaultPassword === $password) {
	            // 如果匹配，跳轉到fee.html
	            header("Location: fee.php");
	            exit();
	        } else {
	            // 如果不匹配，跳轉回login.php並傳遞msg變數
	            header("Location: login.php?msg=帳號或密碼錯誤");
	            exit();
	        }
	    }
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="loginPractice.php" method="post">
	    帳號: <input type="text" name="account"><br>
	    密碼: <input type="password" name="password"><br>
	    <input type="submit" value="登入">
	    <?=$msg?>
	</form>
</body>
</html>
	