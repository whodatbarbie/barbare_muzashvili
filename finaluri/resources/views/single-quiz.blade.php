<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{{ asset('css/main3.css') }}" rel="stylesheet" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-dark">

    <div>
      <a  id='start-quiz-button' onclick="check({{ $quiz->id }})">Start Quiz</a>
      <a  id='go-back-button' href="/">Go Back</a>
    </div>
  <div id="main">
  </div>
    
  <footer>
      
  </footer>

<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>