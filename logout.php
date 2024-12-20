<?php 
    session_start();
    session_unset(); // 清除所有會話變數
    session_destroy(); // 銷毀會話
    header("Location: index.php"); // 導回首頁
    exit();
?>