<template>
    <div>
        {{ selectedItems }}
      <label for="pizza">Pizza</label> <br>
      <input type="checkbox" value="pizza" v-model="selectedItems.pizza" @change="logSelectedItems">
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const selectedItems = ref({});
  
  const logSelectedItems = () => {
    console.log('Selected Items:', selectedItems.value);
  };
  </script>
  
  <style lang="scss" scoped></style>
  