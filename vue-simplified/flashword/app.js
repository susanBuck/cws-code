const FlashWord = {
    data() {
        return {
            words:
                [
                    {
                        word_a: 'hola',
                        word_b: 'hello',
                        hint: 'greeting',
                        answer: '',
                        correct: false
                    },
                    {
                        word_a: 'uno',
                        word_b: 'one',
                        hint: 'number',
                        answer: '',
                        correct: false
                    },
                    {
                        word_a: 'gris',
                        word_b: 'grey',
                        hint: 'color',
                        answer: '',
                        correct: false
                    },
                ],
            correctCount: 0,
            completed: false
        }
    },
    computed: {
        shuffledWords() {
            return this.words.sort(() => .5 - Math.random());
        },
        wordCount() {
            return this.words.length;
        }
    },
    watch: {
        correctCount() {
            this.completed = this.correctCount == this.wordCount;
        }
    },
    methods: {
        checkAnswer(word) {
            word.correct = word.word_b == word.answer;

            if (word.correct) {
                this.correctCount++;
            }
        }
    }
}

const app = Vue.createApp(FlashWord).mount('#app');
