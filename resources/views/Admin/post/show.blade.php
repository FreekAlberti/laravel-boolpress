@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$post->title}}</h1>
    <img style="max-width: 200px" src="{{asset("storage/".$post->cover)}}" alt="{{$post->title}}">
    <div>{{$post->content}}</div>
    <small>{{$post->user->name}}</small>
</div>
@endsection