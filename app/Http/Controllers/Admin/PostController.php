<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;

class PostController extends Controller
{
    protected $validationRules = [
        "title" => "string|required|max:100",
        "content" => "string|required "
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::all();
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view("admin.posts.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione
        $request->validate($this->validationRules);

        $newPost = new Post();
        $newPost->fill($request->all());

        $newPost->slug = $this->getSlug($request->title);

        $newPost->save();
        return redirect()->route("admin.posts.index")->with("success","Il post è stato creato");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("admin.posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        // Validazione
        $request->validate($this->validationRules);

        if($post->title != $request->title){
            $post->slug = $this->getSlug($request->title);
        }

        $post->fill($request->all());

        $post->save();

        return redirect()->route("admin.posts.index")->with("success","Il post {$post->id} è stato aggiornato");
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
        return redirect()->route("admin.posts.index")->with("success","Il post {$post->id} è stato eliminato");
    }

    private function getSlug($title)
    {
        $slug = Str::of($title)->slug("-");

        $postExist = Post::where("slug", $slug)->first();
        $count = 2;

        while($postExist){
            $slug= Str::of($title)->slug("-") . "-{$count}";
            $postExist = Post::where("slug", $slug)->first();
            $count++;
        }
        return $slug;
    }
}
