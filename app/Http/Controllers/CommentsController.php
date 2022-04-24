<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index')->withComment($comment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $post_id)
    {
        $this->validate($request , [
            'name'  => 'required|max:255',
            'email' => 'required|email',
            'comment' => 'required|max:2000'
        ]);

        $post = Post::find($post_id);

        $comment = new Comment;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = true ;
        $comment->post()->associate($post);

        $comment->save();
        return redirect()->route('blog.single' , [$post->slug])->with('success' , 'Your Comment has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        $this->authorize('update' , $comment);

        return view('comments.edit')->withComment($comment);
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

        $comment = Comment::find($id);
        $this->authorize('update' , $comment);

        $this->validate($request , [

            'comment' => 'required|max:2000|min:5'
        ]);

        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect()->route('posts.show' , $comment->post->id)->with('success' , 'Your Comment has been changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id){


        $comment = Comment::find($id);
        $this->authorize('delete' , $comment);

        return view('comments.delete')->withComment($comment);
    }

    public function destroy($id)
    {

        $comment = Comment::find($id);
        $post_id = $comment->post->id;
        $this->authorize('delete' , $comment);

        $comment->delete();

        return redirect()->route('posts.show' , $post_id)->with('success' , 'Your Comment has been deleted successfully');
    }
}
