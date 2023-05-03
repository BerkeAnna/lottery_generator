<?php

class LotteryController
{
    public function generate($numBalls, $maxNums)
    {

        $lottery = new Lottery($numBalls, $maxNums);

        $winningNumbers= $lottery->getWinningNumbers();

        return $winningNumbers;
    }

    public function readEarlierData($maxNum)
    {
        $filePath = __DIR__ . '/../csvFile/otos.csv'; // use an absolute file path
        $rows = [];
        $numbers = range(1, $maxNum);
        $occurrences = array_fill(1, $maxNum, 0);
        $count=0;

        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $selectedColumns = array_slice($data, 11, 5);
                $rows[] = $selectedColumns;
            }
            fclose($handle);
        }
        $list = array_map('implode', array_fill(0, count($rows), ','), $rows);

        foreach ($rows as $row) {
            foreach ($row as $number) {
                $number = (int) $number;
                if ($number >= 1 && $number <= $maxNum) {
                    $occurrences[$number]++;
                    $count++;
                }
            }

        }

        return $occurrences;
    }

    //the number of drawn -17260
    public function count($maxNum)
    {
        $datas = $this->readEarlierData($maxNum);
        $count=0;
        foreach ($datas as $data) {
            $count= $count + $data;
        }
        return $count;
    }

    public function sortedList($maxNum)
    {
        $datas = $this->readEarlierData($maxNum);

         sort($datas);

        return $datas;
    }


}