@extends('layouts.menu')
@section('title',$survey->title)
@section('styles')
    <link rel="stylesheet" href="{{asset('css/vote.show.css')}}">
@endsection
@section('content')
    <div class="container mt-5">
        <h3 class="mb-4">{{ $survey->title }}</h3>

        @if($userHasVoted)
            <div class="alert alert-info">
                Вы уже проголосовали за этот опрос.
            </div>
        @else
            <form action="{{ route('vote.vote', $survey->id) }}" method="POST">
                @csrf
                <div class="row">
                    @foreach($survey->questions as $question)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">{{ $question->question_text }}</h5>
                                </div>
                                <div class="card-body">
                                    @foreach($question->answers as $answer)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input custom-radio" type="radio" name="answers[{{ $question->id }}]" id="answer-{{ $answer->id }}" value="{{ $answer->id }}" required>
                                            <label class="form-check-label" for="answer-{{ $answer->id }}">
                                                {{ $answer->answer_text }}
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg mt-3">Отправить голос</button>
                </div>
            </form>
        @endif
    </div>


@endsection

