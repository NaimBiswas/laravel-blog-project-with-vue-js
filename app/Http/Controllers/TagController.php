<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::get()->all();
        return response()->json(['tags' => $tags]);
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
        $request->validate([
            'name' => 'unique:tags,name|required|min:3|max:15',

        ]);
        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        return response()->json([
            'tag' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|min:3|max:15',
        ]);

        $tag = Tag::where('slug', $slug)->first();
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->status = $request->status;
        $tag->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        return $tag->delete();
    }
    public function activeTag($id)
    {
        $tag = Tag::find($id);
        $tag->status = true;
        $tag->save();
    }

    public function deactiveTag($id)
    {
        $tag = Tag::find($id);
        $tag->status = false;
        $tag->save();
    }
    public function deleteTags(Request $request)
    {
        foreach ($request->data as $row) {
            Tag::find($row)->delete();
        }
    }
    public function ActiveTags(Request $request)
    {
        foreach ($request->data as $row) {
            $tags = Tag::find($row);
            $tags->status = true;
            $tags->save();
        }
    }
    public function DeactiveTags(Request $request)
    {
        foreach ($request->data as $row) {
            $tags = Tag::find($row);
            $tags->status = false;
            $tags->save();
        }
    }
}
