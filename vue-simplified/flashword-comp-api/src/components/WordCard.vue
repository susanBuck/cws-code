<script setup>
// defineProps is a compile-time macro that is only available inside <script setup> and does not need to be explicitly imported. 
// https://vuejs.org/guide/essentials/component-basics.html#passing-props
const props = defineProps(['word'])

// Similar to defineProps, defineEmits is only usable in <script setup> and doesn’t need to be imported. 
// It returns an emit function that is equivalent to the $emit method.
// It can be used to emit events in the <script setup> section of a component, where $emit isn't directly accessible
const emit = defineEmits(['incrementCorrectCount'])

// Method
const checkAnswer = () => {

    // Note how props are accessed via our `props` constant defined above
    props.word.correct = props.word.word_b == props.word.answer;

    if (props.word.correct) {
        emit('incrementCorrectCount');
    }
}
</script>

<template>
<div
        class='card'
        v-bind:class='{ correct: word.correct}'>
    <p class='word'>{{ word.word_a }}</p>

    <input v-if='!word.correct' type='text' v-model='word.answer' v-on:keyup.enter='checkAnswer()'>
    <p v-else class='correctAnswer'>{{ word.answer }}</p>
</div>
</template>

<style scoped>
.card {
    background-color: #E8F0FF;
    border-radius: 5px;
    padding: 10px 0;
    font-size: 25px;
}

input[type=text] {
    border: 0;
    font-size: 25px;
    border-radius: 5px;
    margin-top: 5px;
    text-align: center;
    padding: 5px;
}

.word {
    font-weight: bold;
    padding: 0;
    margin: 0;
}

.correctAnswer {
    padding: 0;
    margin: 0;
}

.correct {
    color: #0f5132;
    background-color: #d1e7dd;
}
</style>