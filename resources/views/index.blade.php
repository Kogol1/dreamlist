@extends('layouts.app')

@section('content')

    <div class="container text-center mt-4">
        <center>
            <h3>Přidat další</h3>
            <div class="col-sm-8">
                {{Form::open(['route' => 'dreams.store', 'method' => 'POST', 'autocomplete' => 'off'])}}
                <div class="row">
                    <div class="col-9">
                        {!! Form::text('title', '', [ 'class' => 'form-control', 'placeholder' => 'Přidat sen..'])!!}
                    </div>
                    <div class="col-3">
                        {{Form::submit('Přidat', ['class' => 'form-control btn btn-primary text-white'])}}
                        {{ Form::close() }}
                    </div>
                </div><br>

                <div class="mt-4">
                    <h3>Nesplněno <i class="fas fa-caret-right"></i> {{Auth::user()->getCountDreams(false)}}</h3>
                    <table class="table table-striped">
                        @if(Auth::user()->getDreams() != null)
                            @foreach(Auth::user()->getDreams() as $dream)
                                <tr>
                                    <td>
                                        <a href="{{route('dreams.toggle', $dream)}}"><span class="far fa-square" style="color: black"></span></a>
                                    </td>
                                    <td>{{$dream->title}} </td>
                                    <td style="color: #636b6f; font-size: smaller">{{ \Carbon\Carbon::parse($dream->created_at)->format('d. m. Y')}}</td>
                                    <td><a href="{{action('DreamsController@destroy',  $dream)}}"><span class="fas fa-trash-alt" style="color: black"></span></a></td>
                                </tr>
                            @endforeach
                        @else
                            <div class="alert alert-info" role="alert">
                                Tady nic není.. 😞 Přidej si nějaké sny, ať je co plnit 😀
                            </div>
                        @endif
                    </table>
                </div>


                <!-- Splněno-->
                <h3 class="mt-4">Splněno <i class="fas fa-caret-right"></i> {{Auth::user()->getCountDreams(true)}}</h3>
                <table class="table table-striped">
                    @if(Auth::user()->getCountDreams(true) > 0)
                        @foreach(Auth::user()->getDreams(true) as $dream2)
                        <tr>
                            <td><a href="{{route('dreams.toggle', $dream2)}}"><i class="fas fa-check-square" style="color: black"></i></a></td>
                            <td>{{$dream2->title}}</td>
                            <td style="color: #636b6f; font-size: smaller">{{ \Carbon\Carbon::parse($dream2->done)->format('d. m. Y')}}</td>
                            <td><a href="{{action('DreamsController@destroy',  $dream2)}}"><span class="fas fa-trash-alt" style="color: black"></span></a></td>
                        </tr>
                        @endforeach
                    @else
                        <div class="alert alert-info" role="alert">
                            Ještě není nic splněno 😟
                        </div>
                    @endif
                </table>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Přidat sen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </center>
    </div>


@endsection
