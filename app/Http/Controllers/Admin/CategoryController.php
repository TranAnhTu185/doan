<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Category Page
        $categories = Category::all()->sortDesc()->where('parent_id', 0);
        return view('admin.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Create Category Page
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Create Category
        $request->validate([
            'name' => 'required|string|unique:categories',
            'sort_order' => 'integer',
            'avatar.*' => 'image',
        ]);

        if ($request->get('sort_order') == '') {
            $sort_order = Category::max('sort_order') + 1;
        }

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->sort_order = $sort_order;
        $file = $request->file('avatar');
        if ($request->hasFile('avatar')) {
            $img_name = $file->getClientOriginalName();
            $avatar = time() . '-' . $img_name;
            Storage::disk('storage')->putFileAs("category", $file, $avatar);
            $category->avatar = $avatar;
        }
        $category->save();
        return redirect()->route('admin.category')->with('success', 'Create success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit Page
        $category = Category::find($id);
        $parent_id = Category::all()->where('parent_id', 0);
        return view('admin.category.edit')->with(['category' => $category, 'parent_id' => $parent_id]);
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
        //Update Category
        $request->validate([
            'name' => 'required|string',
            'avatar.*' => 'image',
        ]);

        if ($request->parent_id == '') {
            $parent_id = 0;
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->sort_order = $request->sort_order;
        $category->save();
        return redirect()->route('admin.category')->with('success', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Category
        $category = Category::find($id);
        if ($category->parent_id == 0) {
            Category::find($id)->delete();
            Category::where('parent_id', $id)->delete();
            return redirect()->route('admin.category')->with('success', 'Delete success!');
        } else {
            Category::find($id)->delete();
            return redirect()->route('admin.category')->with('success', 'Delete success!');
        }
    }
}
