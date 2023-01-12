<!DOCTYPE html>
<html lang="en" class="w-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
</head>
<body >
    <form action="/add-quiz" method="POST">
      @csrf
        <div>
          <label for="quizImage">Image</label>
          <input name="image" type="text" class="form-control" id="quizImage">
        </div>
        <div>
          <label for="quizTitle">Title</label>
          <input name="title" type="text" class="form-control" id="quizTitle">
        </div>
        <div>
          <label for="quizDescription"> Description</label>
          <textarea name="description" class="form-control" id="quizDescription" rows="3"></textarea>
        </div>

          <button type="submit" >Submit</button>
      </form>

</body>
</html>