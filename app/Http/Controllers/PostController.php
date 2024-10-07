<?php

namespace App\Http\Controllers;

use App\Models\Post;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index(){
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }
    private function ConvertToBase64( $file):string{
        $fileContents = file_get_contents($file);

        return base64_encode($fileContents);
    }
    function create()
    {
        return view('posts.create');
    }
    function create_action(request $request)
    {
        $request->validate([
            'short_text' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tag' => ['required','max:30'],
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg','max:2048']
        ]);
        $image = $this->ConvertToBase64($request->file('image'));
        $keys  = $request->all();
        Post::create([
            "author_id"=>$request->user()->id,
            "author_name"=>$request->user()->name,
            "short_text"=>$keys["short_text"],
            "description"=>$keys["description"],
            "tag"=>$keys["tag"],
            "image"=>$image
        ]);
        return redirect('/post');
    }
}
