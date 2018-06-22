@if (Auth::check())
    @if (Auth::user()->is_favoriting($item->id))
        {!! Form::open(['route' => ['item.unfavorite', $item->id], 'method' => 'delete']) !!}
            {!! Form::submit('お気に入りから外す', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['item.favorite', $item->id]]) !!}
            {!! Form::submit('お気に入り', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif