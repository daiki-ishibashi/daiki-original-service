@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>あなたの商品がすぐ売れる！</h1>
            </div>
        </div>
    </div>
@endsection
@section('content')
    @include('items.items', ['items' => $items])
@endsection