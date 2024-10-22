<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $num=[];
    for($i=1;$i<=6;$i++){
        $num[$i]=rand(1,10);
        for($j=1;$j<$i;$j++){
            if($num[$i]==$num[$j]){
                $i--;//相同的話，八股重新生
                break;
            }
        }
    }
    sort($num); 

    foreach($num as $result) {
        echo $result . "<br>"; 
    }
    // $num=range(1,100);
    // shuffle($num);
    // $resultNum=array_slice($num,0,6);
    // foreach($resultNum as $result){
    //     echo $result."<br>";
    // }
    ?>
</body>
</html>