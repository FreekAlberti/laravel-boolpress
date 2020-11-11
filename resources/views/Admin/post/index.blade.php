@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Cover</th>
            <th scope="col">Author</th>
            <th scope="col">Activities</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
            <td>{{$post->title}}</td>
            <td>{{$post->content}}</td>
            <td><img style="max-width: 200px" src="{{asset("storage/".$post->cover)}}" alt="{{$post->title}}"></td>
            <td>{{$post->user_id}}</td>
            <td>
                <a href="{{route("posts.show", $post->slug)}}" class="btn btn-primary" role="button">View</a>
                {{-- <a href="{{route("posts.show", $post->slug)}}" class="btn btn-warning" role="button">Edit</a> --}}
                {{-- <a href="{{route("posts.show", $post->slug)}}" class="btn btn-danger" role="button">Remove</a> --}}
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>   
</div>
@endsection