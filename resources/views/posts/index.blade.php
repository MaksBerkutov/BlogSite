@extends('layouts.menu')
@section('title','Posts')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/post.css')}}">
@endsection

@section('content')
    <div class="container">


    </div>
    @foreach($posts as $post)
        <div class="card">
            <div class="card-header">
                <img src="data:image/png;base64, {{$post->image}}" alt="image" />
            </div>
            <div class="card-body">
                <span class="tag tag-purple">{{$post->tag}}</span>

                <h4>
                    {{$post->short_text}}
                </h4>
                <p class="cuttedText">
                    {{$post->description}}
                </p>
                <div class="user">
                    <img src="https://lh3.googleusercontent.com/ogw/ADGmqu8sn9zF15pW59JIYiLgx3PQ3EyZLFp5Zqao906l=s32-c-mo" alt="user" />
                    <div class="user-info">
                        <h5>{{$post->author_name}}</h5>
                        <small>Yesterday</small>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
