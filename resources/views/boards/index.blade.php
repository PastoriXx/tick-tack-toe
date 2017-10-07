@extends('layouts.app')

@section('content')
<div class="flex-center position-ref">

    {!! Form::open(['url' => route('boards.store'), 'method' => 'POST']) !!}
        <div class="well text-center">
            <h3>Choose your side</h3>
            <label class ="radio-label">
                {!! Form::radio('player_type', Config::get('enums.field_types.X'), true, ['class' => 'radio-button', 'required' => true]) !!}X
            </label>
            <label class ="radio-label">
                {!! Form::radio('player_type', Config::get('enums.field_types.O'), false, ['class' => 'radio-button', 'required' => true]) !!}O
            </label>
            <div>
                {!! Form::submit('Start', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}

</div>

<h4 class="text-center">History</h4>

<div class="panel-group" id="accordion">
    @foreach($boards as $board)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $board->id }}">
                    Board {{ $board->id }}</a>
                </h4>
            </div>
            <div id="collapse{{ $board->id }}" class="panel-collapse collapse">
                <div class="panel-body">
                    <div>
                        @if($board->winner_type > 0)
                            The winner is the {{ $board->winner_type == $board->player_type ? 'player' : 'computer' }}
                        @endif
                    </div>
                    <div class="well">
                        @foreach($board->steps as $step)
                            {{ $step->created_at }}
                            @foreach($step->game_map as $row)
                                <div>
                                    @foreach($row as $cell)
                                        [{{ $cell }}]
                                    @endforeach
                                </div>
                            @endforeach
                        @endforeach
                    </div>                    
                </div>
            </div>
        </div>
    @endforeach  
</div>

<div class="text-center">
    {{ $boards->links() }}
</div>
    
@endsection
