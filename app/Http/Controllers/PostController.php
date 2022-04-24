<?php

namespace App\Http\Controllers;

use Image;
use Session;
use Storage;
use Purifier;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id' , 'desc')->paginate(10) ;

        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validate the data
        $this->validate($request, array(
            'title'    => 'required|max:255',
            'slug'     => 'required|alpha_dash|max:255|min:5|unique:posts,slug',
            'category_id' => 'required|integer' ,
            'body'     => 'required',
            'featured-image' => 'sometimes|image'
        ));


        //store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);
        $post->user_id = auth()->id();

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalName();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800 , 400)->save($location);
            $post->image = $filename;
        }
        

        $post->save();

        $post->tags()->sync($request->tags , false);

        Session::flash('success' , 'This blog post is been successfuly saved ');


        //redirect to another page
        return redirect()->route('posts.show' , $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::find($id);
        $this->authorize('update', $post);

        $categories = Category::all();
        $cats = array();
        foreach($categories as $category)
           $cats[$category->id] = $category->name ;

        $tags = Tag::all();
        $tags2 = array();
        foreach($tags as $tag)
           $tags2[$tag->id] = $tag->name ;

        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $tags = Tag::all();
        $category = Category::find($id);
        $post = Post::find($id);

        $this->authorize('update' , $post);


            $this->validate($request , [
                'title' => 'required | max:255' ,
                'slug' => "required |alpha_dash | max:266 | min:5 | unique:posts,slug,$id",
                'body' => 'required',
                'category_id' => 'required|integer' ,
                'featured-image' => 'sometimes|image'
            ]);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));
        $post->user_id = auth()->id();

        if($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800 , 400)->save($location);
            $oldFilename = $post->image;
            $post->image = $filename;
            Storage::delete($oldFilename);
        }

        $post->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags , true );
        } else {
            $post->tags()->sync(array());
        }

        return redirect()->route('posts.show' , $post->id)->with('success' , 'This post was successfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::find($id);
        $this->authorize('delete', $post);

        $post->tags()->detach();
        Storage::delete($post->image);

        $post->delete();

        Session::flash('success' , 'the Post has been deleated successfully');

        return redirect()->route('posts.index');
    }
}
