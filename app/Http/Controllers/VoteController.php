<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Result;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
   function index(){
       $surveys = Vote::with('questions')->get();

       return view('vote.index', compact('surveys'));
   }
    public function show($id)
    {
        $survey = Vote::with('questions.answers')->findOrFail($id);

        $userHasVoted = Result::where('user_id', Auth::id())
            ->where('vote_id', $id)
            ->exists();

        return view('vote.show', compact('survey', 'userHasVoted'));
    }
   function vote(Request $request,$id){
       $userHasVoted = Result::where('user_id', Auth::id())
           ->where('vote_id', $id)
           ->exists();

       if ($userHasVoted) {
           return redirect()->route('vote.show', $id)->with('error', 'Вы уже проголосовали за этот опрос.');
       }

       $answers = $request->input('answers');

       foreach ($answers as $questionId => $answerId) {
           Result::create([
               'user_id' => Auth::id(),
               'vote_id' => $id,
               'question_id' => $questionId,
               'answer_id' => $answerId
           ]);
       }

       return redirect()->route('vote.show', $id)->with('success', 'Ваш голос успешно сохранён!');

   }
    function create(){
        return view('vote.create');
    }
    function create_action(request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*.text' => 'required|string|max:255',
            'questions.*.answers' => 'required|array',
            'questions.*.answers.*' => 'required|string|max:255',
        ]);

        $survey = Vote::create(['title' => $request->input('title')]);

        foreach ($request->input('questions') as $questionData) {
            $question = Question::create([
                'vote_id' => $survey->id,
                'question_text' => $questionData['text'],
            ]);

            foreach ($questionData['answers'] as $answerText) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $answerText,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Опрос успешно создан!');
    }
}
