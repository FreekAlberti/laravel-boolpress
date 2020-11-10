@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route("posts.store")}}" method="POST">
        
        @csrf
        @method("POST")

        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter slug">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10" placeholder="Enter content"></textarea>
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