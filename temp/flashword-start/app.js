// Define the options of our application
const FlashWord = {
    data() {
        return {
            wordA: 'hola',
            wordB: 'hello',
            answer: '',
            correct: null,
            showFeedback: false,
        }
    },
    methods: {
        checkAnswer() {
            // Note how data properties are accessed via `this`
            this.correct = this.answer == this.wordB;
            this.showFeedback = true;
        }
    }
}

// Create a new Vue instance using our options
const app = Vue.createApp(FlashWord).mount('#app');