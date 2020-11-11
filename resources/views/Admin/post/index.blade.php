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
                <a href="{{route("admin.posts.show", $post->slug)}}" class="btn btn-primary" role="button">View</a>
                <a href="#" class="btn btn-warning" role="button">Edit</a>
                <form action="{{route("admin.posts.destroy", $post)}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="submit" class="btn btn-danger" value="Remove">
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>   
</div>
@endsection