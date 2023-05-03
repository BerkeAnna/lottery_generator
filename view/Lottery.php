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
$name="";
if (isset($_POST["submit"])) {
        $lottery = $_POST['lottery'];
        if($lottery== 'otos'){
            $nums=5;
            $maxNums = 90;
            $name='otos';
            $column=11;
        }elseif ($lottery == 'hatos'){
            $nums=6;
            $maxNums = 45;
            $name='hatos';
            $column=14;
        }elseif ($lottery == 'euroJackpot'){
            $nums=5;
            $maxNums = 50;
            $jackpotTwoNums =2;
            $name='eurojackpot';
        }

}

$lottery = new LotteryController();
$res = $lottery->generate($nums, $maxNums);
$jackPotNums = $lottery->generate($jackpotTwoNums, 10);
$data = $lottery->readEarlierData($maxNums, $column,$nums);
$count = $lottery->count($maxNums, $column,$nums);
$sortedList = $lottery->sortedList($maxNums,$column,$nums);
$drawnMostOfTime = $sortedList[$maxNums-1];
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
<!--    <ul>-->
<!--        --><?php //foreach ($jackPotNums as $number): ?>
<!--            <ol>--><?php //echo $number; ?><!--</ol> --><?php //echo $data[$number]; ?>
<!--        --><?php //endforeach; ?>
<!--    </ul>-->


<div class="center">
    <button onclick="window.location.href = '../view/index.php';">
        *** Generate new numbers ***
    </button>
<!--    $data[7] hetes szám: 198* fordult elő-->
    <!--    $data[49] hetes szám: 199* fordult elő-->
<!--    A data visszaadja, hogy eddig hányszor húzták ki az "i".-dik számot. pl: data[1] az 1-es szám eddigi kihúzásainak száma-->
<!--    --><?php //echo $data[1]; ?>
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
    todo:  a hatos, jPra megnézni, hogy ott jól generál, csak az 5-öshöz van csv, ezért kapom ugyanazt xd
    <h4>Legtöbbször kihúzott (<?php echo $drawnMostOfTime; ?>x) : <?php  echo $numberMostOfTime ?></h4>
    <h4>Legkevesebbszer kihúzott (<?php echo $drawnLastOften; ?>x) : <?php  echo $numberLastOften ?> </h4>
    <h4>További legtöbbször kihúzott számok: </h4>
    <div class="list">
        <?php

        rsort($sortedList);

        for($i=1 ; $i<sizeof($data); $i++)
        {
            if($data[$i]==$sortedList[1] || $data[$i]==$sortedList[2] ||$data[$i]==$sortedList[3] || $data[$i]==$sortedList[4]
                    || $data[$i]==$sortedList[5]){
                echo $i . " (" .$data[$i] . "x)  </br>"  ;
            }

        }
        ?>
    </div>

    <h4>További legkevesebbszer kihúzott számok: </h4>
    <div class="list">
        <?php

        rsort($sortedList);

        for($i=1 ; $i<sizeof($data); $i++)
        {
            if($data[$i]==$sortedList[$maxNums-2] || $data[$i]==$sortedList[$maxNums-3]
                || $data[$i]==$sortedList[$maxNums-4] || $data[$i]==$sortedList[$maxNums-5] || $data[$i]==$sortedList[$maxNums-6] ){
                echo $i . " (" .$data[$i] . "x)  </br>"  ;
            }

        }
        ?>
    </div>

</div>
</body>
</html>


