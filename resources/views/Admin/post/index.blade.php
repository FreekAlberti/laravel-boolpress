@extends('layouts.app')

@section('content')
<table class="table table-striped table-dark">
    <thead>
      <tr>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th scope="col">Author</th>
        <th scope="col">Activities</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>{{$post->title}}</td>
          <td>{{$post->content}}</td>
          <td>{{$post->user_id}}</td>
          <td>
            <button type="button" class="btn btn-primary">View</button>
            <button type="button" class="btn btn-warning">Edit</button>
            <button type="button" class="btn btn-danger">Remove</button>
          </td>
        </tr>
        @endforeach
    </tbody>
</table>   
@endsection