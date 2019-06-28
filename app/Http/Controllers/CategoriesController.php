<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        // for below 3 commented lines, the array has been moved to custom request CreateCategoryRequest.php
//        $this->validate($request, [
//            'name' => 'required|unique:categories'
//        ]);
        Category::create([
            'name' => $request->name
        ]);
        session()->flash('success', "Category '$request->name' created successfully");
//        return redirect('/categories');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
//        return view('categories.edit');
//        return view('categories.edit')->with('category', Category::find($id));
//        return view('categories.edit')->with('category', $category);
        return view('categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, $id)
//    {
//        //
//        dd($request);
//    }

    public function update(UpdateCategoryRequest $request, Category $category) // using route model binding using type hinting
    {
//        $this->validate(request(), [
//            'name' => 'required|min:6|max:12',
//            'description' =>'required'
//        ]);
//        $data = $request->all();
//        $category = Category::find($id);
//        $category->name = $request->name; //using route model binding
//        $category->save();
        $category->update([
            'name' => $request->name
        ]);
        session()->flash('success', 'Category updated successfully.');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $postcount = $category->posts->count();
        if ($postcount > 0) {
            session()->flash('error', "Category '$category->name' cannot be deleted because it is being used in $postcount post(s).");
            return redirect()->back();
        }
        $category->delete();
        session()->flash('success', "Category '$category->name' deleted successfully.");
        return redirect(route('categories.index'));
    }
}
