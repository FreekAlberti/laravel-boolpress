<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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

        return redirect()->route("admin.posts.show", $newPost);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where("slug", $slug)->first();
        return view("Admin.post.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where("slug", $slug)->first();
        return view("Admin.post.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();

        $validatedData = $request->validate([
          'title' => ['required'],
          'slug' => ['required', Rule::unique("posts")->ignore($post)],
          'cover' => ['nullable', 'image'],
          'content' => ['required']
        ]);

        $post->title = $validatedData['title'];
        $post->slug = $validatedData['slug'];
        $post->content = $validatedData['content'];

        if (isset($validatedData['cover'])) {
          $path = Storage::disk('public')->putFile('image', $validatedData['cover']);
          $post->cover = $path;
        }

        $post->update();

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("admin.posts.index");
    }
}
