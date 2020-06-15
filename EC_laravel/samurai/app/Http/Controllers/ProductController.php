<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories =Category::all();
        return view('products.create',compact('categories'));
    }

   
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->save();

        // return redirect()->route('products.show', ['id' => $product->id]);
        return redirect()->route('products.show', $product->id);
    }

 
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    
    public function edit(Product $product)
    {
        $categories =Category::all();
        return view('products.edit', compact('product','categories'));
    }


    public function update(Request $request, Product $product)
    {
        $product->name = $request->input('name');
        $product->discription = $request->input('discription');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->update();
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
