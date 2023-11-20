<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show Categories
    public function show() {
        return view('categories.show', [
            'categories' => Category::latest()->paginate(6)
        ]);
    }

    // Show Create Form
    public function create() {
        return view('categories.create');
    }

    // Store Category Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        Category::create($formFields);

        return redirect('/')->with('message', 'Category created successfully!');
    }

    // Show Category Confirm Section
    public function showConfirm() {
        return view('roles.manager.confirmCategories', ['categories' => Category::where('confirmed', 0)->get()]);
    }

    // Confirm New Category Created by User
    public function confirm(Category $category) {
        $formFields['confirmed'] = 1;

        $category->update($formFields);

        return back()->with('message', 'Category was confirmed successfully!');
    }

    // Unconfirm New Category Created by User
    public function unconfirm(Category $category) {
        $category->delete();
        return back()->with('message', 'Category was unconfirmed successfully!');
    }
}
