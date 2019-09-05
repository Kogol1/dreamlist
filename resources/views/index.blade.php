@extends('layouts.app')

@section('content')

    <div class="container text-center mt-4">
        <center>
            <h3>Přidat další</h3>
            <div class="col-sm-8">
                {{Form::open(['action' => 'DreamsController@store', 'method' => 'POST', 'autocomplete' => 'off'])}}
                <div class="row">
                    <div class="col-9">
                        {{Form::text('title', '', [ 'class' => 'form-control', 'placeholder' => 'Můj sen'])}}
                    </div>
                    <div class="col-3">
                        {{Form::submit('Přidat', ['class' => 'form-control btn text-white', 'style' => 'background-color: #009688'])}}
                    </div>
                </div>


                {{ Form::close() }}

                <div class="mt-4">
                    <h3>Nesplněno <i class="fas fa-caret-right"></i> {{$not_done}}</h3>
                    <table class="table table-striped">
                        @if(isset($dreams) && !$dreams->isEmpty())
                            @foreach($dreams as $dream)
                                <tr>

                                    <td>
                                        <a href="/update/{{$dream->id}}"><span class="far fa-square text-black"></span></a>
                                    </td>
                                    <td>{{$dream->title}} </td>
                                    <td>{{ \Carbon\Carbon::parse($dream->created_at)->format('d. m. Y')}}</td>
                                    <td><a href="/destroy/{{$dream->id}}"><span class="fas fa-trash-alt"></span></td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>


                <!-- Splněno-->
                <h3 class="mt-4">Splněno <i class="fas fa-caret-right"></i> {{$done}}</h3>
                <table class="table table-striped">
                    @foreach($dreams2 as $dream2)
                        <tr>
                            <td><a href="/update/{{$dream2->id}}"><i class="fas fa-check-square"></i></td>
                            <td>{{$dream2->title}} </td>
                            <td>{{ \Carbon\Carbon::parse($dream2->done)->format('d. m. Y')}}</td>
                            <td><a href="/destroy/{{$dream2->id}}"><span class="fas fa-trash-alt"></span></td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </center>
    </div>

@endsection