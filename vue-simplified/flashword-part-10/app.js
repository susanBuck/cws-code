const FlashWord = {
    data() {
        return {
            completed: false,
            correctCount: 0,
            words: ['hola', 'adios', 'uno', 'dos', 'rojo', 'azul'],
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
                ]
        }
    },
    computed: {
        // Can't initialize wordCount dynamically, so we use a CP to do so
        wordCount() {
            return this.words.length;
        },
        // Derive a list of shuffled words from our words data property
        shuffledWords() {
            return this.words.sort(() => 0.5 - Math.random());
        }
    },
    methods: {
        checkAnswer(word) {
            word.correct = word.word_b == word.answer;

            if (word.correct) {
                this.correctCount++;
            }
        }
    },
    watch: {
        // Alternatively, we could have ran this expression within the checkAnswer method,
        // but this is an opportunity to demonstrate a watcher
        correctCount(count) {
            this.completed = count == this.wordCount;
        },
    }
}

const app = Vue.createApp(FlashWord).mount('#app');




/*
Show hint

*/