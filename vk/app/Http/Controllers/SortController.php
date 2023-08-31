<?php

namespace App\Http\Controllers;

use App\Contracts\Sort;
use Illuminate\Http\Request;

class SortController extends Controller
{
    public  function sort(Sort $service)
    {
        $array = [111, 5, 6, 8, 2, 2, 0, 3, 4, 9, 7];

        $sortArray = $service->sort($array);

        echo $sortArray;
    }
}
