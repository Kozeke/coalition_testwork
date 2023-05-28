<template>
  <li>
    <div
      class="group relative bg-white p-2 shadow rounded-md border-b border-gray-300 hover:bg-gray-50">
      <form @keydown.esc="store.value.editingCardId = null" @submit.prevent="onSubmit()" v-if="isShowingForm">
    <textarea v-model="form.title" ref="inputTitleRef" type="text" placeholder="Enter card title..." rows="3"
              @keydown.enter.prevent="onSubmit()"
              class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring-blue-400">
    </textarea>
        <div class="mt-2 space-x-2">
          <button
            type="submit"
            class="px-4 py-2 text-sm font-medium text-white bg-rose-600 hover:bg-rose-500 rounded-md shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 focus:outline-none">
            Add card
          </button>
          <button
            type="button"
            @click="store.value.editingCardId = null"
            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-black rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 focus:outline-none">
            Cancel
          </button>
        </div>
      </form>
      <template v-if="!isShowingForm">
        <a href="#" class="text-sm">{{ card.title }}</a>
        <button
          @click="showForm()"
          class="hidden absolute top-1 right-1 w-8 h-8 bg-gray-50 group-hover:grid place-content-center rounded-md text-gray-600 hover:text-black hover:bg-gray-200">
          <PencilIcon class="w-5 h-5"></PencilIcon>
        </button>
      </template>
    </div>
  </li>
</template>

<script setup>
import {PencilIcon} from '@heroicons/vue/20/solid'
import {useForm} from "@inertiajs/vue3";
import {nextTick, ref, computed} from "vue";
import {store} from "@/store";

const isShowingForm = computed(() => props.card.id === store.value.editingCardId);
const inputTitleRef = ref();

const props = defineProps({
  card: Object
})

const form = useForm({
  title: props.card.title
})

async function showForm() {
  store.value.editingCardId = props.card.id
  await nextTick();
  inputTitleRef.value.focus();
}

function onSubmit() {
  form.put(route('cards.update', {card: props.card.id}), {
    onSuccess: () => store.value.editingCardId = null
  })
}
</script>

<style scoped>
.drag > div {
  transform: rotate(5deg);
}

.ghost {
  background: lightgray;
  border-radius: 6px;
}
.ghost > div {
  visibility: hidden;
}
</style>
