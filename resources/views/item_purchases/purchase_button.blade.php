@if (Auth::id() == $item->id)
    @if (Auth::user()->is_purchasing($item->id))
        {!! Form::open(['route' => ['item.unpurchase', $item->id], 'method' => 'delete']) !!}
            {!! Form::submit('購入をやめる', ['class' => "btn btn-success btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['item.purchase', $item->id]]) !!}
            {!! Form::submit('購入する', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif