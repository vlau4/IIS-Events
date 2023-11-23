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
                yield from $generator($categories->where('parent', $item->id));
            }
        };
    
        $categories = LazyCollection::make(function () use ($categories, $generator) {

            // yield from root level
            yield from $generator($categories->where('parent', null));
        })->flatten()->collect();

        return view('categories.create', [
            'categories' => $categories
        ]);
    }

    // Store Category Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required',
            'parent' => 'required'
        ]);

        if($formFields['parent'] != 0) {    // if it is not subcategory, tahn position is position of parent + 1
            $formFields['position'] = (Category::where('id', $formFields['parent'])->first()->position) + 1;
        }

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

    // Show Edit Form
    public function edit(Category $category) {
        $categories = Category::where('confirmed', 1)->get();

        // recursive function for subcategories
        $generator = function (Collection $level) use ($categories, &$generator) {
            // sorting by id
            foreach ($level->sortBy('id') as $item) {

                // yield a single item
                yield $item;
    
                // continue yielding results from the recursive call
                yield from $generator($categories->where('parent', $item->id));
            }
        };
    
        $categories = LazyCollection::make(function () use ($categories, $generator) {

            // yield from root level
            yield from $generator($categories->where('parent', null));
        })->flatten()->collect();

        // dd($categories);

        return view('roles.manager.editCategory', [
            'categories' => $categories,
            'ctg' => $category,
            'text' => ''
        ]);
    }

    // Update Event
    public function update(Request $request, Category $category) {

        // Make sure logged in user is admin or manager
        // if($event->user_id != auth()->id()) {
        //     abort(403, 'Unauthorized Action');
        // }
        
        $formFields = $request->validate([
            'name' => 'required',
            'parent' => 'required'
        ]);

        $category->update($formFields);

        return redirect('/categories/manage')->with('message', 'Category was updated successfully!');
    }

    // Manage Categories
    public function manage() {
        return view('roles.manager.manageCategories', ['categories' => Category::All()]);
    }
}
