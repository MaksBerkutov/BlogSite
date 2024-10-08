@extends('layouts.menu')
@section('title','Posts')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/post.css')}}">
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/post">Search Blog</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form action="{{ route('post.search') }}" method="GET" class="d-flex ms-auto">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search..." aria-label="Search" value="{{ request()->input('query') }}">
                    <input class="form-control me-2" type="search" name="tag" placeholder="Tag..." aria-label="Tag" value="{{ request()->input('tag') }}">
                    <button class="btn btn-outline-success" type="submit">Искать</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        @foreach($posts as $post)
            <x-post-card :post="$post"/>
        @endforeach
    </div>
@endsection
