@extends('layouts.menu')
@section('title','Vote Create')
@section('content')
    <form method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название опроса</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>

        <div id="questions-container">
            <div class="question-block">
                <h5>Вопрос 1</h5>
                <div class="mb-3">
                    <label for="question" class="form-label">Текст вопроса</label>
                    <input type="text" class="form-control" name="questions[0][text]" required>
                </div>
                <div id="answers-0" class="answers-block">
                    <div class="mb-3">
                        <label for="answer" class="form-label">Ответ 1</label>
                        <input type="text" class="form-control" name="questions[0][answers][]" required>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="addAnswer(0)">Добавить ответ</button>
            </div>
        </div>

        <button type="button" class="btn btn-success mt-3" onclick="addQuestion()">Добавить вопрос</button>

        <button type="submit" class="btn btn-primary mt-3">Сохранить опрос</button>
    </form>

    <script>
        let questionCount = 1;

        function addQuestion() {
            const container = document.getElementById('questions-container');
            const newQuestion = `
            <div class="question-block">
                <h5>Вопрос ${questionCount + 1}</h5>
                <div class="mb-3">
                    <label for="question" class="form-label">Текст вопроса</label>
                    <input type="text" class="form-control" name="questions[${questionCount}][text]" required>
                </div>
                <div id="answers-${questionCount}" class="answers-block">
                    <div class="mb-3">
                        <label for="answer" class="form-label">Ответ 1</label>
                        <input type="text" class="form-control" name="questions[${questionCount}][answers][]" required>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="addAnswer(${questionCount})">Добавить ответ</button>
            </div>
        `;
            container.insertAdjacentHTML('beforeend', newQuestion);
            questionCount++;
        }

        function addAnswer(questionIndex) {
            const answersBlock = document.getElementById('answers-' + questionIndex);
            const answerCount = answersBlock.getElementsByClassName('mb-3').length;
            const newAnswer = `
            <div class="mb-3">
                <label for="answer" class="form-label">Ответ ${answerCount + 1}</label>
                <input type="text" class="form-control" name="questions[${questionIndex}][answers][]" required>
            </div>
        `;
            answersBlock.insertAdjacentHTML('beforeend', newAnswer);
        }
    </script>

@endsection
