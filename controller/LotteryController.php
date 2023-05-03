<?php

class LotteryController
{
    public function generate($numBalls, $maxNums)
    {

        $lottery = new Lottery($numBalls, $maxNums);

        $winningNumbers= $lottery->getWinningNumbers();

        return $winningNumbers;
    }

    public function readEarlierDatas()
    {
        $csvFile = '../csvFile/otos.csv';
        $handle = fopen($csvFile, 'r');

        while(($data = fgetcsv($handle,1000,';')) != false){
            foreach ($data as $value) {
                echo $value . ' ';
            }
            echo "\n";
        }
        fclose($handle);
    }

}