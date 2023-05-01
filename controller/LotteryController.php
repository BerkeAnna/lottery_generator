<?php

class LotteryController
{
    public function generate($numBalls, $maxNums)
    {

        $lottery = new Lottery($numBalls, $maxNums);

        $winningNumbers= $lottery->getWinningNumbers();

        return $winningNumbers;
    }

}