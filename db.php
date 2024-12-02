    <?php
       $host = 'localhost'; // 資料庫主機
       $dbname = 'internship'; // 請替換為您的資料庫名稱
       $username = 'root'; // 使用者名稱
       $password = ''; // 如果沒有密碼，則留空
       // 建立資料庫連線
       $conn = new mysqli($host, $username, $password, $dbname);
       // 檢查連線是否成功
       if ($conn->connect_error) {
           die("連線失敗: " . $conn->connect_error);
       } 
    ?>