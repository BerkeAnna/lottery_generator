<!DOCTYPE html>
<html>
<head>
    <title>Lottery number generator</title>
    <link rel="stylesheet" href="../style/style.css"/>
</head>
<body>

<?php

require_once '../controller/LotteryController.php';
require_once '../model/Lottery.php';
$nums=0;
$maxNums=0;
$jackpotTwoNums=0;
if (isset($_POST["submit"])) {
        $lottery = $_POST['lottery'];
        if($lottery== 'otos'){
            $nums=5;
            $maxNums = 90;
        }elseif ($lottery == 'hatos'){
            $nums=6;
            $maxNums = 45;
        }elseif ($lottery == 'euroJackpot'){
            $nums=5;
            $maxNums = 50;
            $jackpotTwoNums =2;
        }

}

$lottery = new LotteryController();
$res = $lottery->generate($nums, $maxNums);
$jackPotNums = $lottery->generate($jackpotTwoNums, 10);
$data = $lottery->readEarlierData($maxNums);
$count = $lottery->count($maxNums);
$sortedList = $lottery->sortedList($maxNums);
$drawnMostOfTime = $sortedList[89];
$drawnLastOften = $sortedList[0];
$fiveNumberMostOfTime = [$sortedList[0], $sortedList[1], $sortedList[2], $sortedList[3], $sortedList[4]];
$numberMostOfTime=0;
$numberLastOften=0;
?>

    <h1>Winning Numbers</h1>
<table>
    <tr>
        <th>Number</th>
        <th>The number was drawn X times</th>
        <th>ratio</th>
    </tr>
        <?php foreach ($res as $number): ?>
            <tr>
                <td class="numbers"><?php echo $number;?></td>
                <td><?php echo $data[$number]; ?></td>
                <td><?php echo round((($data[$number]/$count)*100),2); ?> %</td>
            </tr>
        <?php endforeach; ?>
</table>

<?php
?>
    <ul>
        <?php foreach ($jackPotNums as $number): ?>
            <ol><?php echo $number; ?></ol> <?php echo $data[$number]; ?>
        <?php endforeach; ?>
    </ul>


<div class="center">
    <button onclick="window.location.href = '../view/index.php';">
        *** Generate new numbers ***
    </button>
<!--    adott hét $data[i], azok számai $data[i][0-4]-->
<!--    $data[7] hetes szám: 198* fordult elő-->
    <!--    $data[49] hetes szám: 199* fordult elő-->
<!--    --><?php //echo $data[49]; ?>
</div>

<?php for($i=1 ; $i<sizeof($data); $i++)
            {
               if($data[$i]==$drawnLastOften ){
                   $numberLastOften=$i;
               }
                if($data[$i]==$drawnMostOfTime ){
                    $numberMostOfTime=$i;
                }
            }
?>

<div>
    todo:  a hatos, jPra megnézni, hogy ott jól generál
    <h4>Legkevesebbszer kihúzott (<?php echo $drawnLastOften; ?>x) : <?php  echo $numberLastOften ?> </h4>
    <h4>Legtöbbször kihúzott (<?php echo $drawnMostOfTime; ?>x) : <?php  echo $numberMostOfTime ?></h4>


</div>
</body>
</html>


