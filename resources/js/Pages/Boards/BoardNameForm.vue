<template>
  <div class="flex flex-col items-start max-w-full relative">
    <h1 @click="edit()" :class="[isEditing ? 'invisible':'']"
        class="break-all hover:bg-white/20 whitespace-pre w-full overflow-hidden text-ellipsis border border-transparent rounded-md cursor-pointer px-3 py-1.5 text-2xl text-white font-bold">
      {{ form.name ? form.name : ' ' }}</h1>
    <form class="w-full" v-show="isEditing" @submit.prevent="onSubmit()" @focusout="onSubmit()">
      <input ref="input" v-model="form.name" placeholder="Project name" type="text"
             class="absolute inset-0 max-w-full text-2xl font-bold placeholder-grey-400 px-3 py-1.5 rounded-md focus:ring-2 focus:ring-blue-900">
    </form>
  </div>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import {nextTick, ref, watch} from "vue";

const props = defineProps({
  project: Object
})

const form = useForm({
  name: props.project.name
})

const input = ref();
const isEditing = ref(false);

async function edit() {
  isEditing.value = true;
  await nextTick();
  input.value.select();
}

function onSubmit(){
  isEditing.value = false;
  form.put(route('project.update',{project: props.project.id},{
    onError: () => form.reset()
  }))
}
</script>

<style scoped>

</style>
