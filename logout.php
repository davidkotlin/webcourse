<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/button.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <?php 
    session_start();
    session_unset(); // 清除所有會話變數
    session_destroy(); // 銷毀會話
    header("Location: index.php"); // 導回首頁
    exit();
    ?>
</body>
</html>