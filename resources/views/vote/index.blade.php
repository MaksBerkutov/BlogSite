@extends('layouts.menu')
@section('title','Votes')
@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach($surveys as $survey)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title">{{ $survey->title }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Количество вопросов: {{ $survey->questions->count() }}</p>
                            <a href="{{ route('vote.show', $survey->id) }}" class="btn btn-outline-primary">Просмотреть вопросы</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

