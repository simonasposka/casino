<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(): View
    {
        $categories = Category::all()->sortDesc();

        return view('CategoriesIndex', [
           'categories' => $categories
        ]);
    }

    public function create(): View
    {
        return view('CategoriesCreate');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(['name' => ['required', 'string', 'min:1', 'max:255', 'unique:categories']]);
        $category = new Category();
        $category->name = $validated['name'];
        $category->save();

        return redirect()->route('categories.index')->with('message', 'Category created');
    }

    public function edit(Category $category): View
    {
        return view('CategoriesEdit', ['category' => $category]);
    }

    public function update(Category $category, Request $request): RedirectResponse
    {
        $validated = $request->validate(['name' => ['required', 'string', 'min:1', 'max:255', 'unique:categories']]);
        $category->name = $validated['name'];
        $category->save();

        return redirect()->route('categories.index')->with('message', 'Category updated');
    }

    public function delete(Category $category): View
    {
        return view('CategoriesDelete', [
            'category' => $category
        ]);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index')->with('message', 'Category deleted');
    }
}
