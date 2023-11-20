const answers = document.querySelectorAll('.answer');
const trueAnswer = document.querySelector('.true-answer');
const falseAnswers = document.querySelectorAll('.false-answer');
const nextQuestion = document.getElementById('next-question');
const progressBar = document.getElementById('progressBar');

const totalQuestions = 10;
const segment = 100 / totalQuestions;

let currentQuestion = 0;
let progressValue = 0;



function incrementProgress(isCorrect) {
    if (isCorrect) {
        progressValue += 10; 
        progressBar.value = progressValue;
        localStorage.setItem('progressValue', progressValue);

        if (progressValue > 100) {
            progressBar.value = 0;
            localStorage.removeItem('progressValue');
        }
        
    }
}

let storedProgressValue = localStorage.getItem('progressValue');
if (storedProgressValue) {
    progressValue = parseInt(storedProgressValue);
    progressBar.value = progressValue;
}

for (let i = 0; i < answers.length; i++) {
    answers[i].addEventListener('click', () => {
        trueAnswer.style.backgroundColor = "#50C6AA";
        for (let j = 0; j < falseAnswers.length; j++) {
            falseAnswers[j].style.backgroundColor = "#C73F4A";
        }
        incrementProgress(true);
        nextQuestion.style.visibility = "visible";
    });
}