<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private function ConvertToBase64($file):string{
        $fileContents = file_get_contents($file);

        return base64_encode($fileContents);
    }
    private function BuildQuery(  ):Builder{
        return DB::table('posts')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->leftJoin('likes', 'posts.id', '=', 'likes.post_id')
            ->select(
                'posts.*',
                'users.name as author_name',
                'users.image as author_image',
                'users.updated_at as author_updated_at',
                DB::raw('COUNT(likes.id) as total_likes'),
                DB::raw('IFNULL(MAX(likes.user_id = ' . Auth::id() . '), 0) as user_liked')
            );
    }
    public function likePost(Request $request, $postId)
    {
        $user = auth()->user();
        $post = Post::findOrFail($postId);

        if ($post->likedByUsers->contains($user)) {
            return redirect()->back();
        }

        $post->likedByUsers()->attach($user);
        return redirect()->back();
    }

    public function unlikePost(Request $request, $postId)
    {
        $user = auth()->user();
        $post = Post::findOrFail($postId);

        if (!$post->likedByUsers->contains($user)) {
            return redirect()->back();

        }

        $post->likedByUsers()->detach($user);

        return redirect()->back();

    }


    function index(){
        $posts = $this->BuildQuery()
            ->groupBy('posts.id', 'users.id')
            ->get();
        return view('posts.index', compact('posts'));
    }
    function create()
    {
        return view('posts.create');
    }
    function more(int $id){
        $post = $this->BuildQuery()->where('posts.id', '=', $id)
            ->groupBy('posts.id', 'users.id')
            ->first();

        if (!$post) {
            return response()->json(['message' => 'Пост не найден'], 404);
        }
        $comments = Comment::where('post_id', $id)->get();

        return view('posts.more', compact('post', 'comments'));
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
            "short_text"=>$keys["short_text"],
            "description"=>$keys["description"],
            "tag"=>$keys["tag"],
            "image"=>$image
        ]);
        return redirect('/post');
    }
}
