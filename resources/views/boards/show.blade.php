@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">

<table class="table table-bordered">
    <tbody>
        @foreach($map as $rows)
            <tr>
                @foreach($rows as $row)
                    <td>{{ $row }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
  </table>



</div>
    
@endsection
