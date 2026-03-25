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
    public function index()
    {

        $categories = Category::latest()->get(); // Category::orderBy('created_at', 'desc')->get();

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
        $data = $request->validate([
            'name' => 'required|max:255|unique:categories,name',
        ]);

        Category::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoría creada con éxito',
            'text' => 'La nueva categoría ha sido agregada.',
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
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
        $data = $request->validate([
            'name' => 'required|max:255|unique:categories,name,'.$category->id,
        ]);

        $category->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoría actualizada con éxito',
            'text' => 'La categoría ha sido actualizada.',
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoría eliminada con éxito',
            'text' => 'La categoría ha sido eliminada.',
        ]);

        return redirect()->route('admin.categories.index');
    }
}
