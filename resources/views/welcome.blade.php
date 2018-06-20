@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>あなたが大切にしてきたもの<br>譲りませんか</h1>
                @if (!Auth::check())
                    <a href="{{ route('signup.get') }}" class="btn btn-success btn-lg">Daiki Free Marketを始める</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')
       
@endsection