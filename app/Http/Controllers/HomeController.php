<?php

namespace App\Http\Controllers;

use App\Models\In;
use App\Models\Out;
use App\Models\PlanOut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private $modelPath = 'App\Models\\';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // get all months
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = Carbon::createFromFormat('m', $i)->format('F');
        }
        if (Session::has('month')) {
            $currentMonthId = (int)$request->session()->get('month');
        } else {
            $currentMonthId = (int)Carbon::now()->format('m');
        }

        // request change month
        if (request()->post('month')) {
            Session::put('month', request()->post('month'));
            return response()->json(['message' => request()->post('month')]);
        }

        // get data from in, plan_out, out
        $in = In::whereMonth('date', $currentMonthId)->get();
        $planOut = PlanOut::whereMonth('date', $currentMonthId)->get();
        $out = Out::whereMonth('date', $currentMonthId)->get();

        // get each sum
        $sum = [];
        $sum['in'] = $in->sum('sum');
        $sum['plan_out'] = $planOut->sum('sum');
        $sum['out'] = $out->sum('sum');

        $balanceFact = $sum['in'] - $sum['out'];

        // request add data
        if (request()->post('dataType')) {
            $result = $this->saveData(request());
            return response()->json(['message' => $result ? 'ok' : 'fail']);
        }

        return view('home', [
            'months'         => collect($months),
            'currentMonthId' => $currentMonthId,
            'in'             => $in,
            'planOut'        => $planOut,
            'out'            => $out,
            'sum'            => $sum,
            'balanceFact'    => $balanceFact,
        ]);
    }

    private function saveData($data)
    {
        $className = $this->modelPath . $this->camelize($data->dataType);
        $model = new $className;

        $newData = $model::create([
            'title' => $data->title,
            'date' => Carbon::createFromFormat('d/m/Y', $data->date),
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
