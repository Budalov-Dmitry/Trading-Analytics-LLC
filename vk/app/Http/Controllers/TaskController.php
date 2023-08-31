<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class TaskController extends Controller
{
    public function index()
    {
        return view('task');
    }

    public function import()
    {
        $resp = Http::get('https://randomuser.me/api/?results=5000');

        $result = $resp->json();
        $people = [];
//      ф-ция map() более затратна по памяти поэтому я предпочёл цикл
        foreach ($result['results'] as $item)
        {
            $people[] = [
                'first_name' => $item['name']['first'],
                'last_name' => $item['name']['last'],
                'email' => $item['email'],
                'age' => $item['dob']['age'],
            ];
        }

//        В данном случаи такой способ добавления был бы более правильным но как вытащить ответ базы с кол-вом затронутых строк необходимых по заданию я не знаю
//        $import = collect($people)
//            ->chunk(1000)
//            ->each(function (Collection $chunk) {
//                People::upsert($chunk->all(), ['first_name', 'last_name'], ['email','age']);
//            });

        $import = People::query()
            ->upsert($people, ['first_name', 'last_name'], ['email','age']);

//       Подсчёт результатов запроса необходимые по заданию релевантно только для MSQL
        $total = People::count();
        $renew = $import - 5000; //5000 это кол-во запрашиваемых пользователей оно установленно заданием поэтому я не вижу смысла в использовании переменной
        $added = 5000 - $renew;

        return response()->json(['total' => $total, 'added' => $added, 'renew' => $renew]);
    }
}
