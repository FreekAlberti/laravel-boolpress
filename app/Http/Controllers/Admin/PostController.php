<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $posts = Post::where("user_id", $user_id)->get();
        return view("Admin.post.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            "title"=>"required",
            "slug"=>"required | unique:posts",
            "cover"=>"required | image",
            "content"=>"required"
        ]);
        
        $id = Auth::id();
        $filename_original = $data["cover"]->getClientOriginalName();
        $path = Storage::disk("public")->putFileAs("image/$id", $data["cover"], $filename_original);

        $newPost = new Post;
        $newPost->user_id = Auth::id();
        $newPost->title = $data["title"];
        $newPost->slug = $data["slug"];
        $newPost->cover = $path;
        $newPost->content = $data["content"];
        $newPost->save();

        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
