<template>

    <div class="custom-modal">


            <div class="custom-modal--inner">

                    <div class="custom-modal--body">

                        <button @click.prevent="closeModal">Close</button>

                        <slot></slot>

                    </div>

            </div>


    </div>

</template>

<script setup>

import { onMounted, ref, computed } from "vue";

const emit = defineEmits(['close']);

const closeModal = () => {
    emit('close', true)
}

</script>

<style scoped>

        .custom-modal {
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.5);
            position:fixed;
            z-index:5;
        }
        .custom-modal--inner {
            height:100%;
            width:100%;
            display:flex;
            justify-content: center;
            align-items: center;
        }
        .custom-modal--body {
            width:90%;
            padding:2rem;
            max-width:1000px;
            min-height:600px;
            background:#ffffff;
            box-shadow: 10px 10px 10px rgba(0,0,0,0.25);
        }

</style>