@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">

    {!! Form::open(['url' => route('boards.store'), 'method' => 'POST']) !!}
        <div class="well">
            <h3>Choose your side</h3>
            {!! Form::radio('player_type', Config::get('enums.field_types.X'), true, ['class' => 'button-radio', 'required' => true]) !!} X
            {!! Form::radio('player_type', Config::get('enums.field_types.O'), false, ['class' => 'button-radio', 'required' => true]) !!} O
            <div class="text-center">
                {!! Form::submit('X', ['value' => Config::get('enums.field_types.X'), 'class' => 'btn btn-primary']) !!}
                {!! Form::submit('O', ['value' => Config::get('enums.field_types.O'), 'class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}

</div>




    @foreach($boards as $board)
        <div>
            {{ $board->id }}
        </div>
    @endforeach

    {{ $boards->links() }}
    
@endsection
