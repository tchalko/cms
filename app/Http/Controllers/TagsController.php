<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagsRequest;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Tags\CreateTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        // for below 3 commented lines, the array has been moved to custom request CreateTagRequest.php
//        $this->validate($request, [
//            'name' => 'required|unique:tags'
//        ]);
        Tag::create([
            'name' => $request->name
        ]);
        session()->flash('success', "Tag '$request->name' created successfully");
//        return redirect('/tags');
        return redirect(route('tags.index'));
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
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
//        return view('tags.edit');
//        return view('tags.edit')->with('tag', Tag::find($id));
//        return view('tags.edit')->with('tag', Tag);
        return view('tags.create')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Tags\UpdateTagsRequest  $request
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagsRequest $request, Tag $tag) // using route model binding using type hinting
    {
//        $this->validate(request(), [
//            'name' => 'required|min:6|max:12',
//            'description' =>'required'
//        ]);
//        $data = $request->all();
//        $tag = Tag::find($id);
//        $tag->name = $request->name; //using route model binding
//        $tag->save();
        $tag->update([
            'name' => $request->name
        ]);
        session()->flash('success', 'Tag updated successfully.');
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tag  tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $postcount = $tag->posts->count();
        if ($postcount > 0) {
            session()->flash('error', "Tag '$tag->name' cannot be deleted because it is being used in $postcount post(s).");
            return redirect()->back();
        }
        $tag->delete();
        session()->flash('success', "Tag '$tag->name' deleted successfully.");
        return redirect(route('tags.index'));
    }
}
