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
?>

    <h1>Winning Numbers</h1>
    <ul>
        <?php foreach ($res as $number): ?>
            <ol><?php echo $number; ?></ol>
        <?php endforeach; ?>
    </ul>

<?php
?>
    <ul>
        <?php foreach ($jackPotNums as $number): ?>
            <ol><?php echo $number; ?></ol>
        <?php endforeach; ?>
    </ul>

<!--<h2><a href="index.php">*** Generate new numbers ***</a></h2>-->

<div class="center">
    <button onclick="window.location.href = '../view/index.php';">
        *** Generate new numbers ***
    </button>
</div>
</body>
</html>


