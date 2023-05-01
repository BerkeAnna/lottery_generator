<?php

class Lottery
{
    private $winningNumbers = [];


    public function __construct($numBalls)
    {
        $numbers = range(1,50);

        shuffle($numbers);

        $this->winningNumbers = array_slice($numbers, 0, $numBalls);

        sort($this->winningNumbers);

    }

    public function getWinningNumbers()
    {
        return $this->winningNumbers;
    }


}