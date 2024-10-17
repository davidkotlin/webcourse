<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="fee.php" method="post">
        <div>
            會費:
            <input type="radio" name="membershipFee" value=1 /> 繳交
            <input type="radio" name="membershipFee" value=0 /> 不繳交
            
        <div>
        <div>
            活動:
            <input type="checkbox" name="program[]" value=0 /> 一日資管營
            <input type="checkbox" name="program[]" value=1 /> 迎新茶會
            <input type="checkbox" name="program[]" value=2 /> 迎新宿營
        </div>

            <input type="submit" value="確定" />

    </form>
</body>
</html>