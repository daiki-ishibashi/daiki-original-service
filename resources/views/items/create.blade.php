@extends('layouts.app')

@section('content')

<!-- Write content for each page here -->
    <h1>出品ページ</h1>
    
        <div class="row"> 
        <div class="form-group col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">
            {!! Form::model($item, ['route' => 'items.store','files'=>true]) !!}
            
            {{--成功時のメッセージ--}}
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            {{-- エラーメッセージ --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
            @endif
            
            <div class="form-group">
                @if ($item->image_url)
                    <p>
                        <img src="{{ asset('storage/image/' . $item->image_url) }}" alt="image" />
                    </p>
                @endif
                    {!! Form::label('file', '画像アップロード', ['class' => 'control-label']) !!}
                    {!! Form::file('file') !!}
            </div>
            
            <div class="form-group">
                    {!! Form::label('category_masters', '商品カテゴリー') !!}<br>
                    {{Form::select('category_masters', [
                        '1' => 'メンズ',
                        '2' => 'レディース',
                        '3' => 'コスメ/美容',
                        '4' => 'スマホ/家電/カメラ',
                        '5' => '食品/飲料/酒',
                        '6' => 'スポーツ/アウトドア',
                        '7' => 'キッズ/ベビー/マタニティ',
                        '8' => 'その他']
                        )}}
            </div>
            
            <div class="form-group">
                    
                    {!! Form::label('name', '商品名:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                
                    
                    {!! Form::label('content', '商品説明:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                    
                    {!! Form::label('price', '値段:') !!}
                    {!! Form::text('price', null, ['class' => 'form-control']) !!}    
            </div>  
    
        <button type="button" class="btn btn-default">
          <span class="glyphicon glyphicon-sunglasses"></span>
            {!! Form::submit('出品！') !!}
        </button>
        </div>
    {!! Form::close() !!}

@endsection