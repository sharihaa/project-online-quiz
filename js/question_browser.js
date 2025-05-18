 function filterQuestions() {
      const typeFilter = document.getElementById('filter-type').value;
      const difficultyFilter = document.getElementById('filter-difficulty').value;
      const topicFilter = document.getElementById('filter-topic').value;
      const questions = document.querySelectorAll('#question-list li');

      questions.forEach(question => {
        const type = question.getAttribute('data-type');
        const difficulty = question.getAttribute('data-difficulty');
        const topic = question.getAttribute('data-topic');

        const typeMatch = !typeFilter || type === typeFilter;
        const difficultyMatch = !difficultyFilter || difficulty === difficultyFilter;
        const topicMatch = !topicFilter || topic === topicFilter;

        if (typeMatch && difficultyMatch && topicMatch) {
          question.style.display = 'block';
        } else {
          question.style.display = 'none';
        }
      });
    }