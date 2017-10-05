@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">
    
    <table class="table table-bordered game_map" data-board-id="{{ $model->id }}">
        <tbody>
            @foreach($map as $row_id => $rows)
                <tr>
                    @foreach($rows as $item_id => $item)
                        <td class="game_map-cell" data-key="[{{ $row_id }}, {{ $item_id }}]">{{ $item }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
    
@endsection
