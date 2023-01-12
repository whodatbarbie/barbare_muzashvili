<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

  </head>
<body class="bg-dark">
<main >
    @if(Auth::id() !== 1)
    <div id='dissapear-quiz'>
    @foreach($currentQuizzes as $quiz)
        <div>
            
            <div >
                <h5>{{$quiz->title}}</h5>
                <p >{{$quiz->description}}</p>

                <div >
                    <a href="/edit-page/{{$quiz->id}}" >Edit</a>
                    <form action="/delete-quiz/{{$quiz->id}}" method="POST">
                        @csrf
                        <button type="submit" >Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    </div>

    <div id='dissapear-question'>
        @foreach($currentQuestions as $question)
            <div>
                
                <div>
                    <h5 >{{$question->question}}</h5>
                    <p ><strong>FOR</strong>: {{$currentQuizzes->where('id', $question->quiz_id)->first()->title}}</p>
    
                    <div >
                        <a href="/edit-question/{{$question->id}}">Edit</a>
                        <form action="/delete-question/{{$question->id}}" method="POST">
                            @csrf
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        @else
        <div id='dissapear-quiz'>
            @foreach($allQuizzes as $quiz)
                @if($quiz->approved)
                <div>
                    
                    <div>
                        <h5 >{{$quiz->title}}</h5>
                        <p >{{$quiz->description}}</p>
        
                        <div style="display: flex; flex-direction: row;">
                            <a href="/edit-page/{{$quiz->id}}" class="btn me-2 btn-outline-dark">Edit</a>
                            <form action="/delete-quiz/{{$quiz->id}}" method="POST">
                                @csrf
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            </div>
        
            <div id='dissapear-question'>
                @foreach($allQuestions as $question)
                    <div>
                        
                        <div>
                            <h5 >{{$question->question}}</h5>
                            <p ><strong>FOR</strong>: {{$allQuizzes->where('id', $question->quiz_id)->first()->title}}</p>
            
                            <div>
                                <a href="/edit-question/{{$question->id}}" >Edit</a>
                                <form action="/delete-question/{{$question->id}}" method="POST">
                                    @csrf
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id='dissapear-approvals'>
                @foreach($allQuizzes->where('approved', 0) as $quiz)
                    <div class="card m-3">
                        
                        <div>
                            <h5 >{{$quiz->title}}</h5>
                            <p >{{$quiz->description}}</p>
            
                            <div>
                                <form action="/approve/{{$quiz->id}}" method="POST">
                                    @csrf
                                    <button type="submit" >Approve</button>
                                </form>
                                <form action="/delete-quiz/{{$quiz->id}}" method="POST">
                                    @csrf
                                    <button type="submit" >Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        @endif

        


</main>

</body>
</html>