<?php

namespace App\Http\Controllers\Admin;

use App\Comments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image;
use App\Product;
use App\Category;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Product Page
        $products = Product::all()->sortDesc();
        return view('admin.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Create Product Page
        $categories = Category::all()->where('parent_id', '!=', 'id');
        return view('admin.product.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Create Product
        $request->validate([
            'name' => 'required|min:5|max:150|unique:products',
            'price' => 'required|integer|min:1000',
            'quantity' => 'required|integer|min:1',
            'NamXB' => 'required|integer|min:4',
            'NXB' => 'required|min:8',
            'author' => 'required',
            'sale' => 'min:0',
            'image' => 'image',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->sale = $request->sale;
        $product->NamXB = $request->NamXB;
        $product->NXB = $request->NXB;
        $product->author = $request->author;
        $product->description = $request->description;
        $product->content = $request->get('content');
        $product->category_id = $request->category_id;
        $product->status = $request->status;

        $file = $request->file('image');
        if ($request->hasFile('image')) {
            $img_name = $file->getClientOriginalName();
            $image = time() . '-' . $img_name;
            Storage::disk('storage')->putFileAs("product", $file, $image);
            $product->image = $image;
        }
        $product->save();

        return redirect()->route('admin.product')->with('success', 'create success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showComment($id)
    {
        $comments = Comments::all()->where('product_id', $id);
        return view('admin.comment.index')->with(['comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit Product Page
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.product.edit')->with(['product'=>$product, 'categories'=>$categories]);
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
        //Update Product
        $request->validate([
            'name' => 'required|min:5|max:150',
            'price' => 'required|integer|min:1000',
            'quantity' => 'required|integer|min:1',
            'NamXB' => 'required|integer|min:4',
            'NXB' => 'required|min:10',
            'author' => 'required',
            'sale' => 'min:0',
            'image' => 'image',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->sale = $request->sale;
        $product->description = $request->description;
        $product->content = $request->get('content');
        $product->NXB = $request->NXB;
        $product->author = $request->author;
        $product->NamXB = $request->NamXB;
        $product->category_id = $request->category_id;
        $product->status = $request->status;

        $file = $request->file('image');
        if ($request->hasFile('image')) {
            $img_name = $file->getClientOriginalName();
            $image = time() . '-' . $img_name;
            Storage::disk('storage')->putFileAs("product", $file, $image);
            $product->image = $image;
        }

        $product->save();

        return redirect()->route('admin.product')->with('success', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        foreach ($product->product_image as $image) {
            Storage::disk('storage')->delete("product/$image->name");
        }
        $product->delete();
        return redirect()->route('admin.product')->with('success', 'Delete success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCommentProduct($id)
    {
        $comment = Comments::find($id);
        $comment->delete();
        return  redirect()->route('admin.comment', $comment->product_id)->with('success', 'Deletecomment success');
    }
}
