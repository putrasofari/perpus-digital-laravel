<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {

            $query->where('category', 'like', '%' . $request->search . '%');
        }

        $categories = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:225|unique:categories,category',
            'description' => 'nullable',
        ], [
            'category.required' => 'Nama kategori wajib diisi!',
            'category.max' => 'Nama kategori maksimal 225 karakter!',
            'category.unique' => 'Nama kategori tidak boleh sama dengan kategori yang sudah ada!'
        ]);

        Category::create($validated);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->loadCount('books');
        $books = $category->books()->paginate(10)->withQueryString();

        return view('admin.categories.show', compact('category', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:225|unique:categories,category,' . $category->id,
            'description' => 'nullable',
        ], [
            'category.required' => 'Nama kategori wajib diisi!',
            'category.max' => 'Nama kategori maksimal 225 karakter!',
            'category.unique' => 'Nama kategori tidak boleh sama dengan kategori yang sudah ada!'
        ]);

        $category->update($validated);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
