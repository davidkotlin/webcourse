<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $tall = $_GET['tall']/100;
        $weight = $_GET['weight'];
        $sex = $_GET['sex'];
        $BMI = $weight / ($tall * $tall);
        echo "你的身高:".$tall*100,"公分";
        echo "<br>你的體重:".$weight."公斤<br>你的BMI:".$BMI."<br>";
        if($sex == "male"){
            if($BMI < 17){
                echo "評語:身為男生，你的體重過輕<br>";
            }elseif($BMI < 23.2){
                echo "評語:身為男生，你的體重正常<br>";
            }elseif($BMI < 25.4){
                echo "評語:身為男生，你的體重過重<br>";
            }else{
                echo "評語:身為男生，你的體重肥胖<br>";
            }
        }elseif($sex == "female"){
            if($BMI < 17){
                echo "評語:身為女生，你的體重過輕<br>";
            }elseif($BMI < 22.7){
                echo "評語:身為女生，你的體重正常<br>";
            }elseif($BMI < 25.6){
                echo "評語:身為女生，你的體重過重<br>";
            }else{
                echo "評語:身為女生，你的體重肥胖<br>";
            }
        }
    ?>
    <a href="test1.php">回首頁</a>
</body>
</html>