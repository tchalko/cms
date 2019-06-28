<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = POST::all();
        $trashed = false;
//        return view('posts.index')->with('posts', POST::all());
        return view('posts.index')->with(compact('posts','trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        // upload the image to storage
        $image = $request->image->store('posts');
        // create the post
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
//            'content' => $request->content,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category
        ]);
        // attach the tags to post_tag table, to show which tags are associated with this post
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        // flash message
        session()->flash('success', 'Post created successfully.');
        // redirect user
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) // use route model binding instead of just passing the post id
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'content', 'published_at', 'category']);
        // check if new image
        if ($request->hasFile('image')) {
            // upload it
            $image = $request->image->store('posts');
            // delete old one
//            Storage::delete($post->image);
            $post->deleteImage();
            $data['image'] = $image;
        }
        $post->category()->associate($request->category);
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }
        // update attributes
        $post->update($data);
        // flash message
        session()->flash('success', 'Post updated successfully.');
        // redirect user
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Post $post)
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed()) {
//            Storage::delete($post->image);
            $post->deleteImage();
            $post->forceDelete();
            $msg = "deleted";
            $rt = "trashed-posts.index";
        }
        else {
            $post->delete();
            $msg = "trashed";
            $rt = "posts.index";
        }
        session()->flash('success', "Post $msg successfully.");
        return redirect(route($rt));
    }

    /**
     * Display a list of all trashed posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
//        $trashed = Post::onlyTrashed()->get();
          $posts = Post::onlyTrashed()->get();
          $trashed = true;

//        return view('posts.index')->with('posts', $trashed);
//        return view('posts.index')->withPosts($trashed);
        return view('posts.index')->with(compact('posts','trashed'));
    }
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', 'Post restored successfully.');
        return redirect()->back();
    }
}
