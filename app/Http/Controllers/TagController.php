<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {

        $this->middleware('auth');
    }

    public function index()
    {
        $tags = Tag::all();
        return view('tags.index')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create' , $tag);
        $this->validate($request , [
            'name' => 'required|max:255'
        ]);

        $tag = new Tag ;
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tags.index')->with('success' , 'Your tag has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $tag = Tag::find($id);
        $this->authorize('update' , $tag);

        return view('tags.edit')->withTag($tag);
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

        $tag = Tag::find($id);
        $this->authorize('update' , $tag);

        $this->validate($request , [
            'name' => 'required|max:255'
        ]);

        $tag->name = $request->input('name');
        $tag->save();

        return redirect()->route('tags.show' , $tag->id)->with('success' , 'Successfully save your new tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $tag = Tag::find($id);

        $this->authorize('delete' , $tag);

        $tag->posts()->detach();

        $tag->delete();
        return redirect()->route('tags.index')->with('success' , 'Tag was deleted successfully');
    }
}
