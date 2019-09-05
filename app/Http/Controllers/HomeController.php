<?php

namespace App\Http\Controllers;

use App\Models\In;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $modelPath = 'App\Models\\';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // get all months
        $months = collect();
        for ($i = 1; $i <= 12; $i++) {
            $months->push(Carbon::createFromFormat('m', $i)->format('F'));
        }
        $currentMonthId= (int)Carbon::now()->format('m');

        if (request()->ajax()) {
            $result = $this->saveData(request());
            return response()->json(['message' => $result ? 'ok' : 'fail']);
        }

        return view('home', [
            'months' => $months,
            'currentMonthId' => $currentMonthId,
        ]);
    }

    private function saveData($data)
    {
        $className = $this->modelPath . $this->camelize($data->dataType);
        $model = new $className;

        $newData = $model::create([
            'title' => $data->title,
            'date' => Carbon::parse($data->date)->format('Y-m-d'),
            'sum' => $data->sum,
            'user_id' => Auth::id(),
        ]);

        return $newData ? true : false;
    }

    private function camelize($input, $separator = '_')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }
}
