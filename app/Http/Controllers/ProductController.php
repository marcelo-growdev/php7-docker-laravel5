<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }
    public function create()
    {
        $categories = Category::all();
        return view('products.create', ['categories' => $categories]);
    }
    public function store(Request $request)
    {
        $validadeInputs = $request->validate(['title' => 'required|string|max:255', 'description' => 'string|max:255|nullable', 'price' => 'required|numeric', 'category' => 'required']);
        $product = new Product(['title' => $validadeInputs['title'], 'description' => $validadeInputs['description']]);
        $product->setPrice($validadeInputs['price']);
        $category = Category::find($validadeInputs['category']);
        $product->category()->associate($category);
        $product->save();
        return redirect()->route('products.index');
    }
    public function show(Product $product)
    {
        //
    }
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }
    public function update(Request $request, Product $product)
    {
        $validadeInputs = $request->validate(['title' => 'required|string|max:255', 'description' => 'string|max:255|nullable', 'price' => 'required|numeric', 'category' => 'required']);
        $product->title = $validadeInputs['title'];
        $product->description = $validadeInputs['description'];
        $product->setPrice($validadeInputs['price']);
        $category = Category::find($validadeInputs['category']);
        $product->category()->associate($category);
        $product->saveOrFail();
        return redirect()->route('products.index');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }

    public function getProductsByTitle(Request $request) {

    }
}