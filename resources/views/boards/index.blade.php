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

@include('boards._history')

@endsection
