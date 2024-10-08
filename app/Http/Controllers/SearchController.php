<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(request $request)
    {

        $query = $request->input('query');
        $tag = $request->input('tag');
        $posts  = DB::table('posts')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->leftJoin('likes', 'posts.id', '=', 'likes.post_id')
            ->select(
                'posts.*',
                'users.name as author_name',
                'users.image as author_image',
                'users.updated_at as author_updated_at',
                DB::raw('COUNT(likes.id) as total_likes'),
                DB::raw('IFNULL(MAX(likes.user_id = ' . Auth::id() . '), 0) as user_liked')
            )->where('short_text', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->where('tag', 'LIKE', "%{$tag}%")
            ->groupBy('posts.id', 'users.id')
            ->get();



        return view('search.index', compact('posts', 'query','tag'));
    }

}
