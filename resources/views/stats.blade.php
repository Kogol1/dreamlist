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
                <th>Celkem zadaných snů</th>
                <td>{{$done + $not_done}}</td>
            </tr>
            <tr>
                <th>Smazaných snů</th>
                <td>#</td>
            </tr>
            <tr>
                <th>Poměr splněných/nesplněných</th>
                <td>{{$kd_ratio}}</td>
            </tr>
        </table>
        <div id="kd_ratio" style="width: 100%; min-height:450px;"></div>

    </div>

    <div class="container mt-4">
        <h2>Počet splněných snů v měsících</h2>
    </div>


    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Splněno', {{$done}}],
                ['Nesplněno', {{$not_done}}]
            ]);

            var options = {
                title: 'Poměr splněných/nesplněných snů',
                pieHole: 0.6,
            };

            var chart = new google.visualization.PieChart(document.getElementById('kd_ratio'));
            chart.draw(data, options);
        }
        $(window).resize(function(){
            drawChart();
        });
    </script>

@endsection