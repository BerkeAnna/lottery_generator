<?php

class LotteryController
{
    public function generate()
    {
        $numBalls = 6;

        $lottery = new Lottery($numBalls);

        $winningNumbers= $lottery->getWinningNumbers();

        include 'view/Lottery.php';
    }

}