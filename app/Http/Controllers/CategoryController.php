<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

class CategoryController extends Controller
{
    // Show Create Form
    public function create() {

        $categories = Category::where('confirmed', 1)->get();

        // recursive function for subcategories
        $generator = function (Collection $level) use ($categories, &$generator) {
            // sorting by id
            foreach ($level->sortBy('id') as $item) {

                // yield a single item
                yield $item;
    
                // continue yielding results from the recursive call
                yield from $generator($categories->where('parent_id', $item->id));
            }
        };
    
        $categories = LazyCollection::make(function () use ($categories, $generator) {

            // yield from root level
            yield from $generator($categories->where('parent_id', null));
        })->flatten()->collect();

        return view('categories.create', [
            'categories' => $categories
        ]);
    }

    // Store Category Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required',
            'parent_id' => 'required'
        ]);

        if($formFields['parent_id'] != 0) {    // if it is not subcategory, tahn position is position of parent_id + 1
            $formFields['position'] = (Category::where('id', $formFields['parent_id'])->first()->position) + 1;
        }

        Category::create($formFields);

        return redirect('/')->with('message', 'Category created successfully!');
    }

    // Show Category Confirm Section
    public function showConfirm() {
        return view('categories.confirm', ['categories' => Category::where('confirmed', 0)->get()]);
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

    // Show Category Edit Form
    public function edit(Category $category) {
        $categories = Category::where('confirmed', 1)->get();

        // recursive function for subcategories
        $generator = function (Collection $level) use ($categories, &$generator) {
            // sorting by id
            foreach ($level->sortBy('id') as $item) {

                // yield a single item
                yield $item;
    
                // continue yielding results from the recursive call
                yield from $generator($categories->where('parent_id', $item->id));
            }
        };
    
        $categories = LazyCollection::make(function () use ($categories, $generator) {

            // yield from root level
            yield from $generator($categories->where('parent_id', null));
        })->flatten()->collect();

        return view('categories.edit', [
            'categories' => $categories,
            'ctg' => $category,
            'text' => ''
        ]);
    }

    // Update Category
    public function update(Request $request, Category $category) {
        
        $formFields = $request->validate([
            'name' => 'required',
            'parent_id' => 'required'
        ]);

        $category->update($formFields);

        return redirect('/categories/manage')->with('message', 'Category was updated successfully!');
    }

    // Manage Categories
    public function manage() {
        return view('categories.manage', ['categories' => Category::All()->sortBy('name')]);
    }
}
