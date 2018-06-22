@extends('layouts.app')

@section('content')

<!-- Write content for each page here -->
    <h1>商品詳細ページ</h1>
    
    <div class="row"> 
        <div class="form-group col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">
            @if ($item->image_url)
                <img border="0" src="/storage/image/{{$item->image_url}}" width="250" height="300" alt="">
            @endif
    </div>
    <div class="col-md-6">
        <table class="table table-hover">
        <tr>
            <th>商品名</th>
            <td>{{ $item->name }}</td>
        </tr>
        <tr>
            <th>商品説明</th>
            <td>{{ $item->content }}</td>
        </tr>
        <tr>
            <th>カテゴリー</th>
            <td>
                @foreach(App\Item::find($item->id)->category_masters()->get() as $v)
                {!! $v->type!!}
                @endforeach
            </td>
        </tr>
        <tr>
            <th>価格</th>
            <td>{{ $item->price }}円</td>
        </tr>
    </table>
    
    @include('item_purchases.purchase_button', ['item' => $item])
    
    
    @if (Auth::user()->id == $item->user_id)
        {!! Form::open(['route' => ['items.destroy', $item->id], 'method' => 'delete']) !!}
            {!! Form::submit('商品を削除する', ['class' => 'btn btn-danger btn-xs']) !!}
        {!! Form::close() !!}
        
        {!! Form::open(['route' => ['items.edit', $item->id], 'method' => 'get']) !!}
            {!! Form::submit('商品を編集する', ['class' => 'btn btn-info btn-xs']) !!}
        {!! Form::close() !!}
    @endif
    
    @if (Auth::user()->id != $item->user_id)
        @include('item_favorite.favorite_button', ['item' => $item])
    @endif
        </div>
    </div>

@endsection
