<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // fetch all categories from database
        // display them in the categories.index page
        return view('categories.index')->with('categories', Category::all());
    }

    public function create()
    {
        // display the create form for categories
        return view('categories.create');
    }

    public function store()
    {
        // create a new record in the database for this new category and then redirect to categories listing
        $this->validate(request(), [
            'name' => 'required|min:3|max:30'
        ]);
        $data = request()->all();
        $category = new Category();
        $category->name = $data['name'];
        $category->save();
        session()->flash('success', 'Category created successfully.');
        return redirect('/categories');
    }

    public function edit(Category $category)
    {
        // fetch the specific category from database
        // display it in the categories.edit page
        return view('categories.edit')->with('category', $category); //using route model binding
    }

    public function update(Category $category)
    {
        // update the specified category in the database and then redirect to categories listing
        $this->validate(request(), [
            'name' => 'required|min:3|max:30',
        ]);
        $data = request()->all();
        $category->name = $data['name'];
        $category->save();
        session()->flash('success', "Category updated successfully.");
        return redirect('/categories');
    }

    public function destroy(Category $category) // using route model binding using type hinting
    {
        // delete the specified category from the database and then redirect to categories listing
        $category->delete();
        session()->flash('success', "Category '$category->name' deleted successfully.");
        return redirect('/categories');
    }
}
