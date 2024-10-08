<div class="card" >
    <div class="card-header">
        <img src="data:image/png;base64, {{$post->image}}" alt="image" />
    </div>
    <div class="card-body">
        <span class="tag tag-purple">{{ucwords($post->tag)}}</span>
        <a href="/post/{{$post->id}}">

            <h4>
                {{$post->short_text}}
            </h4>
            <p class="cuttedText">
                {{$post->description}}
            </p>
        </a>
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
        <div class="user">
            <img src="data:image/png;base64,{{$post->author_image}}" alt="user" />
            <div class="user-info">
                <h5>{{$post->author_name}}</h5>
                <small>{{$post->author_updated_at}}</small>
            </div>
        </div>
    </div>
</div>
