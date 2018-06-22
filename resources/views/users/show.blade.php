@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <div class="icon text-center">
            <img src="{{ Gravatar::src($user->email, 100) . '&d=mm' }}" alt="" class="img-circle">
        </div>
        <div class="name text-center">
            <h1>{{ $user->name }}</h1>
        </div>
    </div>
    <div class="items-detail">
        <h2>出品した商品</h2>
            @include('items.items', ['items' => $items])
    </div>
    <div class="items-detail">
        <h2>お気に入り一覧</h2>
            @include('items.items', ['items' => $favorites])
    </div>
    {!! $items->render() !!}
@endsection