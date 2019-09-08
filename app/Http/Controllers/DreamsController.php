<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Dream;
use Carbon\Carbon;

class DreamsController extends Controller
{
    public function index()
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

    public function stats()
    {
        $doneCount = Dream::where('done', '!=', NULL)->count();
        $notDoneCount = Dream::where('done', NULL)->count();
        $deleteCount = Dream::onlyTrashed()->count();

        $dreams = Dream::all();

        //Dream done by month
        $dreams_done_by_month = Dream::select('id', 'done')->where('done', '!=', NULL)->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->done)->format('m'); // grouping by months
            });
        $dreams_done_by_month_ammount = [];
        $dreams_done_by_month_ammount_array = [];
        foreach ($dreams_done_by_month as $key => $value) {
            $dreams_done_by_month_ammount[(int)$key] = count($value);
        }
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($dreams_done_by_month_ammount[$i])) {
                $dreams_done_by_month_ammount_array[$i] = $dreams_done_by_month_ammount[$i];
            } else {
                $dreams_done_by_month_ammount_array[$i] = 0;
            }
        }
        //Dream create by month
        $dreams_create_by_month = Dream::select('id', 'created_at')->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->done)->format('m'); // grouping by months
            });
        $dreams_create_by_month_ammount = [];
        $dreams_create_by_month_ammount_array = [];
        foreach ($dreams_create_by_month as $key => $value) {
            $dreams_create_by_month_ammount[(int)$key] = count($value);
        }
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($dreams_create_by_month_ammount[$i])) {
                $dreams_create_by_month_ammount_array[$i] = $dreams_create_by_month_ammount[$i];
            } else {
                $dreams_create_by_month_ammount_array[$i] = 0;
            }
        }
        $a = array ('done', 'create');
        $e = array_combine($a, array($dreams_done_by_month_ammount_array,$dreams_create_by_month_ammount_array) );
        //dd($e);
        return view('stats')
            ->with('kd_ratio', number_format(($dreams->where('done')->count()) / ($notDoneCount), 2, '.', ' '))
            ->with('done', $doneCount)
            ->with('not_done', $notDoneCount)
            ->with('deleted', $deleteCount)
            ->with('dreams_done_by_month_ammount_array', $dreams_done_by_month_ammount_array)
            ->with('dreams_create_by_month_ammount_array', $dreams_create_by_month_ammount_array);
            //->with('e', $e);



  }

}
