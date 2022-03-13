<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'text' => 'required'
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->text = $request->text;
        $post->employee_id = Session('loginId');
        $post->save();
        $posts = Post::all();
        return redirect('/dashboard')->with('success', 'Successfully');
    }

}
