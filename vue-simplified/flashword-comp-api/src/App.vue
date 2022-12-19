<script setup>
import { ref, computed, watchEffect } from 'vue'
import WordCard from './components/WordCard.vue'

// Data properties
const correctCount = ref(0);
const correct = ref(false);
const completed = ref(false);
const words = ref([
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
]);

// Computed properties
const shuffledWords = computed(() => {
    return words.value.sort(() => .5 - Math.random());
});

const wordCount = computed(() => {
    return words.value.length;
});

// Watchers
watchEffect(correctCount => {
    completed.value = correctCount.value == wordCount.value;
});

// Methods
const incrementCorrectCount = () => {
    correctCount.value++;
}
</script>

<template>
  <h1>FlashWord</h1>

        <p v-if='completed' id='completed'>Great work, you completed all the words!</p>
        <p v-else id='correctCount'>You have answered {{ correctCount }} out of {{ wordCount }}</p>

        <div id='cards'>
            <WordCard v-for='word in shuffledWords' v-bind:word='word' v-on:incrementCorrectCount='incrementCorrectCount'></WordCard>
        </div>
</template>

<style>
[v-cloak] {
    display: none;
}

#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: black;
    margin-top: 60px;
}

#cards {
    justify-content: center;
    display: grid;
    grid-template-columns: 300px 300px 300px;
    grid-gap: 30px;
}

#correctCount {
    font-size: 20px;
    margin: 10px;
    font-weight: bold;
    padding: 10px;
}

#completed {
    font-size: 20px;
    font-weight: bold;
    color: #0f5132;
    padding: 10px;
    margin: 10px;
}
</style>
