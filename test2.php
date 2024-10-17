<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $money = $_GET['money'];
        $moneyInt = (int)$money;
        echo "輸入金額為".$moneyInt."元<br>";
        $fifty = $_GET['fifty'];
        $ten = $_GET['ten'];
        $fire = $_GET['fire'];
        
        $fiftyAmount ; 
        $tenAmount ;
        $fireAmount ;
        $remainder=$moneyInt;
        
        if($fifty == "yes"){
            $fiftyAmount = $moneyInt / 50;
            $fiftyAmount = (int)$fiftyAmount;
            $remainder = $moneyInt % 50;
            echo "50元需要".$fiftyAmount."個";
            if ($remainder > 0) {
                echo "一元需要" . $remainder . "個";
            }
        }
        else{
            $remainder = $moneyInt;
        }
        if($ten == "yes"){
            $tenAmount = $remainder / 10;
            $tenAmount = (int)$tenAmount;
            $remainder = $remainder % 10;
            echo "10元需要".$tenAmount."個";
            if ($remainder > 0) {
                echo "一元需要" . $remainder . "個";
            }
        }
        if($fire == "yes"){
            $fireAmount = $remainder / 5;
            $fireAmount = (int)$fireAmount;
            echo "5元需要".$fireAmount."個";
            if ($remainder > 0) {
                echo "一元需要" . $remainder . "個";
            }
        }
        
    ?>
    <br>
    <a href="test1.php">回首頁</a>
</body>
</html>