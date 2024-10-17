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
            <label for="money">請輸入金額</label>
            <input type="text" id="money" name="money" placeholder="請輸入金額" required>
        </div>
        <div>
            <label for="fifty">是否需要50元</label>
            <select id="fifty" name="fifty" required>
                <option value="yes" selected>(預設是)</option>
                <option value="yes">是</option>
                <option value="no">否</option>
            </select>
        </div>
        <div>
            <label for="ten">是否需要10元</label>
            <select id="ten" name="ten" required>
                <option value="yes" selected>(預設是)</option>
                <option value="yes">是</option>
                <option value="no">否</option>
            </select>
        </div>
        <div>
            <label for="fire">是否需要5元</label>
            <select id="fire" name="fire" required>
                <option value="yes" selected>(預設是)</option>
                <option value="yes">是</option>
                <option value="no">否</option>
            </select>
        </div>
        <div>
            <span>一元視情況而定</span>
        </div>
        <div>
            <button type="submit">送出</button>
        </div> 
    </form>
</body>
</html>