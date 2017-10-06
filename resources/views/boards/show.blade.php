@extends('layouts.app')

@section('content')
<div class="flex-center position-ref">
    
    <table class="table table-bordered game_map" data-board-id="{{ $model->id }}">
        <tbody>
            @foreach($map as $row_id => $rows)
                <tr>
                    @foreach($rows as $item_id => $item)
                        <td class="game_map-cell" data-x="{{ $row_id }}" data-y="{{ $item_id }}">
                            @if ($item > 0)
                                {{ $item == 1 ? 'X' : 'O' }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
    
@endsection
