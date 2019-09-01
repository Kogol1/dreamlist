@extends('layouts.app')

@section('content')

<div class="w3-row">
        <div class="w3-col m4 l4">
          &nbsp;
        </div>
        <div class="w3-col s12 m4 l4">

          <div class="w3-container w3-teal text-center">
              <center>
            <h1 class="">My Dream List</h1>
                </center>
          </div><br><br>

        </div>
        <div class="w3-col s0 m4 l4">
              &nbsp;
        </div>
      </div>
      
      <div class="w3-row">
          <div class="w3-col s1 m4 l4">
            &nbsp;
          </div>
          <div class="w3-col s10 m4 l4">
            <!-- Přidat další-->
            <h3>Přidat další</h3>
      
            {{Form::open(['action' => 'DreamsController@store', 'method' => 'POST', 'autocomplete' => 'off'])}}
                <div class="w3-row-padding">
                <div class="w3-col" style="width:80%">
            {{Form::text('title', '', [ 'class' => 'w3-input w3-border', 'placeholder' => 'Můj sen'])}}
                </div>
                <div class="w3-col" style="width:10%">
            {{Form::submit('Přidat', ['class' => 'w3-button w3-teal'])}}
                </div>
                </div>

            {{ Form::close() }}
      
      <!--Nesplněno -->
          <h3>Nesplněno</h3>
            <table class="w3-table-all w3-centered">
                @if(isset($dreams) && !$dreams->isEmpty())
                @foreach($dreams as $dream)
                <tr>
                  
                  <td>
                    <a href="/update/{{$dream->id}}"><span class="far fa-square"></span></a></td>
                  <td>{{$dream->title}} </td>
                  <td><a href="/destroy/{{$dream->id}}"><span class="fas fa-trash-alt"></span></td>
                </tr>
                @endforeach
                @endif
            </table>
      
      
            <!-- Splněno-->
            <h3>Splněno</h3>
            <table class="w3-table-all w3-centered">

                    @foreach($dreams2 as $dream2)
                    <tr>
                      <td><a href="/update/{{$dream2->id}}"><i class="far fa-check-square"></i></td>
                      <td>{{$dream2->title}} </td>
                      <td><a href="/destroy/{{$dream2->id}}"><span class="fas fa-trash-alt"></span></td>
                    </tr>
                    @endforeach

                </table>
        </div>
        <div class="w3-col s1 m4 l4">
          &nbsp;
        </div>
      </div>

@endsection