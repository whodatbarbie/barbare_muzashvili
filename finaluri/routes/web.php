<?php

use Illuminate\Support\Facades\Route;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// MAIN PAGE
Route::get('/', function () {
    $quizzes = Quiz::where('approved', 1)->orderBy('created_at', 'desc')->get();
    $questions = Question::all();
    $user = User::all();
    return view('main-page', compact('quizzes', 'questions', 'user'));
});


// ADMIN PANEL / ACCOUNT PANEL 
Route::get('/account', function(){
    if(Auth::check())
    {$currentAccount = User::where('id', Auth::id())->first();
    $currentQuizzes = Quiz::where('user_id',  Auth::id())->get();
    $currentQuestions = Question::where('user_id',  Auth::id())->get();
    $allQuizzes = Quiz::all();
    $allQuestions = Question::all();
    $allAccounts = User::where('id', '!=', 1);
    return view('admin', compact('currentAccount', 'currentQuizzes', 'currentQuestions', 'allQuizzes', 'allQuestions', 'allAccounts'));}
});

// REGISTRATION
Route::get('/register', function(){
    return view('register');
});

Route::post('/sign-up', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// SIGN IN
Route::get('/sign-in', function(){
    return view('sign-in');
});


// SINGLE-QUIZ PAGE
Route::get('/single-quiz/{id}', function ($id) {
    if(Auth::check()){
    $quiz = Quiz::where('id', $id)->first();
    $allquests = Question::where('quiz_id', $id)->get();
    return view('single-quiz', compact(['quiz', 'allquests']));}
})->name('single-quiz');

// FETCH DATA FROM THIS API
Route::get('/quizzy-api/{id}', function($id){
    $questions = Question::where('id', $id)->get();
    return $questions;
});

// FETCH QUIZ  DATA FROM THIS API
Route::get('/quizzy-api-quiz/{id}', function($id){
    $quiz = Question::where('quiz_id', $id)->orderBy('position', 'asc')->get();
    return $quiz;
});


// CREATE-QUIZ PAGE
Route::get('/create-quiz/', function(){
    if(Auth::check()){
        return view('create-quiz');
    }
});

Route::post('/add-quiz', function(Request $request){
    $quiz = new Quiz;
    $quiz->title = $request->title;
    $quiz->description = $request->description;
    $quiz->image = $request->image;
    $quiz->user_id = Auth::id();
    $quiz->save();
    return redirect('/add-question/' . strval($quiz->id));
});

Route::get('/add-question/{id}', function($id){
    if(Auth::check()){
        return view('add-question', compact('id'));
    }
});


Route::post('/add-quest/{id}', function(Request $request, $id){
    $question = new Question;
    $question->question = $request->question;
    $question->image = $request->image;
    $question->answers = json_encode([
        [ 'text' => $request->answer1 ],
        [ 'text' => $request->answer2 ], 
        [ 'text' => $request->answer3 ], 
        [ 'text' => $request->answer4 ]
    ]);
    $question->correct_answer = $request->correct_answer;
    $question->quiz_id = $id;
    $question->user_id = Auth::id();
    $question->position = $request->position;
    $question->save();

    return redirect('/add-question/' . strval($question->quiz_id));
});



// DELETE QUIZ

Route::post('/delete-quiz/{id}', function(Request $request, $id){

    if(Quiz::where('id', $id)->first()->user_id === Auth::id() || Auth::id() === 1){
        $ganwiruli = Quiz::where('id', $id)->first();
        $ganwiruli->delete();
        return redirect('/account');
    }
        
    return response()->json(['message' => 'THE QUIZ CAN ONLY BE DELETED BY IT\'S AUTHOR']);
});


// EDIT QUIZ
Route::get('edit-page/{id}', function($id){
    if(Auth::check())
       { $quiz = Quiz::where('id', $id)->first();
        return view('edit-page', compact('quiz','id'));}
});
Route::post('/edit-quiz/{id}', function(Request $request, $id){

    if(Quiz::where('id', $id)->first()->user_id === Auth::id() || Auth::id() === 1){
        $ganwiruli = Quiz::where('id', $id)->first();
        $ganwiruli->update([
            'title' => "$request->title",
            'description' => "$request->description",
            'image' => "$request->image"
         ]);

        return redirect('/account');
    }
        
    return response()->json(['message' => 'THE QUIZ CAN ONLY BE EDITED BY IT\'S AUTHOR']);
});


// DELETE QUESTION

Route::post('/delete-question/{id}', function(Request $request, $id){

    if(Question::where('id', $id)->first()->user_id === Auth::id() || Auth::id() === 1){
        $ganwiruli = Question::where('id', $id)->first();
        $ganwiruli->delete();
        return redirect('/account');
    }
        
    return response()->json(['message' => 'THE question CAN ONLY BE DELETED BY IT\'S AUTHOR']);
});


// EDIT QUESTION
Route::get('edit-question/{id}', function($id){
    if(Auth::check())
        {$question = Question::where('id', $id)->first();
        $quizzes = Quiz::where('user_id', Auth::id())->get();
        return view('edit-question', compact('question','id', 'quizzes'));
}
   
});

Route::post('/edit-question-post/{id}', function(Request $request, $id){

    if(Question::where('id', $id)->first()->user_id === Auth::id()  || Auth::id() === 1){
        $ganwiruli = Question::where('id', $id)->first();
        $ganwiruli->update([
            'question' => "$request->question",
            'image' => "$request->image",
            'position' => "$request->position",
            'answers' => json_encode([
                [ 'text' => $request->answer1 ],
                [ 'text' => $request->answer2 ], 
                [ 'text' => $request->answer3 ], 
                [ 'text' => $request->answer4 ]
            ]),
            'correct_answer' => "$request->correct_answer",
            'quiz_id' => $request->parent_quiz
         ]);

        return redirect('/account');
    }
        
    return 'ONLY AUTHOR OF THE QUESTION CAN EDIT THE QUESTION';
});


Route::post('/approve/{id}', function(Request $request, $id){
    $forApproval = Quiz::where('id', $id)->first();
    $forApproval->update(['approved'=>1]);
    return redirect('/account');

});
