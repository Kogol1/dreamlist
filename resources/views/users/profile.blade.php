@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="float-left"><i class="fas fa-user"></i> {{$user->email}}</h1><br><br><br>
        <div class="row">
            <div class="col-md-7 col-sm-12">{!! $dreamsChart->render() !!}</div>
            <div class="col-md-5 col-sm-12">
                <h5>Přidaných snů: {{ Auth::user()->getCountDreams(false, true) }}</h5>
                <h5>Zatím nesplněných snů: {{ Auth::user()->getCountDreams(false) }}</h5>
                <h5>Splněných snů: {{ Auth::user()->getCountDreams(true) }}</h5>
                <h5>Poměr splněných a nesplněnch snů: {{ Auth::user()->getDreamRatio() }}</h5>
            </div>
        </div>



    </div>


@endsection
