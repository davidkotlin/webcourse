<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="test2.php" method="get">
        <div>
            <label for="tall">請輸入身高</label>
            <input type="text" id="tall" name="tall" placeholder="請輸入身高" required>
        </div>
        <div>
            <label for="weight">請輸入體重</label>
            <input type="text" id="weight" name="weight" placeholder="請輸入體重" required>
        </div>
        <div>
            <label for="sex">請輸入性別</label>
            <select id="sex" name="sex" required>
                <option value="" disabled selected>請選擇性別</option>
                <option value="male">男</option>
                <option value="female">女</option>
            </select>
        </div>
        <div>
            <button type="submit">送出</button>
        </div> 
    </form>
</body>
</html>