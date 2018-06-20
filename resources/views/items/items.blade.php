<ul class="media-list">
@foreach ($items as $item)
    <?php $user = $item->user; ?>
    <li class="media">
        <div class="media-body">
            <div>
                
                <div class="panel-body">
                            @if ($item->id)
                                <h2 class="item-title"><a href="{{ route('items.show', $item->id) }}">{{ $item->name }}</a></h2>
                            @else
                                <h2 class="item-title">{{ $item->name }}</h2>
                            @endif
                
                        <img border="0" src="/storage/image/{{$item->image_url}}" width="128" height="128" alt="">
                        <h2><th>価格</th>
                        {!! nl2br(e($item->price)) !!}</h2>
                    </div>
                    <div>
                            {!! Form::open(['route' => ['items.destroy', $item->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                            
                            {!! Form::open(['route' => ['items.edit', $item->id], 'method' => 'get']) !!}
                                {!! Form::submit('Edit', ['class' => 'btn btn-info btn-xs']) !!}
                            {!! Form::close() !!}
                </div>        
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $items->render() !!}