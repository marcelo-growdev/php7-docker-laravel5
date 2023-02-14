<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validadeInputs = $request->validate(['name' => 'required|string|max:255']);
        $category = new Category($validadeInputs);
        $category->save();
        return redirect('/categories');
    }
    public function show(Category $category)
    {
        //
    }
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }
    public function update(Request $request, Category $category)
    {
        $validadeInputs = $request->validate(['name' => 'required|string|max:255']);
        $category->name = $validadeInputs['name'];
        $category->save();
        return redirect('/categories');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}