<!DOCTYPE html>
<html lang="en" class="w-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
</head>
<body >
    <form action="/edit-question-post/{{ $id }}" method="POST">
      @csrf
      <div id="question-container">
        <div >
          <label for="question">Question</label>
          <input name='question' type="text" id="question" value="{{ $question->question }}"></input>
          <label for="image">Image</label>
          <input name='image' type="text"  id="image" value="{{ $question->image }}"></input>
          <label for="position">Position</label>
          <input name='position' type="number"  id="position" value="{{ $question->position }}"></input>

          <div class="answer-cont">
            <label for="answers" >Answers</label>
            <input name='answer1' type="text"  id="answer" value="{{ json_decode($question->answers)[0]->text }}"></input>
            <input name='answer2' type="text"  id="answer" value="{{  json_decode($question->answers)[1]->text }}"></input>
            <input name='answer3' type="text"  id="answer" value="{{  json_decode($question->answers)[2]->text }}"></input>
            <input name='answer4' type="text"  id="answer" value="{{  json_decode($question->answers)[3]->text}}"></input>
            <label for="answers" >Correct Answer</label>
            <input name='correct_answer' type="text"  id="answer" value="{{ $question->correct_answer }}"></input>
          </div>
          <label for="parent_quiz">Quiz</label>
            <select name="parent_quiz" id="parent_quiz" >
                @foreach($quizzes as $quiz)
                    <option value='{{ $quiz->id }}'>{{ $quiz->title }}</option>
                @endforeach
            </select>
        </div>
      </div>
          <button type="submit" >Submit</button>
          <div>
            <a href="/" id='add-question-button'>Finish</a>
          </div>
      </form>

   
</body>
</html>