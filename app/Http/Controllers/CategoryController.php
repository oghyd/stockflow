<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\Loggable;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($data);

        Loggable::recordActivity(
            'category_created',
            $category,
            'Category "' . $category->name . '" was created'
        );

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie créée avec succès');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($data);

        Loggable::recordActivity(
            'category_updated',
            $category,
            'Category "' . $category->name . '" was updated'
        );

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie modifiée avec succès');
    }

    public function destroy(Category $category)
    {
        Loggable::recordActivity(
            'category_deleted',
            $category,
            'Category "' . $category->name . '" was deleted'
        );

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès');
    }
}