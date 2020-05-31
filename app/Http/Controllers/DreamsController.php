<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        Auth::user()->dreams()->attach($dream->id);

        return redirect('/');
    }

    /**
     * @param Dream $dream
     */
    public function toggle(Dream $dream)
    {
        if ($dream->users->contains(Auth::user())){
            if ($dream->done == NULL) {
                $dream->done = Carbon::now()->toDateTimeString();
            } else {
                $dream->done = NULL;
            }
            $dream->update();
           return redirect()->route('home');
    }
        abort(403);
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

    public function show()
    {

    }


    /**
     * @param Dream $dream
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Dream $dream)
    {
        if ($dream->users->contains(Auth::user())) {
            $dream->delete();
            return redirect()->route('home');
        }
        return abort(401);
    }

}
