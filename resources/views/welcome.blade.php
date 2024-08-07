@extends('layouts.app')
@section('title','Home')
@section('content')
    <h2>Welcome to Website</h2>
    <hr>
    @foreach ($blogs as $item)
        <h4>{{$item->title}}</h4>
        <p>{!!Str::limit($item->content, 20) !!}</p>
        <a href="/detail/{{$item->id}}">Read more</a>
        <hr>
    @endforeach
@endsection
