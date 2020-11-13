@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route("admin.posts.update", $post->slug)}}" method="POST" enctype="multipart/form-data">
        
        @csrf
        @method("PUT")

        <div class="form-group">
            <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="slug" id="slug" value="{{$post->slug}}">
        </div>
        <div class="form-group">
            <img style="max-width: 200px" src="{{asset("storage/".$post->cover)}}" alt="{{$post->title}}">
            <input type="file" class="form-control" accept="image/*" name="cover" id="image" value="{{$post->cover}}">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{$post->content}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection