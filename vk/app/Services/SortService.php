<?php

namespace App\Services;

use App\Contracts\Sort;
use Illuminate\Support\Facades\Log;

class SortService implements Sort
{
    public function  sort(array $array)
    {

//        $value = 'value1';
//        if((int)$value == 0)
//        {
//            echo 1;
//        }

//        $shift = 111;
//        $count = count($array);
//
//        $shift = $shift % $count;
//
//        $item = array_splice($array,-$shift);
//
//        $result = array_merge($item,$array);
//        var_dump($result);


        $start = memory_get_usage();
        Log::info('Начало сортировки '.$start);
        for($i=0; $i<count($array); $i++){
            $count = count($array);
            for($j=$i+1; $j<$count; $j++){
                if($array[$i]>$array[$j]){
                    $temp = $array[$j];
                    $array[$j] = $array[$i];
                    $array[$i] = $temp;
                }
            }
        }

        $result = implode( ',' , $array);

        $end = memory_get_usage();
        Log::info('Конец сортировки '. $end);

        return $result;
    }

    public function myMagicSummator()
    {
        static $id = 0;
        $id++;
        echo $id;
    }
}
