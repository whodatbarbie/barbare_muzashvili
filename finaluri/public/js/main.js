const cover = document.querySelector('.cover');
const startQuiz = document.querySelector('#start-quiz-button');

const main = document.querySelector('#main');
let counter = 0;
let correct = 0;
let incorrect = 0;



startQuiz.addEventListener('click', function(e){
  cover.classList.toggle('hidden');
  main.innerHTML = '';
})

function check(id) {
  fetch('/quizzy-api-quiz/' + id)  
      .then((response) => response.json())
      .then((data) => {
          if (counter+1 <= data.length){
            
          const element = data[counter]; 
          console.log(typeof(element.quiz_id))
          main.innerHTML = `<div class="sdw p-4 mb-5 bg-white">
          <h2>${element.question}</h2>
      </div>  
        <div>
            <img src="${element.image}" alt="...">
        </div>
        <div class="answers-container">
            <a role="button" onclick="checkAnswer(${ element.id }, '${JSON.parse(element.answers)[0].text}', ${ element.quiz_id })"><span>${JSON.parse(element.answers)[0]['text']}</span></a>
            <a role="button"  onclick="checkAnswer(${ element.id }, '${JSON.parse(element.answers)[1].text}', ${ element.quiz_id })"><span>${JSON.parse(element.answers)[1].text}</span></a>
        </div>
        <div class="answers-container">
          <a role="button"  onclick="checkAnswer(${ element.id }, '${JSON.parse(element.answers)[2].text}', ${ element.quiz_id })"><span>${JSON.parse(element.answers)[2].text}</span></a>
          <a role="button"  onclick="checkAnswer(${ element.id }, '${JSON.parse(element.answers)[3].text}', ${ element.quiz_id })"><span>${JSON.parse(element.answers)[3].text}</span></a>
        </div>
        <div>
          <p>Question: ${counter+1}/${data.length}</p>
      </div>
      `
        ;
      }
      else{
        const winner = correct >= incorrect ? 'greenbg' : 'redbg';
        if(winner)
        main.innerHTML = `
        <div id=${winner} class="sdw p-4 mb-5 h-100 w-100 finish-info">
          <h2 class"question-count">Score: ${correct}/${counter}</h2>
          <a id="go-back-end" class="answer-btn" href="/">Go Back</a>
        </div>`
      }
        
    });
  }


function checkAnswer(id, answer, quiz_id) {
  fetch('/quizzy-api/' + id)  
      .then((response) => response.json())
      .then((data) => {
          if (data[0]['correct_answer'] === answer) {
            main.innerHTML = `<div class="cover-answer-correct">
            <h1 id="correct-text"'> Correct! </h1>
            </div>`;
              correct++
          } else {
              main.innerHTML = `<div class="cover-answer-incorrect">
              <h1 id="wrong-text"> Wrong! </h1>
              </div>`;
              incorrect++
          }
          
      });
  
  counter++;
  function checker(){checkQuiz(quiz_id)};
  setTimeout(checker, 1000)
  
  
}







// onclick="checkAnswer({{ $question->id }}, '{{ $answer->text }}')"

