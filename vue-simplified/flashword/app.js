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
                ]
        }
    },
    computed: {
        shuffledWords() {
            return this.words.sort(() => .5 - Math.random());
        }
    },
    watch: {

    },
    methods: {

    }
}

const app = Vue.createApp(FlashWord).mount('#app');
