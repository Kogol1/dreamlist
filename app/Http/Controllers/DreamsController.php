<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Dream;
use Carbon\Carbon;

class DreamsController extends Controller
{
    public function index(Request $request)
    {
        $dreams = Dream::orderBy('id', 'asc')->where('done', NULL)->get();
        $dreams2 = Dream::orderBy('done', 'asc')->where('done', '!=', NULL)->get();
        return view('index')
            ->with('dreams', $dreams)
            ->with('dreams2', $dreams2)
            ->with('done', Dream::where('done', '!=', NULL)->count())
            ->with('not_done', Dream::where('done', NULL)->count());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        //Vytvořit nový sen :)
        $dream = new Dream;
        $dream->fill($request->all());
        $dream->save();

        return redirect('/');
    }

    public function update($id)
    {
        $dream = Dream::find($id);
        if ($dream->done == NULL) {
            $dream->done = Carbon::now()->toDateTimeString();
        } else {
            $dream->done = NULL;
        }
        $dream->update();
        return redirect('/');
    }

    public function destroy($id)
    {
        $dream = Dream::find($id);
        $dream->delete();
        return redirect('/');
    }

    public function stats(Request $request)
    {
        $doneCount = Dream::where('done', '!=', NULL)->count();
        $notDoneCount = Dream::where('done', null)->count();

        $dreams = Dream::all();

        $dreamMonths = $dreams->groupBy('month');
        foreach ($dreamMonths as $month => $items){
            $array = [
                $month => [
                    'count' => $items->where('done')->count(),
                    'count1' => $items->where('done')->count(),
                ],
            ];
        }


        return view('stats')
            ->with('kd_ratio', number_format(($dreams->where('done')->count()) / ($notDoneCount),2,'.',' '))
            ->with('done', $doneCount)
            ->with('not_done', $notDoneCount);
    }

}
