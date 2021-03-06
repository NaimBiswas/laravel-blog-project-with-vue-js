<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return response()->json([
            'categories' => $categories,
        ]);
    }
    public function FetchActiveCategories()
    {
        $categories = Category::where('status', true)->get()->all();

        return response()->json([
            'ActiveCategories' => $categories,
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
        $request->validate([
            'name' => 'required|unique:categories,name|min:3'
        ]);
        $category =      Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return response()->json([
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {

        $request->validate([
            'name' => 'required|min:3',

        ]);
        $category = Category::find($slug);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        return  $category->delete();
    }
    public function deleteCategories(Request $request)
    {
        $total = 0;
        foreach ($request->data as $row) {
            $delete = Category::find($row)->delete();
            $total++;
        }
        return response()->json([
            'total' => $total,
        ]);
    }
    public function activeCategories(Request $request)
    {
        $total = 0;
        foreach ($request->data as $row) {
            $categories = Category::find($row);
            $categories->status = true;
            $categories->save();

            $total++;
        }
        return response()->json([
            'total' => $total,
        ]);
    }
    public function deactiveCategories(Request $request)
    {
        $total = 0;
        foreach ($request->data as $row) {
            $categories = Category::find($row);
            $categories->status = false;
            $categories->save();
            $total++;
        }
        return response()->json([
            'total' => $total,
        ]);
    }
    public function activeCategory(Request $request)
    {
        $id = $request->data;
        $category = Category::find($id);
        $category->status = true;
        $category->save();
    }
    public function deactiveCategory($id)
    {
        $category = Category::find($id);
        $category->status = false;
        $category->save();
    }
}
