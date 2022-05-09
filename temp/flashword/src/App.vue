<script setup lang="ts">
// When using SFC with <script setup>, imported components are automatically registered locally:

import { ref, reactive, watch } from 'vue';
import WordCard from './components/WordCard.vue';
import { words as data } from './data/words.js';

// Declaring as constants because they are objects that won't change
// What changes is their inner value
const words = ref(data); 
const answer = ref('');
const correctCount = ref(0);
const completed = ref(false);
const wordCount = Object.keys(words.value).length;

watch(correctCount, async (newValue) => {
    if(correctCount.value == wordCount) {
        completed.value = true;
    }
})

function reset() {
    console.log(answer.value);
    correctCount.value = 0;
    answer.value = '';
}

</script>

<template>
 
    <h1>FlashWord</h1>

    <button v-on:click='reset'>Reset</button>

    <div v-if='completed' id='completed'>Good work, you completed all the words!</div>

    <div id='correctCount' v-else>
        You’ve correctly answered {{ correctCount }} out of {{ wordCount }} words
    </div>

    <div id='cards'>
        <WordCard 
            v-for='word in words' 
            v-bind:wordA='word.word_a' 
            v-bind:wordB='word.word_b'
            v-bind:answer='answer.value'
            v-on:incrementCorrectCount='correctCount++'>
        </WordCard>
    </div>
  
</template>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: black;
    margin-top: 60px;
}

#completed {
    font-size:20px;
    font-weight:bold;
    color: #0f5132;
    padding:10px;
    margin:10px;
}

#correctCount {
    font-size:20px;
    margin:10px;
    font-weight:bold;
    padding:10px;
}

#cards {
    justify-content: center;
    display: grid;
    /* specifies the number (and the widths) of columns in a grid layout */
    grid-template-columns: 300px 300px 300px;
    grid-gap: 30px;
}
</style>
