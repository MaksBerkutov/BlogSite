@extends('layouts.menu')
@section('title','Create Posts')

@section('content')
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <div class="container">
        <h1 class="text-center my-4">Создать пост</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{route('post.create')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-default-form-input type="text" name="short_text"/>
                    <div class="mb-3">
                        <label for="description" class="form-label">Text</label>
                        <textarea class="form-control" id="text" name="description" placeholder="Input text" rows="6" required></textarea>
                    </div>
                    <x-default-form-input type="text" name="tag"/>

                    <div class="mb-3">
                        <label for="image" class="form-label">Choose image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Создать пост</button>
                </form>
            </div>
        </div>
    </div>
@endsection

