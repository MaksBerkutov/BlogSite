<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommetController extends Controller
{
    public function Create(request $request){
        $request->validate([
            'text' => ['required', 'string'],
        ]);
        Comment::create($request->all());
        return redirect()->back();
    }
}
