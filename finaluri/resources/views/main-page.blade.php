<!doctype html>
<html lang="en">

<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
  
  <header>
    
    <nav >
      <div >
          @if(Auth::check())
          <form  method="POST" action="/logout">
            @csrf
            <a id="sign-in-btn"  href="/account">Quiz Panel</a>
            <button type='submit' id="register-btn" >Log out</button>
          </form>
          @else
          <form >
            <a id="sign-in-btn"  href="/sign-in">Log In</a>
            <a id="register-btn"  href="/register">Register</a>
          </form>
          @endif
        </div>
      </div>
    </nav>
  </header>


          <div >
              <a type="button" href='/create-quiz'>Create Quizz</a>
          
          </div>

   <div id="quiz-go" style="display:flex; flex-direction:column;">
    @foreach($quizzes as $quiz)
      <div >
        <div >
          <img src="{{ $quiz->image }}"  alt="Card image cap">
          <div >
            <a href="{{ route('single-quiz', ['id' => $quiz->id]) }}"><h5 class="card-title">{{ $quiz->title }}</h5></a>
            <p class="card-text">{{ $quiz->description }}</p>
          </div>
          <div >
            <small >Questions: {{ $questions->where('quiz_id', $quiz->id)->count() }}</small>
          </div>
        </div>
        @endforeach
   </div>
  </main>
  <footer>
  </footer>

  
</body>

</html>