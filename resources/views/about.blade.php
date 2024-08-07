@extends('layout')
@section('title', 'About')
@section('content')
    <h2>About</h2>
    <hr>
    <p>Developer: {{$name}}</p>
    <p>Date: {{$date}}</p>
@endsection
