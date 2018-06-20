@extends('layouts.app')

@section('content')

<!-- Write content for each page here -->
    <h1>商品詳細ページ</h1>
    
        <div class="row"> 
        <div class="form-group col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">
                @if ($item->image_url)
                    <p>
                        <img src="{{ asset('storage/image/' . $item->image_url) }}" alt="image" />
                    </p>
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
            <td>{{ App\Item::find($item->id)->category_masters()->get()->type }}</td>
        </tr>
        <tr>
            <th>価格</th>
            <td>{{ $item->price }}</td>
        </tr>
    </table>
    <button type="button" class="btn btn-default">
          <span class="glyphicon glyphicon-sunglasses"></span>
            {!! Form::submit('購入する') !!}
        </button>
        </div>
    </div>
    
@endsection

