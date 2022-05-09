<script setup lang="ts">

import { ref, computed, watch } from 'vue';

const props = defineProps<{
    wordA: String,
    wordB: String,
    answer: String
}>();

//const answer = ref('');

const emit = defineEmits(['incrementCorrectCount'])

const isCorrect = computed(() => {
    if(props.answer == props.wordB) {
        return true;
    } else {
        return false;
    }
})

watch(isCorrect, async (newValue) => {
    if(isCorrect.value) {
        emit('incrementCorrectCount')
    }
})

</script>

<template>
    <div class='card' v-bind:class="{ correct: isCorrect }">
        <div class='word'>{{ wordA }}</div>
        <input type='text' v-if='!isCorrect' v-model='answer'>
        <p class='correctAnswer' v-else>{{ answer }}</p>
    </div>
</template>

<style scoped>

input[type=text] {
    border:0;
    font-size:25px;
    border-radius:5px;
    margin-top:5px;
    text-align:center;
    padding:5px;
}

.correctAnswer {
    padding:0;
    margin:0;
}

.word {
    font-weight:bold;
}

.card {
    background-color:#E8F0FF;
    border-radius: 5px;
    padding:10px 0;
    font-size:25px;
}

.correct {
    color:#0f5132;
    background-color:#d1e7dd;
}

</style>
