@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <h2>Základní Statistiky</h2>
        <table class="table table-dark table-sm table-striped table-bordered mt-4">
            <tr>
                <th>Počet splněných</th>
                <td>{{$done}}</td>
            </tr>
            <tr>
                <th>Počet nesplněných</th>
                <td>{{$not_done}}</td>
            </tr>
            <tr>
                <th>Poměr splněných/nesplněných</th>
                <td>{{$kd_ratio}}</td>
            </tr>
        </table>
    </div>

    <div class="container mt-4">
        <h2>Počet splněných snů v měsících</h2>
    </div>


@endsection