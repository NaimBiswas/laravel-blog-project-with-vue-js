<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::with('user', 'category')->get()->all();

        return response()->json([
            'posts' => $post,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $images =  explode(';', $request->images);
        $imagesTwo = explode('/', $images[0]);
        $imageFormate = end($imagesTwo);
        $OurImage = Str::slug($request->title) . '.' . $imageFormate;

        $request->validate([
            'title' => 'required|unique:posts,title|min:10|max:120',
            'description' => 'required|min:150',
            'images' => 'required',
            'category_id' => 'required',
        ]);


        Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'images' => $OurImage,
            'description' => $request->description,
            'status' => $request->status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post->delete();
    }
    public function DeletePosts(Request $request)
    {

        $total = 0;
        foreach ($request->data as $row) {

            $post = Post::find($row)->delete();
            $total++;
        }
        return response()->json([
            'total' => $total,
        ]);
    }

    public function ActivePosts(Request $request)
    {
        $total = 0;
        foreach ($request->data as $row) {
            $post = Post::find($row);
            $post->status = $request->status;
            $post->save();
            $total++;
        }
        return response()->json([
            'total' => $total,
        ]);
    }
}
