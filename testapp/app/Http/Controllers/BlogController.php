<?php
//Hello World trying to commit
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function deletetBolg(Post $post) {
         if (auth()->user()->id === $post['user_id']) {
            $post->delete();
         }
         return redirect('/');
    }

    public function editBolg(Request $request, Post $post) {
         if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
         }

         $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
         ]);

         $data['title'] = strip_tags($data['title']);
         $data['body'] = strip_tags($data['body']);

         $post->update($data);
         return redirect('/');

    }
    public function showEditBolg(Post $post) {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' =>$post]);
    }
    public function createPost(Request $request) {
         $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
         ]);

         $incomingFields['title'] = strip_tags($incomingFields['title']);
         $incomingFields['body'] = strip_tags($incomingFields['body']);
         //Feferencing the pk of the user 
         $incomingFields['user_id'] = auth()->id();
         //Create a model
         Post::create($incomingFields);
         return redirect('/');
    }
}
