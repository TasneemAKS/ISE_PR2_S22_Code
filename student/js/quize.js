//hgjhgd
function nextQuestion(currentQuestion) {
    // Hide the current question
    document.getElementById("q" + currentQuestion).style.display = "none";
    // Show the next question
    var nextQuestion = currentQuestion + 1;
    document.getElementById("q" + nextQuestion).style.display = "block";
  }
//عداد الوقت 
  var count = 3600; // Exam duration in seconds (1 hour)
  var timer = setInterval(function() {
    count--;
    var minutes = Math.floor(count / 60);
    var seconds = count - minutes * 60;
    document.getElementById('time').innerHTML = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    if (count === 0) {
      clearInterval(timer);
      alert('انتهى الامتحان');
    }
  }, 1000);
  //السابق
  function previousQuestion(currentQuestion) {
    // Hide the current question
    document.getElementById("q" + currentQuestion).style.display = "none";
    // Show the next question
    var nextQuestion = currentQuestion -1;
    document.getElementById("q" + nextQuestion).style.display = "block";
  }
  //حفظ الإجابة
  function saveAnswer() {
    // حصل على قيمة الإجابة من المستخدم
    var answer = document.querySelector('input[name="q"]:checked').value;
    
    // حفظها مؤقتًا في المتغير الهيكلي
    var userAnswers = JSON.parse(localStorage.getItem('userAnswers')) || {};
    userAnswers['q'] = answer;
    localStorage.setItem('userAnswers', JSON.stringify(userAnswers));
 
}