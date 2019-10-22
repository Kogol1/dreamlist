@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <h2>Basic Stats</h2>
        <table class="table table-dark table-sm table-striped table-bordered mt-4">
            <tr>
                <th>Number of accomplished dreams</th>
                <td>{{$done}}</td>
            </tr>
            <tr>
                <th>Number of not yet accomplished dreams</th>
                <td>{{$not_done}}</td>
            </tr>
            <tr>
                <th>Number of removed dreams</th>
                <td>{{$deleted}}</td>
            </tr>
            <tr>
                <th>Count of total insertation</th>
                <td>{{$done + $not_done + $deleted}}</td>
            </tr>
            <tr>
                <th>Ration of accomplished/ not yet accomplished</th>
                <td>{{$kd_ratio}}</td>
            </tr>

        </table>
        <div id="piechart"></div>

    </div>
    <div class="container">
<div class="row">
    <div class="col-6">
        <h2>Number of dreams fulfilled in months</h2>
        <table class="table table-dark table-sm table-striped table-bordered mt-4">
            <tr>
                <th>Month</th>
                <th>Dreams fulfilled</th>
            </tr>
            @php
                $i = 0;
            @endphp
            @foreach($dreams_done_by_month_ammount_array as $month)
                @php
                $i = $i + 1;
                @endphp
                <tr>
                    <td>{{ Carbon\Carbon::createFromFormat('m', $i)->monthName }}</td>
                    <td>{{$month}}</td>
                </tr>
            @endforeach
        </table>

    </div>
    <div class="col-6">
        <h2>Number of dreams created in months</h2>
        <table class="table table-dark table-sm table-striped table-bordered mt-4">
            <tr>
                <th>Month</th>
                <th>Dreams created</th>
            </tr>
            @php
                $i = 0;
            @endphp
            @foreach($dreams_create_by_month_ammount_array as $month)
                @php
                    $i = $i + 1;
                @endphp
                <tr>
                    <td>{{ Carbon\Carbon::createFromFormat('m', $i)->monthName }}</td>
                    <td>{{$month}}</td>
                </tr>
            @endforeach
        </table>



    </div>
</div>
        <table class="table table-dark table-sm table-striped table-bordered mt-4">
            <tr>
                <th>Average time (in days) from dream creation to its fulfilment</th>
                <td>{{$average}} days</td>
            </tr>
            <tr>
                <th>Oldest unfulfiled dream + time from creation</th>
                <td>{{$oldestUndone->title}} | {{$oldestUndone_difference}}</td>
            </tr>
            <tr>
                <th>The fastest dream come true + time from creation to its fulfilment</th>
                <td>{{$fastestDream->title}} | {{$fastestDream->delta_time}} hours</td>
            </tr>
            <tr>
                <th>The slowest dream come true + time from creation to its fulfilment</th>
                <td>{{$slowestDream->title}} | {{$slowestDreamTime}}</td>
            </tr>
        </table>
    </div>

    <script type="text/javascript">
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['accomplished', {{$done}}],
                ['not yet accomplished', {{$not_done}}]
            ]);

            var options = {
                title: 'Ration of accomplished/ not yet accomplished',
                pieHole: 0.6,
                width: '100%',
                height: '500px'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawMultSeries);

        function drawMultSeries() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Done');
            data.addColumn('number', 'Created');

            data.addRows([
                    @php
                        $ii = 0;
                    @endphp
                    @foreach($dreams_done_by_month_ammount_array as $month)
                    @php
                        $ii = $ii + 1;
                    @endphp
                    ['{{ Carbon\Carbon::createFromFormat('m', $ii)->monthName }}',{{$month}},  2],

                @endforeach


            ]);

            var options = {
                title: 'Motivation and Energy Level Throughout the Day',
                hAxis: {
                    title: 'Time of Day',
                    viewWindow: {
                        min: [1],
                        max: [12]
                    }
                },
                vAxis: {
                    title: 'Rating (scale of 1-10)'
                }
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>

@endsection
