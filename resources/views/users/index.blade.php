@extends('layouts.app')

@section('content')
   
    @include('items.items', ['items' => $items])
@endsection