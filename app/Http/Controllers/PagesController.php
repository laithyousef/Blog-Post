<?php


namespace App\Http\Controllers ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Post;

class PagesController extends Controller {

    public function getIndex() {
        $posts = Post::orderBy('created_at' , 'desc')->limit(4)->get();
        return view('pages.welcome')->withPosts($posts);
    }


    public function getContact() {
        return view('pages.contact');
    }

    public function postContact(Request $request) {

        $this->validate($request , [
            'email' => 'required|email',
            'subject' => 'min3',
            'message' => 'min:10'
        ]);
        
        $data = [
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        ];
        Mail::send('emails.contact' , $data , function($message) use($data) {
            $message->from($data['email']);
            $message->to('laithyousef129@gmail.com');
            $message->subject($data['subject']);
        });

        return redirect()->route('pages.welcome')->with('success' , 'Your email has been sent');
    }
}