@extends('layouts.menu')
@section('title','Posts')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/post.css')}}">
@endsection

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <x-post-card :post="$post"/>
        @endforeach
    </div>
@endsection
