@extends('layouts.menu')
@section('title',ucwords($post->tag)." Posts")

@section('content')
    <div class="card"  >
        <div class="card-header">
            <img src="data:image/png;base64, {{$post->image}}" alt="image" class="img-fluid" />
        </div>
        <div class="card-body">
            <span class="badge bg-primary">{{ucwords($post->tag)}}</span>

            <h4>{{$post->short_text}}</h4>

            <p>{{$post->description}}</p>
            <div class="d-flex align-items-center">
                <form action="/post/{{$post->id}}/{{$post->user_liked?'unlike':'like'}}" method="POST" class="like-form d-flex align-items-center">
                    @csrf
                    <button type="submit" class="btn p-0 me-2 like-button">
                        @if($post->user_liked)
                            <ion-icon name="heart" class="text-danger" style="font-size: 24px;"></ion-icon>
                        @else
                            <ion-icon name="heart-outline" class="text-danger" style="font-size: 24px;"></ion-icon>
                        @endif
                    </button>
                </form>
                <span class="like-count">{{ $post->total_likes }}</span>
            </div>
            <div class="user d-flex align-items-center mb-3">
                <img src="data:image/png;base64,{{$post->author_image}}" alt="user" class="rounded-circle" width="40" />
                <div class="ms-3">
                    <h5 class="mb-0">{{$post->author_name}}</h5>
                    <small>Published: {{ $post->created_at}}</small>
                </div>
            </div>

            <div class="comments-section mt-4">
                <h5>Комментарии ({{ count($comments) }})</h5>
                <ul class="list-group list-group-flush">
                    @foreach($comments as $comment)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $comment->user_name }}</strong>
                                <small>{{ $comment->created_at->format('d M Y, H:i') }}</small>
                            </div>
                            <p>{{ $comment->text }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="add-comment mt-4">
                <h5>Добавить комментарий</h5>
                <form action="{{route('comment.create')}}" method="POST">
                    @csrf
                    <input hidden name="post_id" value="{{$post->id}}">
                    <input hidden name="user_id" value="{{Auth::user()->id}}">
                    <input hidden name="user_name" value="{{Auth::user()->name}}">
                    <div class="form-group mb-3">
                        <textarea name="text" class="form-control @error('text') is-invalid @enderror" rows="3" placeholder="Напишите комментарий..." required></textarea>
                        @error('text')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>

@endsection
